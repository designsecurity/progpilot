<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use function DeepCopy\deep_copy;

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

use progpilot\Helpers\State as HelpersState;
use progpilot\Helpers\Analysis as HelpersAnalysis;

use progpilot\Lang;
use progpilot\Utils;
use progpilot\Analyzer;

class VisitorAnalysis
{
    private $context;

    private $defs;
    private $blocks;

    private $currentMyFunc;
    private $currentContextCall;
    private $currentMyBlock;

    public function __construct()
    {
        $this->currentMyFunc = null;
        $this->currentContextCall = null;
        $this->currentMyBlock = null;

        $this->defs = null;
        $this->blocks = null;
    }

    public function funcCall(
        $instruction,
        $funcName,
        $myFuncCall
    ) {
        $hasSources = false;
                 
        $listMyFunc = [];

        IncludeAnalysis::funccall(
            $this->context,
            $this->blocks,
            $this->defs,
            $instruction
        );

        $stackClass = null;
        if ($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $stackClass = ResolveDefs::funccallClass(
                $this->context,
                $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                $myFuncCall,
                $instruction
            );

            $classOfFuncCallArr = $stackClass[0];

            foreach ($classOfFuncCallArr as $classOfFuncCall) {
                $objectId = $classOfFuncCall->getObjectId();
                $myClass = $this->context->getObjects()->getMyClassFromObject($objectId);

                if (!is_null($myClass)) {
                    $visibility = true;
                    $method = $myClass->getMethod($funcName);
                    
                    if (!ResolveDefs::getVisibilityMethod($myFuncCall->getNameInstance(), $method)) {
                        $method = null;
                        $visibility = false;
                    }

                    if (!is_null($method)) {
                        // we assign the object of the instance to this->
                        $method->getThisDef()->getCurrentState()->setObjectId($objectId);
                    }
                               
                    $listMyFunc[] = [$objectId, $myClass, $method, $visibility, $classOfFuncCall];
                }
            }
        } elseif ($myFuncCall->isType(MyFunction::TYPE_FUNC_STATIC)) {
            $myClassStatic = $this->context->getClasses()->getMyClass(
                $myFuncCall->getNameInstance()
            );

            if (!is_null($myClassStatic)) {
                $visibility = true;
                $method = $myClassStatic->getMethod($funcName);

                if (!ResolveDefs::getVisibilityMethod(
                    $myFuncCall->getNameInstance(),
                    $method
                )) {
                    $method = null;
                    $visibility = false;
                }

                $listMyFunc[] = [0, $myClassStatic, $method, $visibility, null];

                $myDefStatic = new MyDefinition(
                    $this->context->getCurrentBlock()->getId(),
                    $this->context->getCurrentMyFile(),
                    $myFuncCall->getLine(),
                    $myFuncCall->getColumn(),
                    "static"
                );

                $idObjectTmp = $this->context->getObjects()->addObject();
                $myDefStatic->getCurrentState()->setObjectId($idObjectTmp);
                $this->context->getObjects()->addMyclassToObject($idObjectTmp, $myClassStatic);
                                
                $stackClass[0][0] = $myDefStatic;
            }
        } else {
            $myFunc = $this->context->getFunctions()->getFunction($funcName);
            $listMyFunc[] = [0, null, $myFunc, true, null];
        }

        foreach ($listMyFunc as $list) {
            $objectId = $list[0];
            $myClass = $list[1];
            $myFunc = $list[2];
            $visibility = $list[3];
            $instance = $list[4];

            \progpilot\Analysis\CustomAnalysis::mustVerifyDefinition(
                $this->context,
                $instruction,
                $myFuncCall,
                $myClass
            );

            if (!is_null($myFunc) && !$this->context->inCallStack($myFunc)) {
                // the called function is a method and this method exists in the class
                if (($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)
                    || $myFuncCall->isType(MyFunction::TYPE_FUNC_STATIC))
                        && $myFunc->isType(MyFunction::TYPE_FUNC_METHOD)
                            || ((!$myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)
                                && !$myFuncCall->isType(MyFunction::TYPE_FUNC_STATIC))
                                    && !$myFunc->isType(MyFunction::TYPE_FUNC_METHOD))) {
                    // we don't visit twice function with a long execution time
                    if (HelpersAnalysis::checkIfOneFunctionArgumentIsNew($myFunc, $instruction)
                        || !$myFunc->isVisited()
                            || ($myFunc->isType(MyFunction::TYPE_FUNC_METHOD)
                                && !$myFunc->isType(MyFunction::TYPE_FUNC_STATIC))
                                    || $myFunc->hasGlobalVariables()
                                        || $myFunc->getName() === "{main}") {
                        // we clean all the param of the function
                        $funcCallBack = "Callbacks::cleanTaintedDef";
                        HelpersAnalysis::forAllDefsOfFunction($funcCallBack, $myFunc);

                        $myFunc->cleanOpInformations();

                        // we propagate the taint to the params
                        FuncAnalysis::funccallBefore($myFunc, $instruction);
                    
                        // we clean all the param of the function
                        // except return defs see functions21.php test case
                        $funcCallBack = "Callbacks::addStateDefAsAPastArgument";
                        HelpersAnalysis::forAllArgumentsOfFunction($funcCallBack, $myFunc, $instruction);

                        $myFunc->setIsVisited(true);
                        $myFunc->reset();

                        $myCodefunction = new MyCode;
                        $myCodefunction->setCodes($myFunc->getMyCode()->getCodes());
                        $myCodefunction->setStart(0);
                        $myCodefunction->setEnd(count($myFunc->getMyCode()->getCodes()));

                        $this->analyzeFunc($myFunc, $myFuncCall);

                        if ($myFunc->hasGlobalVariables()) {
                            // we don't want to visit it a second time, it's an approximation for performance
                            $myFunc->setHasGlobalVariables(false);

                            foreach ($myFunc->getReturnDefs() as $returnDef) {
                                $returnDefCopy = deep_copy($returnDef);
                                $myFunc->addInitialReturnDef($returnDefCopy);
                            }
                        }
                    } else {
                        $funcCallBack = "Callbacks::addAttributesOfInitialReturnDefs";
                        HelpersAnalysis::forAllReturnDefsOfFunction($funcCallBack, $myFunc);
                    }
                }
            }

