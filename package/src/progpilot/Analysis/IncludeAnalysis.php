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

    public static function funccall($context, $defs, $blocks, $instruction, $code, $index)
    {
        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
        $arrFuncCall = $instruction->getProperty(MyInstruction::ARR);
        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

        echo "FUNC_CALL include 1\n";
        // require, require_once ... already handled in transform Expr/include_
        if ($myFuncCall->getName() === "include" && $context->getAnalyzeIncludes()) {
            $typeInclude = $instruction->getProperty(MyInstruction::TYPE_INCLUDE);
            $nbParams = $myFuncCall->getNbParams();
            echo "FUNC_CALL include 2\n";
            if ($nbParams > 0) {
                $atLeastOneIncludeResolved = false;

                echo "FUNC_CALL include 3\n";
                $myDefArg = $instruction->getProperty("argdef0");
                if (count($myDefArg->getCurrentState()->getLastKnownValues()) !== 0) {
                    foreach ($myDefArg->getCurrentState()->getLastKnownValues() as $lastKnownValue) {
                        $realFile = false;

                        echo "FUNC_CALL include 4\n";
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

                            echo "FUNC_CALL include 5\n";
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

                            echo "FUNC_CALL include 6\n";
                            $arrayIncludes = &$context->getArrayIncludes();
                            $arrayRequires = &$context->getArrayRequires();
        
                            if (!$context->inputs->isExcludedFile($nameIncludedFile)
                                && ((!in_array($nameIncludedFile, $arrayIncludes, true) && $typeInclude === 2)
                                || (!in_array($nameIncludedFile, $arrayRequires, true) && $typeInclude === 4)
                                    || ($typeInclude === 1 || $typeInclude === 3))) {
                                $myFileIncluded = new MyFile(
                                    $nameIncludedFile,
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
                                    echo "FUNC_CALL include 7\n";
                                    if (is_null($context->getCurrentBlock())) {
                                        echo "FUNC_CALL include getCurrentBlock is null\n";
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
                                        echo "FUNC_CALL include 7b\n";
                                        if (is_null($context->getCurrentBlock())) {
                                            echo "FUNC_CALL include getCurrentBlock is null\n";
                                        }
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

                                    echo "FUNC_CALL include 8\n";
                                    // we include defs of the current file to the included file
                                    $saveMyFile = [];
                                    $defsIncluded = [];
                                    if (!is_null($mainInclude)) {


                                    $lastMyBlockConstuctor = $mainInclude->getBlockById($mainInclude->getLastBlockId());
                                    if (!is_null($context->getCurrentBlock())
                                        && !is_null($lastMyBlockConstuctor)) {
                                            echo "FUNC_CALL include 7b -2\n";
                                            echo "FUNC_CALL include 7b current blockid = '".$saveCurrentBlock->getId()."'\n";
                                            echo "FUNC_CALL include 7b current blockid = '".$mainInclude->getLastBlockId()."'\n";
                                        $saveCurrentBlock->addVirtualParent($lastMyBlockConstuctor);
                                    }
                                    
                                        // we change the source of defs nevermind the file is really analyzed or nor
                                        foreach ($mainInclude->getDefs()->getDefs() as $defOfMainArray) {
                                            foreach ($defOfMainArray as $defOfMain) {
                                                $defOfMain->setSourceMyFile($myFileIncluded);
                                            }
                                        }
                                        echo "FUNC_CALL include 9\n";

                                        // already visited from include or not?
                                        if (!$mainInclude->isVisitedFromInclude()) {
                                            $currentFileDefs = $defs->getOutMinusKill($myFuncCall->getBlockId());
                                            if (!empty($currentFileDefs)) {
                                                foreach ($currentFileDefs as $defToInclude) {
                                                    if ($defToInclude->getLine() < $myFuncCall->getLine()
                                                        || ($defToInclude->getLine() === $myFuncCall->getLine()
                                                            && $defToInclude->getColumn() < $myFuncCall->getColumn())) {
                                                        $saveMyFile[$defToInclude->getId()]
                                                            = $defToInclude->getSourceMyFile()->getIncludedToMyfile();
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
                            
                                            echo "FUNC_CALL include 10\n";
                                            // we analyze the main of the function again
                                            // we can have tainted def included and vice-versa
                                            $mainInclude->setIsVisited(false);
                                            $mainInclude->setIsVisitedFromInclude(true);

                                            $saveCallBacks = $context->getCallStack();
                                            $context->resetCallStack();

                                            echo "FUNC_CALL include 10bid\n";
                                            echo "FUNC_CALL include 10bbb current blockid = '".$context->getCurrentBlock()->getId()."'\n";

                                            $analyzerInclude->runFunctionAnalysis($context, $mainInclude, false);
                                        
                                            $context->setCurrentOp($saveCurrentOp);
                                            $context->setCurrentBlock($saveCurrentBlock);
                                            $context->setCurrentLine($saveCurrentLine);
                                            $context->setCurrentColumn($saveCurrentColumn);
                                            $context->setCurrentFunc($saveCurrentFunc);
                                            $context->setCurrentMyCode($saveCurrentCode);
                                            $context->setCurrentMyfile($saveCurrentMyfile);

                                            echo "FUNC_CALL include 11\n";
                                            if (is_null($context->getCurrentBlock())) {
                                                echo "FUNC_CALL include getCurrentBlock is null\n";
                                            }
                                            $context->setCallStack($saveCallBacks);

                                            foreach ($defsIncluded as $defIncluded) {
                                                if (!is_null($saveMyFile[$defIncluded->getId()])) {
                                                    $tmp = clone $defIncluded->getSourceMyFile();
                                                    $tmp->setIncludedToMyfile($saveMyFile[$defIncluded->getId()]);
                                                    $defIncluded->setSourceMyFile($tmp);
                                                }
                                            }
                                    
                                            echo "FUNC_CALL include 12\n";
                                            FuncAnalysis::funccallAfter(
                                                $context,
                                                $defs->getOutMinusKill($myFuncCall->getBlockId()),
                                                $mainInclude,
                                                $mainInclude,
                                                $arrFuncCall,
                                                $instruction,
                                                $code,
                                                $index
                                            );
                                        }

                                        // even if we don't visit again the function
                                        // we are interested by the return def
                                        // to include them in the file performing the include
                                        // it's an approximation ...
                                        echo "FUNC_CALL include 12a\n";
                                        $defsOutputIncludedFinal = [];
                                        if (!is_null($mainInclude->getDefs())) {
                                            echo "FUNC_CALL include 12b\n";
                                            $defsMainReturn =
                                                $mainInclude->getDefs()->getDefRefByName("{main}_return");

                                            $defsOutputIncluded = $mainInclude->getDefs()->getOutMinusKill(
                                                $mainInclude->getLastBlockId()
                                            );

                                            /*
                                            if (is_array($defsMainReturn)) {
                                                echo "FUNC_CALL include 12c\n";
                                                foreach ($defsMainReturn as $defMainReturn) {
                                                    $defsOutputIncluded = $mainInclude->getDefs()->getOutMinusKill(
                                                        $defMainReturn->getBlockId()
                                                    );
                                                    */
                                                    echo "FUNC_CALL include 12d\n";
                                                    if (!is_null($defsOutputIncluded)) {
                                                        echo "FUNC_CALL include 12e\n";
                                                        foreach ($defsOutputIncluded as $defOutputIncludedId) {
                                                            echo "FUNC_CALL include 12f\n";
                                                            if (!in_array(
                                                                $defOutputIncludedId,
                                                                $defsOutputIncludedFinal,
                                                                true
                                                            ) && !in_array($defOutputIncludedId, $defsIncluded, true)) {
                                                                echo "FUNC_CALL include 12g\n";
                                                                $defsOutputIncludedFinal[] = $defOutputIncludedId;
                                                            }
                                                        }
                                                    }
                                                    /*
                                                }
                                            }*/
                                        }

                                        echo "FUNC_CALL include 13\n";
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

                                        echo "FUNC_CALL include 14\n";
                                        if ($newDefs) {
                                            $defs->computeKill($myFuncCall->getBlockId());
                                            $defs->reachingDefs($blocks);

                                            $defsOutputIncluded = $defs->getOutMinusKill(
                                                $myFuncCall->getBlockId()
                                            );
                                        }


                                        echo "FUNC_CALL include 15\n";

                                        HelpersAnalysis::blockSwitching($context, $context->getCurrentFunc());
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

                echo "FUNC_CALL include 14\n";
                if (!$atLeastOneIncludeResolved && $context->outputs->getWriteIncludeFailures()) {
                    $myFileTemp = new MyFile(
                        $myFuncCall->getSourceMyFile()->getName(),
                        $myFuncCall->getLine(),
                        $myFuncCall->getColumn()
                    );

                    $context->outputs->currentIncludesFile[] = $myFileTemp;
                }
                echo "FUNC_CALL include 15\n";
            }
        }
    }
}
