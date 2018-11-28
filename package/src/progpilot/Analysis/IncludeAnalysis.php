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
                        $file = $context->getPath()."/".$lastKnownValue;
                        $realFile = realpath($file);

                        // if $lastKnownValue is a absolute path to the file :
                        // /home/dev/file.php
                        if (!$realFile) {
                            $realFile = realpath($lastKnownValue);
                        }

                        if (!$realFile) {
                            $continueInclude = false;

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

                            $arrayIncludes = $context->getArrayIncludes();
                            $arrayRequires = $context->getArrayRequires();

                            if ((!in_array($nameIncludedFile, $arrayIncludes, true) && $typeInclude === 2)
                                || (!in_array($nameIncludedFile, $arrayRequires, true) && $typeInclude === 4)
                                    || ($typeInclude === 1 || $typeInclude === 3)) {
                                $myFile = new MyFile(
                                    $nameIncludedFile,
                                    $myFuncCall->getLine(),
                                    $myFuncCall->getColumn()
                                );
                                $myFile->setIncludedFromMyfile($myFuncCall->getSourceMyFile());

                                if (!IncludeAnalysis::isCircularInclude($myFile)) {
                                    if ($typeInclude === 2) {
                                        $arrayIncludes[] = $nameIncludedFile;
                                    }

                                    if ($typeInclude === 4) {
                                        $arrayRequires[] = $nameIncludedFile;
                                    }

                                    $contextInclude = clone $context;

                                    $contextInclude->resetInternalValues();

                                    // not need to propagate files already included to the current analyzed file
                                    // because of clone context and reset values that don't
                                    // ie : $contextInclude->set_array_includes($arrayIncludes); ect
                                    $contextInclude->inputs->setFile($nameIncludedFile);
                                    $contextInclude->inputs->setCode(null);
                                    $contextInclude->setCurrentMyfile($myFile);
                                    //$contextInclude->setOutputs(new \progpilot\Outputs\MyOutputs);
                                    $contextInclude->outputs->resetRepresentations();

                                    $mainFunctionSave = $context->getFunctions()->getFunction("{main}");
                                    $saveMain = $contextInclude->getFunctions()->delFunction("{main}");

                                    $analyzerInclude = new \progpilot\Analyzer;
                                    $analyzerInclude->runInternalPhp(
                                        $contextInclude,
                                        $defs->getOutMinusKill($myFuncCall->getBlockId())
                                    );

                                    if (count($contextInclude->outputs->currentIncludesFile) > 0) {
                                        foreach ($contextInclude->outputs->currentIncludesFile as $includeFile) {
                                            $context->currentIncludesFile[] = $includeFile;
                                        }
                                    }

                                    if (!is_null($contextInclude->outputs->getResults())) {
                                        foreach ($contextInclude->outputs->getResults() as $resultInclude) {
                                            $context->outputs->addResult($resultInclude);
                                        }
                                    }

                                    $context->setCurrentNbDefs($contextInclude->getCurrentNbDefs());

                                    $mainInclude = $contextInclude->getFunctions()->getFunction("{main}");

                                    $defsOutputIncludedFinal = [];
                                    if (!is_null($mainInclude)) {
                                        FuncAnalysis::funccallAfter(
                                            $contextInclude,
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
                                                            )) {
                                                                $defsOutputIncludedFinal[] = $defOutputIncluded;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    // for all class found, we resolve previous seen objects of this class
                                    $myClassesIncluded = $contextInclude->getClasses()->getListClasses();
                                    foreach ($myClassesIncluded as $myClassIncluded) {
                                        $funcCallBack = "Callbacks::modifyMyclassOfObject";
                                        AbstractAnalysis::forAllobjects($context, $funcCallBack, $myClassIncluded);
                                    }

                                    $newDefs = false;
                                    if (count($defsOutputIncludedFinal) > 0) {
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
                                        $defs->computeKill($context, $myFuncCall->getBlockId());
                                        $defs->reachingDefs($blocks);
                                    }
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