            FuncAnalysis::funccallAfter(
                $myFunc,
                $this->context,
                $myClass,
                $myFuncCall,
                $instruction
            );

            $classOfFuncCall = null;
            if (is_null($myFunc)) {
                // representations start
                $this->context->outputs->callgraphAddFuncCall(
                    $this->currentMyFunc,
                    $this->currentMyBlock,
                    $myFuncCall,
                    $myClass
                );
            // representations end
            } else {
                // representations start
                foreach ($myFunc->getBlocks() as $myBlock) {
                    $this->context->outputs->callgraphAddChild(
                        $this->currentMyFunc,
                        $this->currentMyBlock,
                        $myBlock
                    );
                    $this->context->outputs->cfgAddEdge(
                        $this->currentMyFunc,
                        $this->currentMyBlock,
                        $myBlock
                    );
                    break;
                }

                $this->context->outputs->callgraphAddFuncCall(
                    $this->currentMyFunc,
                    $this->currentMyBlock,
                    $myFuncCall,
                    $myClass
                );
                // representations end
            }
        }
    }

    public function getMyblock($context)
    {
        $this->context = $context;
    }

    public function setContext($context)
    {
        $this->context = $context;
    }

    public function fetchVariable($variable)
    {
        $defsFound = ResolveDefs::selectDefinitions(
            $this->context,
            $this->defs->getOutMinusKill($this->currentMyBlock->getId()),
            $variable
        );

        $newDefFounds = [];
        foreach ($defsFound as $defFound) {
            $newDefFounds[] = $defFound;
        }

        return $newDefFounds;
    }

    public function analyzeFunc($myFunc, $myFuncCalled = null)
    {
        if (HelpersAnalysis::checkIfTimeExecutionIsAcceptable($this->context, $myFunc)) {
            $this->context->outputs->createRepresentationsForFunction($myFunc);

            $startTime = microtime(true);

            $this->currentContextCall = new \stdClass;
            $this->currentContextCall->func_called = $myFuncCalled;
            $this->currentContextCall->func_callee = $this->currentMyFunc;

            $this->currentMyFunc = $myFunc;
            $this->context->setCurrentFunc($this->currentMyFunc);

            $this->defs = $this->currentMyFunc->getDefs();
            $this->blocks = $this->currentMyFunc->getBlocks();

            $val = [$this->currentMyFunc,
                    $this->blocks,
                        $this->defs,
                            $this->currentContextCall];
                                            
            $this->context->pushToCallStack($val);

            // for the properties data flow
            $firstBlockIdCalled = $this->currentMyFunc->getFirstBlockId();
            $firstMyBlockCalled = $this->currentMyFunc->getBlockById($firstBlockIdCalled);
            $blockOfCallee = $this->currentMyBlock;

            if (!is_null($firstMyBlockCalled)
                            && !is_null($blockOfCallee)) {
                $firstMyBlockCalled->setVirtualParents([$blockOfCallee]);
                $firstMyBlockCalled->setNeedUpdateOfState(true);
            }


            if ($this->currentMyFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                $myClass = $this->currentMyFunc->getMyClass();
                if (!is_null($myClass)) {
                    $constructor = $myClass->getMethod("__construct");
                    if (!is_null($constructor)) {
                        $lastBlockIdConstuctor = $constructor->getFirstBlockId();
                        $lastMyBlockConstuctor = $constructor->getBlockById($lastBlockIdConstuctor);

                        if (!is_null($firstMyBlockCalled)
                                        && !is_null($lastMyBlockConstuctor)) {
                            $firstMyBlockCalled->addVirtualParent($lastMyBlockConstuctor);
                        }
                    }

                    $thisDef = $this->currentMyFunc->getThisDef();
                    if ($thisDef->getCurrentState()->getObjectId() === -1) {
                        // we enter in a method with no instance
                        // to analyze frameworks (see frameworks/codeigniter1.php)
                        // we need a default "this"
                        $idObject = $this->context->getObjects()->addObject();
                        $thisDef->getCurrentState()->setObjectId($idObject);
                        $myClass = clone $myClass;
                    
                        $this->context->getObjects()->addMyclassToObject($idObject, $myClass);
                    }
                }
            }
            // end

            $this->currentMyFunc->setStartExecutionTime(microtime(true));
            $this->currentMyFunc->setNbExecutions($this->currentMyFunc->getNbExecutions() + 1);

            $error = false;
            foreach ($myFunc->getBlocks() as $myBlock) {
                if (!$this->analyzeblock($myFunc, $myBlock)) {
                    $error = true;
                    break;
                }
            }

            foreach ($myFunc->getBlocks() as $myBlock) {
                $myBlock->setHasBeenAnalyzed(false);
            }

            $diffTime = microtime(true) - $myFunc->getStartExecutionTime();
            $myFunc->setLastExecutionTime($diffTime);

            if ($myFunc->getName() === "{main}") {
                // free memory
                unset($myFunc);
                return;
            }

            $this->context->popFromCallStack();

            $callStack = $this->context->getCallStack();
            if (!empty($callStack)) {
                $lastElement = $callStack[count($callStack) -1];

                $this->currentContextCall = $lastElement[3];
                $this->defs = $lastElement[2];
                $this->blocks = $lastElement[1];
                $this->currentMyFunc = $lastElement[0];
                $this->context->setCurrentFunc($this->currentMyFunc);


                $this->currentMyBlock = $blockOfCallee;
                $this->context->setCurrentBlock($this->currentMyBlock);

                // for the states data flow
                $lastBlockIdsCalled = $myFunc->getLastBlockIds();
                foreach ($lastBlockIdsCalled as $lastBlockIdCalled) {
                    $lastMyBlockCalled = $myFunc->getBlockById($lastBlockIdCalled);
                    // "leave block" has popped the callee block normally
                    $blockOfCallee = $this->currentMyBlock;

                    if (!is_null($lastMyBlockCalled) && !is_null($blockOfCallee)) {
                        // we add a new parent and remove the old parents
                        // because the new parent kill the others
                        // see oop/simple13.php
                        $blockOfCallee->setVirtualParents([$lastMyBlockCalled]);
                        $blockOfCallee->setNeedUpdateOfState(true);
                    }
                }

                $returnDefs = $myFunc->getReturnDefs();
                foreach ($returnDefs as $returnDef) {
                    $state = $returnDef->getCurrentState();
                    $currentBlockId = $this->context->getCurrentBlock()->getId();
                    $returnDef->assignStateToBlockId($state->getId(), $currentBlockId);
                }

                // we enter in a new block this "it's a blockswitching" and we need to update states
                // of the previous function we just left
                HelpersState::blockSwitching($this->context, $myFunc);
                // end
            }

            // memory could has been released
            if (!$error) {
                $tmpCallgraph = $this->context->outputs->callgraph[$myFunc->getId()];
                $tmpCallgraph->computeCallGraph();
                \progpilot\Analysis\CustomAnalysis::mustVerifyCallFlow($this->context, $tmpCallgraph);
            }
        }
    }


    public function analyzeblock($myFunc, $myBlock, $blockStack = [])
    {
        $myBlock->setHasBeenAnalyzed(false);

        $myFunc->getMyCode()->setStart($myBlock->getStartAddressBlock());
        $myFunc->getMyCode()->setEnd($myBlock->getEndAddressBlock());

        return $this->analyzecode($myFunc->getMyCode(), $blockStack, true);
    }

    public function analyzecode($myCode, $blockStack, $fromParent = false)
    {
        $startTime = microtime(true);
        $index = $myCode->getStart();
        $code = $myCode->getCodes();
        $originalFlow = [];

        do {
            if (isset($code[$index])) {
                $instruction = $code[$index];

                if ((microtime(true) - $startTime) > $this->context->getMaxFileAnalysisDuration()) {
                    Utils::printWarning($this->context, Lang::MAX_TIME_EXCEEDED);
                    return false;
                }

                if (HelpersAnalysis::checkCallStackReachMaxTime($this->context)) {
                    Utils::printWarning($this->context, Lang::MAX_TIME_EXCEEDED);
                    return false;
                }

                if (memory_get_usage() > ($this->context->getMaxMemory() / 2)) {
                    Utils::printWarning($this->context, Lang::MAX_MEMORY_EXCEEDED);
                    $this->context->resetDataflow();
                    $this->context->outputs->resetRepresentationsForAllFunctions();
                    return false;
                }

                $ret = $this->context->getCurrentFunc()->getNbsOpInformations();
                if ($ret > 1000) {
                    $this->context->getCurrentFunc()->cleanOpInformations();
                    return false;
                }

                // needed to have a proper opinformation eachtime:
                $opInformation["chained_results"] = [];

                if ($instruction->getOpcode() !== Opcodes::ARRAYDIM_FETCH
                    && $instruction->getOpcode() !== Opcodes::PROPERTY_FETCH) {
                    $originalFlow = [];
                }

                switch ($instruction->getOpcode()) {
                    case Opcodes::ENTER_BLOCK:
                        $myBlock = $instruction->getProperty(MyInstruction::MYBLOCK);
                        if ($myBlock->hasBeenAnalyzed() || !$fromParent) {
                            $index = $myBlock->getEndAddressBlock();
                            break;
                        }

                        // we remove this parent because it's a loop while(block1) block2
                        // and block1 must be analysis before block2
                        array_push($blockStack, $myBlock->getId());

                        foreach ($myBlock->parents as $blockParent) {
                            // if not in the stack (it's not a loop)
                            if ($blockParent->getId() !== $myBlock->getId()
                                && !$myBlock->isLoopParent($blockParent)
                                    && !$blockParent->hasBeenAnalyzed()
                                        && !in_array($blockParent->getId(), $blockStack, true)) {
                                $addrStart = $blockParent->getStartAddressBlock();
                                $addrEnd = $blockParent->getEndAddressBlock();

                                $oldIndexStart = $myCode->getStart();
                                $oldIndexEnd = $myCode->getEnd();

                                $myCode->setStart($addrStart);
                                $myCode->setEnd($addrEnd);

                                $this->analyzecode($myCode, $blockStack, $fromParent);

                                $myCode->setStart($oldIndexStart);
                                $myCode->setEnd($oldIndexEnd);
                            }
                        }
                        
                        $fromParent = false;

                        $this->currentMyBlock = $myBlock;
                        $this->context->setCurrentBlock($myBlock);

                        // we enter in a new block this "it's a blockswitching" and we need to update states
                        $myBlock->setHasBeenAnalyzed(true);
                        $myBlock->setNeedUpdateOfState(true);

                        HelpersState::blockSwitching($this->context, $this->currentMyFunc);
                        break;
                    

                    case Opcodes::LEAVE_BLOCK:
                        $myBlock = $instruction->getProperty(MyInstruction::MYBLOCK);
                        array_pop($blockStack);

                        if (!empty($blockStack)) {
                            $this->currentMyBlock = $blockStack[count($blockStack) - 1];
                            $this->context->setCurrentBlock($this->currentMyBlock);
                        }

                        // a block can "now" be visited twice (loops), so we put virtual parents added when visiting
                        // functions for instance to the original one
                        $myBlock->setVirtualParents($myBlock->getParents());

                        break;

                    
                    case Opcodes::CONCAT_LEFT:
                        $leftid = $instruction->getProperty(MyInstruction::LEFTID);
                        $rightids = $instruction->getProperty(MyInstruction::RIGHTID);
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

                        $chars = ["'", "<", ">"];

                        $leftOpInformation = $this->context->getCurrentFunc()->getOpInformation($leftid);

                        $opInformation = [];
                        $opInformation["chained_results"] = [];
                        $vars["chained_results"] = [];

                        $lastNbChars = HelpersAnalysis::getNbChars("", $chars);

                        $leftValues = [];
                        if (isset($leftOpInformation["chained_results"])) {
                            foreach ($leftOpInformation["chained_results"] as $chainedResult) {
                                if (!is_null($chainedResult->getCurrentState())) {
                                    $curLastKnownValues = $chainedResult->getCurrentState()->getLastKnownValues();
                                    foreach ($curLastKnownValues as $curLastKnownValue) {
                                        $leftValues[] = $curLastKnownValue;
                                    }

                                    if (isset($curLastKnownValues[0])) {
                                        HelpersAnalysis::updateNbChars($lastNbChars, $curLastKnownValues[0], $chars);
                                    }

                                    if (!in_array($chainedResult, $vars["chained_results"], true)
                                    && count($vars["chained_results"]) < 20) {
                                        $vars["chained_results"][] = $chainedResult;
                                    }
                                }
                            }
                        }
                        
                        $rightValuesSets = [];
                        foreach ($rightids as $rightid) {
                            $rightOpInformation = $this->context->getCurrentFunc()->getOpInformation($rightid);
                            $rightValuesSet = [];
                            if (isset($rightOpInformation["chained_results"])
                                && !empty($rightOpInformation["chained_results"])) {
                                foreach ($rightOpInformation["chained_results"] as $chainedResult) {
                                    $curLastKnownValues = $chainedResult->getCurrentState()->getLastKnownValues();
                                    $rightValuesSet[] = $curLastKnownValues;
                                    $chainedResult->getCurrentState()->updateIsEmbeddedByChars($lastNbChars);

                                    if (isset($curLastKnownValues[0])) {
                                        HelpersAnalysis::updateNbChars($lastNbChars, $curLastKnownValues[0], $chars);
                                    }

                                    if (!in_array($chainedResult, $vars["chained_results"], true)
                                        && count($vars["chained_results"]) < 20) {
                                        $vars["chained_results"][] = $chainedResult;
                                    }
                                }
                            } else {
                                $rightValuesSet[] = "";
                            }

                            $rightValuesSets[] = $rightValuesSet;
                        }

                        if (empty($leftValues)) {
                            $leftValues = [];
                            $leftValues[] = "";
                        }

                        $i = 1;
                        $possibleRightsParts = [];
                        $possibleRightsParts[0] = $leftValues;
                        foreach ($rightValuesSets as $rightValueSet) {
                            $possibleRightsParts[$i] = [];

                            foreach ($rightValueSet as $rightValues) {
                                if (empty($rightValues)) {
                                    $possibleRightsParts[$i][] = "";
                                } else {
                                    foreach ($rightValues as $rightValue) {
                                        // $i = 0
                                        // [0][0] = ./dvwa/
                                        // [0][1] = ./folder/

                                        // $i = 1
                                        // [1][0] = mid

                                        // $i = 2
                                        // [2][0] = low.php
                                        // [2][1] = medium.php
                                        $possibleRightsParts[$i][] = $rightValue;
                                    }
                                }
                            }

                            $i ++;
                        }

                        /*
                        big approximation
                        we took only the first value of the left parts
                        ./dvwa/mid/low.php
                        ./dvwa/mid/medium.php
                        */

                        $concats = [];
                        $lastPart = count($possibleRightsParts) - 1;
                        foreach ($possibleRightsParts[$lastPart] as $lastRightPart) {
                            $stringConcat = "";
                            for ($i = 0; $i < ($lastPart); $i ++) {
                                $stringConcat .= $possibleRightsParts[$i][0];
                            }

                            $stringConcat .= $lastRightPart;
                            $concats[] = $stringConcat;
                        }

                        $myTemp = new MyDefinition(
                            $this->context->getCurrentBlock()->getId(),
                            $this->context->getCurrentMyFile(),
                            $this->context->getCurrentLine(),
                            $this->context->getCurrentColumn(),
                            "built-in-concatenation"
                        );

                        $mergedState = HelpersState::mergeDefsBlockIdStates(
                            $vars["chained_results"],
                            $concats,
                            $this->context->getCurrentBlock()
                        );

                        $myTemp->addState($mergedState);
                        $currentBlockId = $this->context->getCurrentBlock()->getId();
                        $myTemp->assignStateToBlockId($mergedState->getId(), $currentBlockId);
                        
                        $opInformation["chained_results"][] = $myTemp;

                        //$this->context->getCurrentFunc()->cleanOpInformation($leftid);
                        foreach ($rightids as $rightid) {
                            $this->context->getCurrentFunc()->cleanOpInformation($rightid);
                        }

                        $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);

                        break;


                    case Opcodes::ARRAYDIM_FETCH:
                        $arrayDim = $instruction->getProperty(MyInstruction::ARRAY_DIM);
                        $originalDef = $instruction->getProperty(MyInstruction::ORIGINAL_DEF);

                        $varid = $instruction->getProperty(MyInstruction::VARID);
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

                        $opInformation = [];
                        $opInformation["chained_results"] = [];
                        $opInformation["array_dim"] = $arrayDim;

                        // beginning of the chain: $originalDef[0][1]
                        if (!is_null($originalDef)) {
                            $originalFlow = [];
                            $originalFlow[] = $originalDef;
                            $originalFlow[] = "[";
                            $originalFlow[] = $arrayDim;
                            $originalFlow[] = "]";

                            if ($originalDef->getName() === "GLOBALS") {
                                $globalDef = new MyDefinition(
                                    $this->context->getCurrentBlock()->getId(),
                                    $this->context->getCurrentMyFile(),
                                    $originalDef->getLine(),
                                    $originalDef->getColumn(),
                                    $arrayDim
                                );

                                $defGlobals = ResolveDefs::selectGlobals($this->context, $globalDef);
                                foreach ($defGlobals as $defGlobal) {
                                    $opInformation["chained_results"][] = $defGlobal;
                                }
                            } else {
                                // we get the last definitions
                                $defsFound = ResolveDefs::selectArrays(
                                    $this->context,
                                    $this->defs->getOutMinusKill($this->currentMyBlock->getId()),
                                    $originalDef,
                                    $arrayDim
                                );

                                foreach ($defsFound as $defFound) {
                                    // the element has just been created and right side (!expr)
                                    if ($defFound[0]) {
                                        if (HelpersAnalysis::isASource(
                                            $this->context,
                                            $originalDef,
                                            null,
                                            $arrayDim
                                        )) {
                                            foreach ($defFound[1] as $delEle) {
                                                $delEle->getCurrentState()->setTainted(true);
                                            }
                                        }
                                    }

                                    // just for the flow
                                    foreach ($defFound[1] as $delEle) {
                                        $delEle->original->setDef($originalFlow);
                                        $delEle->original->setArrayIndexAccessor($arrayDim);
                                        $opInformation["chained_results"][] = $delEle;
                                    }
                                }

                                // could be a built-in array/source
                                if (empty($defsFound)) {
                                    // right side
                                    if (HelpersAnalysis::isASource($this->context, $originalDef, null, $arrayDim)) {
                                        $originalDef->getCurrentState()->setTainted(true);
                                        // just for the flow
                                        $originalDef->original->setDef($originalFlow);
                                        $originalDef->original->setArrayIndexAccessor($arrayDim);

                                        $opInformation["chained_results"][] = $originalDef;
                                    }
                                }
                            }

                            $opInformation["original_def"] = $originalDef;

                            $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
                        } else {
                            // we are in the middle of the chain thus we can access the previous chained object
                            $previousOpInformation = $this->context->getCurrentFunc()->getOpInformation($varid);

                            if (isset($previousOpInformation["chained_results"])) {
                                foreach ($previousOpInformation["chained_results"] as $previousChainedResult) {
                                    $state = $previousChainedResult->getState($this->currentMyBlock->getId());
                                    if (!is_null($state)) {
                                        $newArrs = $state->getOrCreateDefArrayIndex(
                                            $this->currentMyBlock->getId(),
                                            $previousChainedResult,
                                            $arrayDim
                                        )[1];

                                        $previousToSlice = 3;
                                        if (str_ends_with($previousChainedResult->getName(), "_return")) {
                                            $previousToSlice = 4;
                                            $originalFlow[] = $previousChainedResult;
                                        }
                                        $originalFlow[] = "[";
                                        $originalFlow[] = $arrayDim;
                                        $originalFlow[] = "]";

                                        foreach ($newArrs as $newArr) {
                                            // just for the flow
                                            $newArr->original->setDef($originalFlow);
                                            $opInformation["chained_results"][] = $newArr;
                                        }

                                        if (count($previousOpInformation["chained_results"]) > 1) {
                                            $endEle = count($originalFlow) - $previousToSlice;
                                            $originalFlow = array_slice($originalFlow, 0, $endEle);
                                        }
                                    }
                                }
                            }

                            if (isset($previousOpInformation["original_def"])) {
                                $opInformation["original_def"] = $previousOpInformation["original_def"];
                            }

                            $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($varid);

                        break;
                    

                    case Opcodes::STATIC_PROPERTY_FETCH:
                        $propertyName = $instruction->getProperty(MyInstruction::PROPERTY_NAME);
                        $originalDef = $instruction->getProperty(MyInstruction::ORIGINAL_DEF);

                        $varid = $instruction->getProperty(MyInstruction::VARID);
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

                        // beginning of the chain: $originalDef->foo->bar
                        if (!is_null($originalDef)) {
                            $originalFlow = [];
                            $originalFlow[] = $originalDef;
                            $originalFlow[] = "::";
                            $originalFlow[] = $propertyName;

                            $originalDef->setId(0);
                            $defFound = ResolveDefs::selectStaticProperties(
                                $this->context,
                                $originalDef,
                                $propertyName
                            );

                            if (!is_null($defFound)) {
                                // just for the flow
                                $defFound->original->setDef($originalFlow);
                                $opInformation["chained_results"][] = $defFound;
                                $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
                            }
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($varid);

                        break;


                    case Opcodes::PROPERTY_FETCH:
                        $propertyName = $instruction->getProperty(MyInstruction::PROPERTY_NAME);
                        $originalDef = $instruction->getProperty(MyInstruction::ORIGINAL_DEF);

                        $varid = $instruction->getProperty(MyInstruction::VARID);
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

                        $opInformation = [];
                        $opInformation["chained_results"] = [];
                        $opInformation["array_dim"] = null;

                        // beginning of the chain: $originalDef->foo->bar
                        if (!is_null($originalDef)) {
                            $originalFlow[] = $originalDef;
                            $originalFlow[] = "->";
                            $originalFlow[] = $propertyName;

                            $originalDef->setId(0);
                            $defsFound = ResolveDefs::selectProperties(
                                $this->context,
                                $this->defs->getOutMinusKill($this->currentMyBlock->getId()),
                                $originalDef,
                                $propertyName
                            );

                            foreach ($defsFound as $defFoundArr) {
                                $defFound = $defFoundArr[0];
                                $myClassFound = $defFoundArr[1];
                                if (HelpersAnalysis::isASource($this->context, $defFound, $myClassFound, null)) {
                                    $defFound->getCurrentState()->setTainted(true);
                                }

                                \progpilot\Analysis\CustomAnalysis::defineObject(
                                    $this->context,
                                    $instruction,
                                    $defFound,
                                    $myClassFound,
                                    null
                                );

                                // just for the flow
                                $defFound->original->setDef($originalFlow);
                                $opInformation["chained_results"][] = $defFound;
                            }

                            $opInformation["original_def"] = $originalDef;
                        } else {
                            $originalFlow[] = "->";
                            $originalFlow[] = $propertyName;
                            // we are in the middle of the chain thus we can access the previous chained object
                            $previousOpInformation = $this->context->getCurrentFunc()->getOpInformation($varid);
                            
                            if (isset($previousOpInformation["original_def"])) {
                                $opInformation["original_def"] = $previousOpInformation["original_def"];
                            }

                            if (isset($previousOpInformation["chained_results"])) {
                                foreach ($previousOpInformation["chained_results"] as $previousChainedResult) {
                                    $state = $previousChainedResult->getState($this->currentMyBlock->getId());
                                    if (!is_null($state)) {
                                        $idObject = $state->getObjectId();
                                        $tmpMyClass = $this->context->getObjects()->getMyClassFromObject($idObject);

                                        if (!is_null($tmpMyClass)) {
                                            $property = $tmpMyClass->getProperty(
                                                $this->context,
                                                $this->currentMyBlock->getId(),
                                                $previousChainedResult,
                                                $propertyName
                                            );

                                            if (!is_null($property)
                                                && ResolveDefs::getVisibility(
                                                    $previousChainedResult,
                                                    $property,
                                                    $this->context->getCurrentFunc()
                                                )) {
                                                $opInformation["chained_results"][] = $property;
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($varid);
                        $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);

                        break;
        

                    case Opcodes::LITERAL_FETCH:
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                        $def = $instruction->getProperty(MyInstruction::DEF);
    
                        $opInformation = $this->context->getCurrentFunc()->getOpInformation($resultid);

                        $opInformation["chained_results"][] = $def;

                        $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
                
                        break;
        

                    case Opcodes::CONST_FETCH:
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                        $def = $instruction->getProperty(MyInstruction::DEF);

                        $opInformation = $this->context->getCurrentFunc()->getOpInformation($resultid);

                        $defFounds = $this->fetchVariable($def);
                        if (empty($defFounds)) {
                            $opInformation["chained_results"][] = $def;
                        } else {
                            foreach ($defFounds as $defFound) {
                                if ($defFound->isType(MyDefinition::TYPE_CONSTANTE)) {
                                    $opInformation["chained_results"][] = $defFound;
                                }
                            }
                        }
                            
                        $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
                        
                        break;


                    case Opcodes::ITERATOR:
                        $varid = $instruction->getProperty(MyInstruction::VARID);
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);

                        $opDataVar = $this->context->getCurrentFunc()->getOpInformation($varid);

                        $opInformation = [];
                        $opInformation["iterator"][] = true;

                        if (!is_null($opDataVar) && isset($opDataVar["chained_results"])) {
                            foreach ($opDataVar["chained_results"] as $chainedResult) {
                                $state = $chainedResult->getCurrentState();
                                if (!is_null($state)) {
                                    if ($state->isType(MyDefinition::TYPE_ARRAY)
                                    && !$state->isType(MyDefinition::TYPE_INSTANCE)) {
                                        foreach ($state->getArrayIndexes() as $arrayIndex) {
                                            $element = $arrayIndex->def;
                                            $opInformation["chained_results"][] = $element;
                                        }
                                    } elseif (($state->isType(MyDefinition::TYPE_INSTANCE)
                                    && $state->isType(MyDefinition::TYPE_ARRAY)) ||
                                    $state->isType(MyDefinition::TYPE_ARRAY_ARRAY)) {
                                        // probably a source arrayofobjects arrayofarrays
                                        if ($state->isType(MyDefinition::ALL_PROPERTIES_TAINTED)) {
                                            $opInformation["chained_results"][] = $chainedResult;
                                        } elseif ($state->isType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED)) {
                                            $opInformation["chained_results"][] = $chainedResult;
                                        }
                                    }
                                }
                            }
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($varid);
                        $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);

                        break;


                    case Opcodes::VARIABLE_FETCH:
                        $varid = $instruction->getProperty(MyInstruction::VARID);
                        $exprid = $instruction->getProperty(MyInstruction::EXPRID);
                        $variable = $instruction->getProperty(MyInstruction::DEF);

                        $id = is_null($varid) ? $exprid : $varid;

                        $opInformation = [];

                        $newDefFounds = [];
                        $defFounds = $this->fetchVariable($variable);

                        foreach ($defFounds as $defFound) {
                            if ($defFound->isType(MyDefinition::TYPE_GLOBAL)) {
                                $defGlobals = ResolveDefs::selectGlobals($this->context, $defFound);
                                foreach ($defGlobals as $defGlobal) {
                                    $newDefFounds[] = $defGlobal;
                                }
                            } elseif ($defFound->isType(MyDefinition::TYPE_REFERENCE)) {
                                foreach ($defFound->getRefs() as $ref) {
                                    // a classic (not array/property) could have been overwritten
                                    // we should search for the last variables

                                    if (!$ref->isType(MyDefinition::TYPE_ARRAY_ELEMENT)
                                        && !$ref->isType(MyDefinition::TYPE_PROPERTY)) {
                                        $refbis = clone $ref;
                                        $refbis->setBlockId($variable->getBlockId());
                                        $refbis->setLine($variable->getLine());
                                        $refbis->setColumn($variable->getColumn());
                                        $defFoundsRef = $this->fetchVariable($refbis);
                                        foreach ($defFoundsRef as $refBis) {
                                            $newDefFounds[] = $refBis;
                                        }
                                    } else {
                                        $newDefFounds[] = $ref;
                                    }
                                }
                            } elseif ($defFound->isType(MyDefinition::TYPE_ITERATOR)) {
                                foreach ($defFound->getIteratorValues() as $iteratorValue) {
                                    // just for the flow
                                    $originalFlow = [];
                                    $originalFlow[] = $variable;
                                    $iteratorValue->original->setDef($originalFlow);
                                    $newDefFounds[] = $iteratorValue;
                                }
                            } else {
                                $newDefFounds[] = $defFound;
                            }
                        }

                        if (empty($defFounds)) {
                            // could be a built-in sources
                            // phpwander/test3.php

                            $source = $this->context->inputs->getSourceByName($variable, null, null);
                            if (!is_null($source)) {
                                if ($source->getIsArray() && empty($source->getArrayValue())) {
                                    $variable->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);
                                    $variable->getCurrentState()->addType(MyDefinition::ALL_ARRAY_ELEMENTS_TAINTED);
                                    $newDefFounds[] = $variable;
                                }
                            }
                        }
                        
                        $opInformation = [];
                        $opInformation["chained_results"] = $newDefFounds;
                        $opInformation["original_def"] = $variable;
                        $opInformation["array_dim"] = null;

                        /* what to clean?? */
                        $this->context->getCurrentFunc()->cleanOpInformation($varid);
                        $this->context->getCurrentFunc()->cleanOpInformation($exprid);
                        $this->context->getCurrentFunc()->storeOpInformation($id, $opInformation);
    
                        break;
                    

                    case Opcodes::ARGUMENT:
                        $varid = $instruction->getProperty(MyInstruction::VARID);
                        $idparam = $instruction->getProperty("idparam");
                        $def = $instruction->getProperty("argdef$idparam");
        
                        $opDataVar = $this->context->getCurrentFunc()->getOpInformation($varid);
                        $concatValues = isset($opDataVar["concats_values"]) ? $opDataVar["concats_values"] : [];

                        if (isset($opDataVar["chained_results"])) {
                            $mergedState = HelpersState::mergeDefsBlockIdStates(
                                $opDataVar["chained_results"],
                                $concatValues,
                                $this->context->getCurrentBlock()
                            );

                            $def->addState($mergedState);
                            $currentBlockId =  $this->context->getCurrentBlock()->getId();
                            $def->assignStateToBlockId($mergedState->getId(), $currentBlockId);
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($varid);

                        break;


                    case Opcodes::END_ASSIGN:
                        $varid = $instruction->getProperty(MyInstruction::VARID);
                        $exprid = $instruction->getProperty(MyInstruction::EXPRID);
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                        $def = $instruction->getProperty(MyInstruction::DEF);
                        $literal = $instruction->getProperty(MyInstruction::LITERAL);
                        $reference = $instruction->getProperty(MyInstruction::REFERENCE);

                        $opVarData = $this->context->getCurrentFunc()->getOpInformation($varid);
                        $opExprData = $this->context->getCurrentFunc()->getOpInformation($exprid);
                        $opResultData = $this->context->getCurrentFunc()->getOpInformation($resultid);

                        $concatValues = isset($opExprData["concats_values"]) ? $opExprData["concats_values"] : [];

                        if (is_null($opExprData) && !is_null($literal)) {
                            $opExprData["chained_results"] = [];
                            $opExprData["chained_results"][] = $literal;
                        }

                        // return function $def case for instance
                        if (is_null($opVarData) && !is_null($def)) {
                            $opVarData["chained_results"] = [];
                            $opVarData["chained_results"][] = $def;
                        }

                        // don't need to resolve variable we have already access to it
                        // ssa = 1) result=var3 2) expr=var3
                        if (!is_null($opExprData) && isset($opExprData["chained_results"])) {
                            $mergedState = HelpersState::mergeDefsBlockIdStates(
                                $opExprData["chained_results"],
                                $concatValues,
                                $this->context->getCurrentBlock()
                            );

                            if (!is_null($opVarData) && isset($opVarData["chained_results"])) {
                                foreach ($opVarData["chained_results"] as $chainedResult) {
                                    if (isset($opExprData["iterator"]) && $opExprData["iterator"]) {
                                        $chainedResult->addType(MyDefinition::TYPE_ITERATOR);
                                        $chainedResult->setIteratorValues($opExprData["chained_results"]);
                                    } else {
                                        if ($chainedResult->getNbStates() < 20) {
                                            $chainedResult->addState($mergedState);
                                            $currentBlockId = $this->context->getCurrentBlock()->getId();
                                            $chainedResult->assignStateToBlockId(
                                                $mergedState->getId(),
                                                $currentBlockId
                                            );

                                            if ($reference) {
                                                $chainedResult->addType(MyDefinition::TYPE_REFERENCE);
                                                $chainedResult->setRefs($opExprData["chained_results"]);
                                            }
                                        }
                                    }
                                    $opResultData["chained_results"][] = $chainedResult;
                                }
        
                                $this->context->getCurrentFunc()->storeOpInformation($resultid, $opResultData);
                            }
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($varid);
                        $this->context->getCurrentFunc()->cleanOpInformation($exprid);

                        break;
                    

                    case Opcodes::CAST:
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                        $exprid = $instruction->getProperty(MyInstruction::EXPRID);
                        $typeCast = $instruction->getProperty("type_cast");
    
                        $rightOpInformation = $this->context->getCurrentFunc()->getOpInformation($exprid);
                        $leftOpInformation =
                            $this->context->getCurrentFunc()->getOpInformation($resultid);
    
                        if (isset($rightOpInformation["chained_results"])
                            && $typeCast === MyDefinition::CAST_NOT_SAFE) {
                            foreach ($rightOpInformation["chained_results"] as $chainedResult) {
                                $leftOpInformation["chained_results"][] = $chainedResult;
                            }

                            $this->context->getCurrentFunc()->storeOpInformation($resultid, $leftOpInformation);
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($exprid);
    
                        break;



                    case Opcodes::COND_BOOLEAN_NOT:
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                        $exprid = $instruction->getProperty(MyInstruction::EXPRID);

                        $rightOpInformation = $this->context->getCurrentFunc()->getOpInformation($exprid);
                        $rightOpInformation["not_boolean"] = true;

                        $this->context->getCurrentFunc()->storeOpInformation($resultid, $rightOpInformation);
                        $this->context->getCurrentFunc()->cleanOpInformation($exprid);

                        break;



                    case Opcodes::BINARYOP:
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                        $leftid = $instruction->getProperty(MyInstruction::LEFTID);
                        $rightid = $instruction->getProperty(MyInstruction::RIGHTID);
    
                        $leftOpInformation = $this->context->getCurrentFunc()->getOpInformation($leftid);
                        $rightOpInformation = $this->context->getCurrentFunc()->getOpInformation($rightid);
                        
                        $opInformation = [];
                        $opInformation["condition_defs"] = [];

                        if (isset($leftOpInformation["condition_defs"])) {
                            $opInformation["condition_defs"] = $leftOpInformation["condition_defs"];
                        }
                        
                        if (isset($rightOpInformation["condition_defs"])) {
                            $opInformation["condition_defs"] =
                                array_merge($rightOpInformation["condition_defs"], $opInformation["condition_defs"]);
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($leftid);
                        $this->context->getCurrentFunc()->cleanOpInformation($rightid);
                        $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
    
                        break;


                    case Opcodes::COND_START_IF:
                        $conds = $instruction->getProperty(MyInstruction::EXPRID);
                        $myBlockIf = $instruction->getProperty(MyInstruction::MYBLOCK_IF);
                        $myBlockElse = $instruction->getProperty(MyInstruction::MYBLOCK_ELSE);
                        $opExprData = $this->context->getCurrentFunc()->getOpInformation($conds);
                        
                        $validwhenreturning = true;
                        if (isset($opExprData["valid_when_returning"])) {
                            $validwhenreturning = $opExprData["valid_when_returning"];
                        }

                        $notboolean = false;
                        if (isset($opExprData["not_boolean"])
                            && $opExprData["not_boolean"]) {
                            $notboolean = true;
                            $block = $validwhenreturning ? $myBlockElse : $myBlockIf;
                        } else {
                            $block = $validwhenreturning ? $myBlockIf : $myBlockElse;
                        }

                        if (!is_null($opExprData) && isset($opExprData["condition_defs"])) {
                            foreach ($opExprData["condition_defs"] as $chainedResult) {
                                $callback = "Callbacks::addValidAssertion";
                                HelpersAnalysis::forEachTaintedByDefs($chainedResult, $block, $callback);
                            }
                        }

                        foreach ($block->getReturnDefs() as $defReturn) {
                            $defReturn->setReturnedFromValidator(true);
                            $defReturn->setValidWhenReturning($validwhenreturning);
                            $defReturn->setValidNotBoolean($notboolean);
                        }

                        $this->context->getCurrentFunc()->cleanOpInformation($conds);

                        break;
                        

                    case Opcodes::ARRAY_EXPR:
                        $resultid = $instruction->getProperty(MyInstruction::RESULTID);
                        $opInformation = $this->context->getCurrentFunc()->getOpInformation($resultid);
                        $nbkeys = $instruction->getProperty("nbkeys");

                        for ($i = 0; $i < $nbkeys; $i ++) {
                            $valueid = $instruction->getProperty("value".$i);
                            $keyid = $instruction->getProperty("key".$i);

                            $keyData = $this->context->getCurrentFunc()->getOpInformation($keyid);
                            $valueData = $this->context->getCurrentFunc()->getOpInformation($valueid);

                            $keys = [];
                            
                            if (!is_null($keyData) && isset($keyData["chained_results"])) {
                                foreach ($keyData["chained_results"] as $chainedResult) {
                                    $lastKnownValues = $chainedResult->getCurrentState()->getLastKnownValues();
                                    foreach ($lastKnownValues as $lastKnownValue) {
                                        $keys[] = $lastKnownValue;
                                    }
                                }
                            } else {
                                $keys[] = $i;
                            }

                            $valuesDef = [];
                            if (!is_null($valueData) && isset($valueData["chained_results"])) {
                                foreach ($valueData["chained_results"] as $chainedResult) {
                                    $valuesDef[] = $chainedResult;
                                }
                            }

                            $myTemp = new MyDefinition(
                                $this->context->getCurrentBlock()->getId(),
                                $this->context->getCurrentMyFile(),
                                $this->context->getCurrentLine(),
                                $this->context->getCurrentColumn(),
                                "tmp_array"
                            );

                            $myTemp->getCurrentState()->addType(MyDefinition::TYPE_ARRAY);

                            foreach ($keys as $key) {
                                $newEle = $myTemp->getCurrentState()->createDefArrayIndex(
                                    $myTemp->getBlockId(),
                                    $myTemp,
                                    $key
                                )[1][0];

                                $mergedState = HelpersState::mergeDefsBlockIdStates(
                                    $valuesDef,
                                    [],
                                    $this->context->getCurrentBlock()
                                );

                                $newEle->addState($mergedState);
                                $currentBlockId = $this->context->getCurrentBlock()->getId();
                                $newEle->assignStateToBlockId($mergedState->getId(), $currentBlockId);
                            }

                            $opInformation["chained_results"][] = $myTemp;

                            $this->context->getCurrentFunc()->cleanOpInformation($keyid);
                            $this->context->getCurrentFunc()->cleanOpInformation($valueid);
                            $this->context->getCurrentFunc()->storeOpInformation($resultid, $opInformation);
                        }

                        break;


                    case Opcodes::FUNC_CALL:
                        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
                        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

                        if ($funcName === "call_user_func" || $funcName === "call_user_func_array") {
                            if ($instruction->isPropertyExist("argdef0")) {
                                $defArg = $instruction->getProperty("argdef0");
                                
                                $newInst = new MyInstruction(Opcodes::FUNC_CALL);
                        
                                $myFunctionCall = new MyFunction("tmp");
                                $myFunctionCall->setLine($myFuncCall->getLine());
                                $myFunctionCall->setColumn($myFuncCall->getColumn());
                                $myFunctionCall->setSourceMyFile($myFuncCall->getSourceMyFile());
                                    
                                if ($funcName === "call_user_func") {
                                    for ($nbParams = 1; $nbParams < $myFuncCall->getNbParams(); $nbParams ++) {
                                        $oldDefArg = $instruction->getProperty("argdef$nbParams");
                                        
                                        $newNbParams = $nbParams - 1;
                                        $newInst->addProperty("argdef$newNbParams", $oldDefArg);
                                    }
                                    
                                    $myFunctionCall->setNbParams($myFuncCall->getNbParams() - 1);
                                } else {
                                    if ($instruction->isPropertyExist("argdef1")) {
                                        $defArgParam = $instruction->getProperty("argdef1");
                                        if ($defArgParam->getCurrentState()->isType(MyDefinition::TYPE_ARRAY)) {
                                            $newNbParams = 0;
                                            $arrayIndexes = $defArgParam->getCurrentState()->getArrayIndexes();

                                            foreach ($arrayIndexes as $arrayIndex) {
                                                // simulate argument operation
                                                $newdef = clone $arrayIndex->def;
                                                $newdef->removeType(MyDefinition::TYPE_ARRAY_ELEMENT);

                                                $newInst->addProperty("argdef$newNbParams", $newdef);
                                                
                                                $newNbParams ++;
                                            }
                                            
                                            $myFunctionCall->setNbParams($newNbParams);
                                        }
                                    }
                                }
                                
                                $newInst->addProperty(MyInstruction::MYFUNC_CALL, $myFunctionCall);
                                 
                                foreach ($defArg->getCurrentState()->getLastKnownValues() as $lastValue) {
                                    $myFunctionCall->setName($lastValue);
                                    $newInst->addProperty(MyInstruction::FUNCNAME, $lastValue);

                                    $this->funcCall(
                                        $newInst,
                                        $lastValue,
                                        $myFunctionCall
                                    );
                                }
                            }
                        } else {
                            $this->funcCall(
                                $instruction,
                                $funcName,
                                $myFuncCall
                            );
                        }

                        break;
                }

                $index = $index + 1;
            }
        } while (isset($code[$index]) && $index <= $myCode->getEnd());

        return true;
    }
}
