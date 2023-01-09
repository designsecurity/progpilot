<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyFile;
use progpilot\Objects\MyOp;
use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;
use progpilot\Objects\MyClass;
use progpilot\Objects\MyFunction;

use progpilot\Code\MyCode;
use progpilot\Code\Opcodes;
use progpilot\Code\MyInstruction;

use progpilot\Helpers\Analysis as HelpersAnalysis;
use progpilot\Helpers\State as HelpersState;

use progpilot\Utils;

use function DeepCopy\deep_copy;

class IncludeAnalysis
{
    public static function isCircularInclude($myFile)
    {
        $includedMyFile = $myFile->getIncludedFromMyfile();
        while (!is_null($includedMyFile)) {
            if ($includedMyFile->getName() === $myFile->getName()) {
                return true;
            }

            $includedMyFile = $includedMyFile->getIncludedFromMyfile();
        }

        return false;
    }

    public static function funccall($context, $blocks, $defs, $instruction)
    {
        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        // require, require_once ... already handled in transform Expr/include_
        if ($myFuncCall->getName() === "include" && $context->getAnalyzeIncludes()) {
            $typeInclude = $instruction->getProperty(MyInstruction::TYPE_INCLUDE);
            $nbParams = $myFuncCall->getNbParams();
            if ($nbParams > 0) {
                $atLeastOneIncludeResolved = false;

                $myDefArg = $instruction->getProperty("argdef0");
                if (count($myDefArg->getCurrentState()->getLastKnownValues()) !== 0) {
                    foreach ($myDefArg->getCurrentState()->getLastKnownValues() as $lastKnownValue) {
                        $realFile = false;
                        // else it's maybe a relative path
                        if (strlen($lastKnownValue) > 0
                            && (substr($lastKnownValue, 0, 1) !== DIRECTORY_SEPARATOR
                                || preg_match("/^[a-bA-B]*:/", $lastKnownValue) === 0)) {
                            $file = $context->getPath().DIRECTORY_SEPARATOR.$lastKnownValue;
                            $realFile = realpath($file);
                        }

                        // if $lastKnownValue is a absolute path to the file :
                        // /home/dev/file.php
                        if (!$realFile) {
                            $realFile = realpath($lastKnownValue);
                        }
                        if (!$realFile) {
                            $continueInclude = false;

                            // check is the file is manually set by the developer with json
                            $myInclude = $context->inputs->getIncludeByLocation(
                                $myFuncCall->getLine(),
                                $myFuncCall->getColumn(),
                                $myFuncCall->getSourceMyFile()->getName()
                            );

                            if (!is_null($myInclude)) {
                                $manuallyIncludedFile = $myInclude->getValue();
                                if (strlen($manuallyIncludedFile) > 0
                                    && (substr($manuallyIncludedFile, 0, 1) !== DIRECTORY_SEPARATOR
                                        || preg_match("/^[a-bA-B]*:/", $manuallyIncludedFile) === 0)) {
                                    $manuallyIncludedFile =
                                        $context->getPath().DIRECTORY_SEPARATOR.$manuallyIncludedFile;
                                }

                                $nameIncludedFile = realpath($manuallyIncludedFile);
                        
                                if ($nameIncludedFile) {
                                    $continueInclude = true;
                                }
                            }
                        } else {
                            $continueInclude = true;
                            $nameIncludedFile = $realFile;
                        }
                        
                        if ($continueInclude) {
                            $atLeastOneIncludeResolved = true;

                            $arrayIncludes = &$context->getArrayIncludes();
                            $arrayRequires = &$context->getArrayRequires();
        
                            if (!$context->inputs->isExcludedFile($nameIncludedFile)
                                && ((!in_array($nameIncludedFile, $arrayIncludes, true) && $typeInclude === 2)
                                || (!in_array($nameIncludedFile, $arrayRequires, true) && $typeInclude === 4)
                                    || ($typeInclude === 1 || $typeInclude === 3))) {
                                $myFileIncluded = new MyFile(
                                    $nameIncludedFile,
                                    dirname($nameIncludedFile),
                                    $myFuncCall->getLine(),
                                    $myFuncCall->getColumn()
                                );

                                $myFileIncluded->setIncludedFromMyfile(clone $context->getCurrentMyFile());
                                if (!IncludeAnalysis::isCircularInclude($myFileIncluded)) {
                                    // include once
                                    if ($typeInclude === 2) {
                                        $arrayIncludes[] = $nameIncludedFile;
                                    }

                                    // require once
                                    if ($typeInclude === 4) {
                                        $arrayRequires[] = $nameIncludedFile;
                                    }

                                    $analyzerInclude = new \progpilot\Analyzer;
                                    $saveCurrentMyfile = $context->getCurrentMyfile();
                                    $saveCurrentOp = $context->getCurrentOp();
                                    $saveCurrentBlock = $context->getCurrentBlock();
                                    $saveCurrentLine = $context->getCurrentLine();
                                    $saveCurrentColumn = $context->getCurrentColumn();
                                    $saveCurrentFunc = $context->getCurrentFunc();
                                    $saveCurrentCode = $context->getCurrentMyCode();

                                    $context->setCurrentMyfile($myFileIncluded);

                                    // could be analyzed with namespaces pre-includes, better to check
                                    if (!$context->isFileDataAnalyzed($nameIncludedFile)) {
                                        $context->inputs->setFile($nameIncludedFile);
                                        $analyzerInclude->computeDataFlow($context);

                                        // the file is now data analyzed
                                        $context->addDataAnalyzedFile($nameIncludedFile);

                                        $currentFile =  $myFuncCall->getSourceMyFile()->getName();
                                        $context->inputs->setFile($currentFile);
                                        $context->setPath(dirname($currentFile));
                                    }

                                    $fileNameHash = hash("sha256", $context->getCurrentMyfile()->getName());
                                    $mainInclude = $context->getFunctions()->getFunction(
                                        "{main}",
                                        "function",
                                        $fileNameHash
                                    );

                                    // we include defs of the current file to the included file
                                    $saveMyFile = [];
                                    $defsIncluded = [];
                                    if (!is_null($mainInclude)) {
                                        foreach ($mainInclude->getLastBlockIds() as $lastBlockId) {
                                            $lastMyBlockConstuctor =
                                            $mainInclude->getBlockById($lastBlockId);
                                            if (!is_null($context->getCurrentBlock())
                                                && !is_null($lastMyBlockConstuctor)) {
                                                $saveCurrentBlock->addVirtualParent($lastMyBlockConstuctor);
                                            }
                                        }
                                    
                                        // we change the source of defs nevermind the file is really analyzed or not
                                        foreach ($mainInclude->getDefs()->getDefs() as $defOfMainArray) {
                                            foreach ($defOfMainArray as $defOfMain) {
                                                $defOfMain->setSourceMyFile($myFileIncluded);
                                            }
                                        }

                                        // already visited from include or not?
                                        if (!$mainInclude->isVisitedFromInclude()) {
                                            $currentFileDefs = $defs->getOutMinusKill($myFuncCall->getBlockId());
                                            if (!empty($currentFileDefs)) {
                                                foreach ($currentFileDefs as $defToInclude) {
                                                    if ($defToInclude->getLine() < $myFuncCall->getLine()
                                                        || ($defToInclude->getLine() === $myFuncCall->getLine()
                                                            && $defToInclude->getColumn() < $myFuncCall->getColumn())) {
                                                        $saveMyFile[$defToInclude->getId()]
                                                            = $defToInclude->getSourceMyFile();
                                                        $defsIncluded[] = $defToInclude;

                                                        $tmp = clone $defToInclude->getSourceMyFile();
                                                        $tmp->setIncludedToMyfile($myFileIncluded);
                                                        $defToInclude->setSourceMyFile($tmp);

                                                        $mainInclude->getDefs()->addDef(
                                                            $defToInclude->getName(),
                                                            $defToInclude
                                                        );
                                                        $mainInclude->getDefs()->addGen(
                                                            $mainInclude->getFirstBlockId(),
                                                            $defToInclude
                                                        );
                                                    }
                                                }

                                                $mainInclude->getDefs()->computeKill($mainInclude->getFirstBlockId());
                                                $mainInclude->getDefs()->reachingDefs($mainInclude->getBlocks());
                                            }
                            
                                            // we analyze the main of the function again
                                            // we can have tainted def included and vice-versa
                                            $mainInclude->setIsVisited(false);
                                            $mainInclude->setIsVisitedFromInclude(true);

                                            $saveCallBacks = $context->getCallStack();
                                            $context->resetCallStack();

                                            $analyzerInclude->runFunctionAnalysis($context, $mainInclude, false);
                                        
                                            $context->setCurrentOp($saveCurrentOp);
                                            $context->setCurrentBlock($saveCurrentBlock);
                                            $context->setCurrentLine($saveCurrentLine);
                                            $context->setCurrentColumn($saveCurrentColumn);
                                            $context->setCurrentFunc($saveCurrentFunc);
                                            $context->setCurrentMyCode($saveCurrentCode);
                                            $context->setCurrentMyfile($saveCurrentMyfile);

                                            $context->setCallStack($saveCallBacks);

                                            foreach ($defsIncluded as $defIncluded) {
                                                if (!is_null($saveMyFile[$defIncluded->getId()])) {
                                                    $defIncluded->setSourceMyFile($saveMyFile[$defIncluded->getId()]);
                                                }
                                            }

                                            $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                                            $opInformation = $context->getCurrentFunc()->getOpInformation($resultid);
                                            $opInformation["chained_results"] = $mainInclude->getReturnDefs();
                                            $context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
                                        }

                                        // even if we don't visit again the function
                                        // we are interested by the return def
                                        // to include them in the file performing the include
                                        // it's an approximation ...
                                        $defsOutputIncludedFinal = [];
                                        if (!is_null($mainInclude->getDefs())) {
                                            $defsOutputIncluded = [];
                                            foreach ($mainInclude->getLastBlockIds() as $lastBlockId) {
                                                $defsOutputIncluded = array_merge(
                                                    $mainInclude->getDefs()->getOutMinusKill($lastBlockId),
                                                    $defsOutputIncluded
                                                );
                                            }

                                            if (!is_null($defsOutputIncluded)) {
                                                foreach ($defsOutputIncluded as $defOutputIncludedId) {
                                                    if (!in_array(
                                                        $defOutputIncludedId,
                                                        $defsOutputIncludedFinal,
                                                        true
                                                    ) && !in_array($defOutputIncludedId, $defsIncluded, true)) {
                                                        $defsOutputIncludedFinal[] = $defOutputIncludedId;
                                                    }
                                                }
                                            }
                                        }

                                        // for all class found, we resolve previous seen objects of this class
                                        $myClassesIncluded = $context->getClasses()->getListClasses();
                                        foreach ($myClassesIncluded as $myClassIncluded) {
                                            $funcCallBack = "Callbacks::modifyMyclassOfObject";
                                            HelpersAnalysis::forAllobjects($context, $funcCallBack, $myClassIncluded);
                                        }

                                        $newDefs = false;
                                        if (!empty($defsOutputIncludedFinal)) {
                                            foreach ($defsOutputIncludedFinal as $defOutputIncludedFinal) {
                                                $ret1 = $defs->addDef(
                                                    $defOutputIncludedFinal->getName(),
                                                    $defOutputIncludedFinal
                                                );
                                                $ret2 = $defs->addGen(
                                                    $myFuncCall->getBlockId(),
                                                    $defOutputIncludedFinal
                                                );

                                                $newDefs = true;
                                            }
                                        }

                                        if ($newDefs) {
                                            $defs->computeKill($myFuncCall->getBlockId());
                                            $defs->reachingDefs($blocks);

                                            $defsOutputIncluded = $defs->getOutMinusKill(
                                                $myFuncCall->getBlockId()
                                            );
                                        }

                                        HelpersState::blockSwitching($context, $context->getCurrentFunc());
                                    }


                                    $context->setCurrentOp($saveCurrentOp);
                                    $context->setCurrentBlock($saveCurrentBlock);
                                    $context->setCurrentLine($saveCurrentLine);
                                    $context->setCurrentColumn($saveCurrentColumn);
                                    $context->setCurrentFunc($saveCurrentFunc);
                                    $context->setCurrentMyCode($saveCurrentCode);
                                    $context->setCurrentMyfile($saveCurrentMyfile);
                                }
                            }
                        }
                    }
                }

                if (!$atLeastOneIncludeResolved && $context->outputs->getWriteIncludeFailures()) {
                    $myFileTemp = new MyFile(
                        $myFuncCall->getSourceMyFile()->getName(),
                        $myFuncCall->getSourceMyFile()->baseDir,
                        $myFuncCall->getLine(),
                        $myFuncCall->getColumn()
                    );

                    $context->outputs->currentIncludesFile[] = $myFileTemp;
                }
            }
        }
    }
}
