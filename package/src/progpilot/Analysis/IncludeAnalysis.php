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

use progpilot\AbstractLayer\Analysis as AbstractAnalysis;

use progpilot\Utils;

use function DeepCopy\deep_copy;

class IncludeAnalysis
{
    public function __construct()
    {
    }

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

        // require, require_once ... already handled in transform Expr/include_
        if ($myFuncCall->getName() === "include" && $context->getAnalyzeIncludes()) {
            $typeInclude = $instruction->getProperty(MyInstruction::TYPE_INCLUDE);
            $nbParams = $myFuncCall->getNbParams();
            if ($nbParams > 0) {
                $atLeastOneIncludeResolved = false;

                $myDefArg = $instruction->getProperty("argdef0");

                if (count($myDefArg->getLastKnownValues()) !== 0) {
                    foreach ($myDefArg->getLastKnownValues() as $lastKnownValue) {
                        $realFile = false;

                        // else it's maybe a relative path
                        if (strlen($lastKnownValue) > 0 && substr($lastKnownValue, 0, 1) !== '/') {
                            $file = $context->getPath()."/".$lastKnownValue;
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
                                $context->getCurrentLine(),
                                $context->getCurrentColumn(),
                                $myFuncCall->getSourceMyFile()->getName()
                            );

                            if (!is_null($myInclude)) {
                                $nameIncludedFile = realpath($myInclude->getValue());
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
                            
                            if ((!in_array($nameIncludedFile, $arrayIncludes, true) && $typeInclude === 2)
                                || (!in_array($nameIncludedFile, $arrayRequires, true) && $typeInclude === 4)
                                    || ($typeInclude === 1 || $typeInclude === 3)) {
                                $myFileIncluded = new MyFile(
                                    $nameIncludedFile,
                                    $myFuncCall->getLine(),
                                    $myFuncCall->getColumn()
                                );
                                $myFileIncluded->setIncludedFromMyfile(clone $context->getCurrentMyFile());

                                $myFilePerformingInclude = new MyFile(
                                    $myFuncCall->getSourceMyFile()->getName(),
                                    $myFuncCall->getLine(),
                                    $myFuncCall->getColumn()
                                );

                                if (!IncludeAnalysis::isCircularInclude($myFileIncluded)) {
                                    if ($typeInclude === 2) {
                                        $arrayIncludes[] = $nameIncludedFile;
                                    }

                                    if ($typeInclude === 4) {
                                        $arrayRequires[] = $nameIncludedFile;
                                    }

                                    $analyzerInclude = new \progpilot\Analyzer;
                                    $saveCurrentMyfile = clone $context->getCurrentMyfile();
                                    $context->setCurrentMyfile($myFileIncluded);

                                    if (!$context->isFileAnalyzed($nameIncludedFile)) {
                                        $context->inputs->setFile($nameIncludedFile);
                                        //$context->setCurrentMyfile($myFileIncluded);
                                        $analyzerInclude->computeDataFlow($context);

                                        //$context->setCurrentMyfile($myFile);
                                        $currentFile = $myFuncCall->getSourceMyFile()->getName();
                                        $context->inputs->setFile($currentFile);
                                        $context->setPath(dirname($currentFile));
                                    } else {
                                        $fileNameHash = hash("sha256", $context->getCurrentMyfile()->getName());
                                        $mainInclude = $context->getFunctions()->getFunction(
                                            "{main}",
                                            "function",
                                            $fileNameHash
                                        );

                                        if (isset($mainInclude)) {
                                            foreach ($mainInclude->getDefs()->getDefs() as $defOfMainArray) {
                                                foreach ($defOfMainArray as $defOfMain) {
                                                    $defOfMain->setSourceMyFile($myFileIncluded);
                                                }
                                            }
                                        }
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
                                        if (!empty($defs->getOutMinusKill($myFuncCall->getBlockId()))) {
                                            foreach ($defs->getOutMinusKill($myFuncCall->getBlockId()) as $defToInclude) {
                                                if ($defToInclude->getLine() < $myFuncCall->getLine()
                                                    || ($defToInclude->getLine() === $myFuncCall->getLine()
                                                        && $defToInclude->getColumn() < $myFuncCall->getColumn())) {
                                                    $saveMyFile[$defToInclude->getId()] = $defToInclude->getSourceMyFile()->getIncludedToMyfile();
                                                    $defsIncluded[] = $defToInclude;
                                                    //$defToInclude->setSourceMyFile($myFileIncluded);

                                                    $defToInclude->getSourceMyFile()->setIncludedToMyfile($myFileIncluded);

                                                    //$defToInclude->setSourceMyFile($myFileIncluded);

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

                                            $mainInclude->getDefs()->computeKill($context, $mainInclude->getFirstBlockId());
                                            $mainInclude->getDefs()->reachingDefs($mainInclude->getBlocks());
                                        }
                                    
                                        // we should remove these defs after from the included file

                                        // we analyze the main of the function
                                        $mainInclude->setIsVisited(false);
                                        $analyzerInclude->runFunctionAnalysis($context, $mainInclude, false);

                                        foreach ($defsIncluded as $defIncluded) {
                                            $defIncluded->getSourceMyFile()->setIncludedToMyfile($saveMyFile[$defIncluded->getId()]);
                                        }
                                    
                                        $defsOutputIncludedFinal = [];
                                        FuncAnalysis::funccallAfter(
                                            $context,
                                            $defs->getOutMinusKill($myFuncCall->getBlockId()),
                                            $mainInclude,
                                            $mainInclude,
                                            $arrFuncCall,
                                            $instruction,
                                            $code[$index + 3]
                                        );

                                        if (!is_null($mainInclude->getDefs())) {
                                            $defsMainReturn =
                                                $mainInclude->getDefs()->getDefRefByName("{main}_return");
                                            
                                            if (is_array($defsMainReturn)) {
                                                foreach ($defsMainReturn as $defMainReturn) {
                                                    $defsOutputIncluded = $mainInclude->getDefs()->getOutMinusKill(
                                                        $defMainReturn->getBlockId()
                                                    );
                                                    if (!is_null($defsOutputIncluded)) {
                                                        foreach ($defsOutputIncluded as $defOutputIncluded) {
                                                            if (!in_array(
                                                                $defOutputIncluded,
                                                                $defsOutputIncludedFinal,
                                                                true
                                                            ) && !in_array($defOutputIncluded, $defsIncluded, true)) {
                                                                $defsOutputIncludedFinal[] = $defOutputIncluded;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        // for all class found, we resolve previous seen objects of this class
                                        $myClassesIncluded = $context->getClasses()->getListClasses();
                                        foreach ($myClassesIncluded as $myClassIncluded) {
                                            $funcCallBack = "Callbacks::modifyMyclassOfObject";
                                            AbstractAnalysis::forAllobjects($context, $funcCallBack, $myClassIncluded);
                                        }

                                        $newDefs = false;
                                        if (count($defsOutputIncludedFinal) > 0) {
                                            foreach ($defsOutputIncludedFinal as $defOutputIncludedFinal) {
                                                //$defOutputIncludedFinal->setSourceMyFile($myFileIncluded);
                                                //$defOutputIncludedFinal->getSourceMyFile()->setIncludedFromMyfile($myFilePerformingInclude);

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
                                            $defs->computeKill($context, $myFuncCall->getBlockId());
                                            $defs->reachingDefs($blocks);
                                        }
                                    }
/*
                                    if ($typeInclude === 2) {
                                        array_pop($arrayIncludes);
                                    }

                                    if ($typeInclude === 4) {
                                        array_pop($arrayRequires);
                                    }
*/
                                    $context->setCurrentMyfile($saveCurrentMyfile);
                                }
                            }
                        }
                    }
                }

                if (!$atLeastOneIncludeResolved && $context->outputs->getResolveIncludes()) {
                    $myFileTemp = new MyFile(
                        $myFuncCall->getSourceMyFile()->getName(),
                        $myFuncCall->getLine(),
                        $myFuncCall->getColumn()
                    );

                    $context->outputs->currentIncludesFile[] = $myFileTemp;
                }
            }
        }
    }
}
