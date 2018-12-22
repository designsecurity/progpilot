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

use progpilot\Lang;
use progpilot\Utils;
use progpilot\Analyzer;

class VisitorAnalysis
{
    private $context;
    private $currentStorageMyBlocks;
    private $callStack;
    private $myBlockStack;

    private $defs;
    private $blocks;

    private $currentMyFunc;
    private $currentContextCall;
    private $currentMyBlock;

    public function __construct()
    {
        $this->currentStorageMyBlocks = null;
        $this->callStack = [];
        $this->myBlockStack = [];

        $this->currentMyFunc = null;
        $this->currentContextCall = null;
        $this->currentMyBlock = null;

        $this->defs = null;
        $this->blocks = null;
    }
    
    public function funcCall(
        $myCode,
        $instruction,
        $code,
        $index,
        $funcName,
        $arrFuncCall,
        $myFuncCall
    ) {
        $hasSources = false;
                        
        $listMyFunc = [];
        IncludeAnalysis::funccall(
            $this->context,
            $this->defs,
            $this->blocks,
            $instruction,
            $code,
            $index
        );

        $stackClass = null;
        if ($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)) {
            $stackClass = ResolveDefs::funccallClass(
                $this->context,
                $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                $myFuncCall
            );

            $classOfFuncCallArr = $stackClass[count($stackClass) - 1];
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
                        $method->getThisDef()->setObjectId($objectId);
                    }

                    // twig analysis
                    if ($this->context->inputs->isLanguage(Analyzer::JS)) {
                        if (!is_null($myClass) && $myClass->getName() === "Twig_Environment") {
                            if ($funcName === "render") {
                                TwigAnalysis::funccall($this->context, $myFuncCall, $instruction);
                            }
                        }
                    }
                                    
                    $listMyFunc[] = [$objectId, $myClass, $method, $visibility];

                    $hasSources = TaintAnalysis::funccallSpecifyAnalysis(
                        $method,
                        $stackClass,
                        $this->context,
                        $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                        $myClass,
                        $myFuncCall,
                        $arrFuncCall,
                        $instruction,
                        $myCode,
                        $index
                    );
                }
            }

            // we didn't resolve any class so the class of method is unknown (undefined)
            // but we authorize to specify method of unknown class during the configuration of sinks ...
            if (count($classOfFuncCallArr) === 0) {
                $hasSources = TaintAnalysis::funccallSpecifyAnalysis(
                    null,
                    $stackClass,
                    $this->context,
                    $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                    null,
                    $myFuncCall,
                    $arrFuncCall,
                    $instruction,
                    $myCode,
                    $index
                );
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

                $listMyFunc[] = [0, $myClassStatic, $method, $visibility];

                $myDefStatic = new MyDefinition($myFuncCall->getLine(), $myFuncCall->getColumn(), "static");
                $idObjectTmp = $this->context->getObjects()->addObject();
                $myDefStatic->setObjectId($idObjectTmp);
                $this->context->getObjects()->addMyclassToObject($idObjectTmp, $myClassStatic);
                                
                $stackClass[0][0] = $myDefStatic;

                $hasSources = TaintAnalysis::funccallSpecifyAnalysis(
                    $method,
                    $stackClass,
                    $this->context,
                    $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                    $myClassStatic,
                    $myFuncCall,
                    $arrFuncCall,
                    $instruction,
                    $myCode,
                    $index
                );
            }
        } else {
            $myFunc = $this->context->getFunctions()->getFunction($funcName);
            $hasSources = TaintAnalysis::funccallSpecifyAnalysis(
                $myFunc,
                null,
                $this->context,
                $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                null,
                $myFuncCall,
                $arrFuncCall,
                $instruction,
                $myCode,
                $index
            );

            $listMyFunc[] = [0, null, $myFunc, true];
        }
        
        \progpilot\Analysis\CustomAnalysis::mustVerifyDefinition(
            $this->context,
            $instruction,
            $myFuncCall,
            $stackClass
        );

        foreach ($listMyFunc as $list) {
            $objectId = $list[0];
            $myClass = $list[1];
            $myFunc = $list[2];
            $visibility = $list[3];

            ResolveDefs::instanceBuildThis(
                $this->context,
                $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                $objectId,
                $myClass,
                $myFunc,
                $myFuncCall
            );

            if (!is_null($myFunc) && !$this->inCallStack($myFunc)) {
                // the called function is a method and this method exists in the class
                if (($myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)
                    || $myFuncCall->isType(MyFunction::TYPE_FUNC_STATIC))
                        && $myFunc->isType(MyFunction::TYPE_FUNC_METHOD)
                            || ((!$myFuncCall->isType(MyFunction::TYPE_FUNC_METHOD)
                                && !$myFuncCall->isType(MyFunction::TYPE_FUNC_STATIC))
                                    && !$myFunc->isType(MyFunction::TYPE_FUNC_METHOD))) {
                    FuncAnalysis::funccallBefore(
                        $this->context,
                        $this->defs,
                        $myFunc,
                        $myFuncCall,
                        $instruction,
                        $this->context->getClasses()
                    );

                    $myCodefunction = new MyCode;
                    $myCodefunction->setCodes($myFunc->getMyCode()->getCodes());
                    $myCodefunction->setStart(0);
                    $myCodefunction->setEnd(count($myFunc->getMyCode()->getCodes()));
                                    
                    $this->analyze($myCodefunction, $myFuncCall);
                }
            }
            
            if (!$hasSources) {
                FuncAnalysis::funccallAfter(
                    $this->context,
                    $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                    $myFuncCall,
                    $myFunc,
                    $arrFuncCall,
                    $instruction,
                    $code[$index + 3]
                );
            }

            $classOfFuncCall = null;
            if (is_null($myFunc)) {
                ResolveDefs::funccallReturnValues(
                    $this->context,
                    $myFuncCall,
                    $instruction,
                    $myCode,
                    $index
                );

                // representations start
                $this->context->outputs->callgraph->addFuncCall(
                    $this->currentMyBlock,
                    $myFuncCall,
                    $myClass
                );
            // representations end
            } else {
                $classOfFuncCall = $myFunc->getMyClass();

                // representations start
                foreach ($myFunc->getBlocks() as $myBlock) {
                    $this->context->outputs->callgraph->addChild(
                        $this->currentMyBlock,
                        $myBlock
                    );
                    $this->context->outputs->cfg->addEdge(
                        $this->currentMyBlock,
                        $myBlock
                    );
                    break;
                }

                $this->context->outputs->callgraph->addFuncCall(
                    $this->currentMyBlock,
                    $myFuncCall,
                    $myClass
                );
                // representations end
            }

            ResolveDefs::instanceBuildBack(
                $this->context,
                $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                $myFunc,
                $myClass,
                $myFuncCall,
                $visibility
            );
                            
            $hasSources = TaintAnalysis::funccallSpecifyAnalysis(
                $myFunc,
                $stackClass,
                $this->context,
                $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                $classOfFuncCall,
                $myFuncCall,
                $arrFuncCall,
                $instruction,
                $myCode,
                $index
            );
        }
    }

    public function inCallStack($curFunc)
    {
        foreach ($this->callStack as $call) {
            $callFunc = $call[0];

            if ($callFunc->getName() === $curFunc->getName()
                && !$callFunc->isType(MyFunction::TYPE_FUNC_METHOD)
                    && !$curFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                return true;
            }

            if ($callFunc->getName() === $curFunc->getName()
                && $callFunc->isType(MyFunction::TYPE_FUNC_METHOD)
                    && $curFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                $curClass = $curFunc->getMyClass();
                $callClass = $callFunc->getMyClass();

                if ($curClass->getName() === $callClass->getName()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getMyblock($context)
    {
        $this->context = $context;
    }

    public function setContext($context)
    {
        $this->context = $context;
    }

    public function analyze($myCode, $myFuncCalled = null)
    {
        $startTime = microtime(true);
        $index = $myCode->getStart();
        $code = $myCode->getCodes();
        
        if ($this->context->getCurrentNbDefs() > $this->context->getLimitDefs()) {
            Utils::printWarning($this->context, Lang::MAX_DEFS_EXCEEDED);
            return;
        }

        do {
            if (isset($code[$index])) {
                $instruction = $code[$index];
                
                if ((microtime(true) - $startTime) > $this->context->getLimitTime()) {
                    Utils::printWarning($this->context, Lang::MAX_TIME_EXCEEDED);
                    return;
                }

                switch ($instruction->getOpcode()) {
                    case Opcodes::ENTER_BLOCK:
                        $myBlock = $instruction->getProperty(MyInstruction::MYBLOCK);

                        if ($this->currentStorageMyBlocks->contains($myBlock)) {
                            array_pop($this->myBlockStack);

                            if (count($this->myBlockStack) > 0) {
                                $this->currentMyBlock = $this->myBlockStack[count($this->myBlockStack) - 1];
                            }

                            $index = $myBlock->getEndAddressBlock();
                            break;
                        }

                        $this->currentMyBlock = $myBlock;

                        array_push($this->myBlockStack, $this->currentMyBlock);

                        $this->currentStorageMyBlocks->attach($myBlock);
                        
                        
                        // we remove this parent because it's a loop while(block1) block2
                        // and block1 must be analysis before block2
                        if (!$myBlock->getIsLoop()) {
                            foreach ($myBlock->parents as $blockParent) {
                                $addrStart = $blockParent->getStartAddressBlock();
                                $addrEnd = $blockParent->getEndAddressBlock();
                                
                                if (!$this->currentStorageMyBlocks->contains($blockParent)) {
                                    $oldIndexStart = $myCode->getStart();
                                    $oldIndexEnd = $myCode->getEnd();

                                    $myCode->setStart($addrStart);
                                    $myCode->setEnd($addrEnd);

                                    $this->analyze($myCode);

                                    $myCode->setStart($oldIndexStart);
                                    $myCode->setEnd($oldIndexEnd);
                                }
                            }
                        }

                        break;
                    

                    case Opcodes::LEAVE_BLOCK:
                        array_pop($this->myBlockStack);

                        if (count($this->myBlockStack) > 0) {
                            $this->currentMyBlock = $this->myBlockStack[count($this->myBlockStack) - 1];
                        }

                        break;
                    

                    case Opcodes::LEAVE_FUNCTION:
                        $myFunc = $instruction->getProperty(MyInstruction::MYFUNC);

                        if ($myFunc->getName() === "{main}") {
                            return;
                        }

                        $val = array_pop($this->callStack);

                        $this->currentContextCall = $val[4];
                        $this->currentStorageMyBlocks = $val[3];
                        $this->defs = $val[2];
                        $this->blocks = $val[1];
                            
                        break;
                    

                    case Opcodes::ENTER_FUNCTION:
                        $this->currentContextCall = new \stdClass;
                        $this->currentContextCall->func_called = $myFuncCalled;
                        $this->currentContextCall->func_callee = $this->currentMyFunc;

                        $this->currentMyFunc = $instruction->getProperty(MyInstruction::MYFUNC);
                        $this->context->setCurrentFunc($this->currentMyFunc);

                        $val = [
                            $this->currentMyFunc,
                                $this->blocks,
                                    $this->defs,
                                        $this->currentStorageMyBlocks,
                                            $this->currentContextCall];
                        array_push($this->callStack, $val);

                        $this->currentStorageMyBlocks = new \SplObjectStorage;
                        $this->defs = $this->currentMyFunc->getDefs();
                        $this->blocks = $this->currentMyFunc->getBlocks();

                        break;
                    

                    case Opcodes::DEFINITION:
                        $myDef = $instruction->getProperty(MyInstruction::DEF);
                        break;
                    


                    case Opcodes::END_EXPRESSION:
                        $expr = $instruction->getProperty(MyInstruction::EXPR);

                        if ($expr->isAssign()) {
                            $defAssign = $expr->getAssignDef();

                            /*
                             * we have all the resolved defs so maybe when we have two def for one tempdef
                             * that could lead to abuse the compute of embedded chars for example
                             * but it's not because all def have the same name (they have been resolved)
                             * and so same embedded char of tempdef
                             */

                            ValueAnalysis::computeSanitizedValues($defAssign, $expr);
                            ValueAnalysis::computeEmbeddedChars($defAssign, $expr);
                            ValueAnalysis::computeCastValues($defAssign, $expr);
                            ValueAnalysis::computeKnownValues($defAssign, $expr);
                        }

                        break;
                    


                    case Opcodes::TEMPORARY:
                        $listOfMyTemp = [];
                        if ($instruction->isPropertyExist(MyInstruction::PHI)) {
                            for ($i = 0; $i < $instruction->getProperty(MyInstruction::PHI); $i++) {
                                $listOfMyTemp[] = $instruction->getProperty("temp_".$i);
                            }
                        } else {
                            $listOfMyTemp[] = $instruction->getProperty(MyInstruction::TEMPORARY);
                        }
                          
                        foreach ($listOfMyTemp as $tempDefa) {
                            $tempDefaMyExpr = $tempDefa->getExpr();
                            $defAssignMyExpr = $tempDefaMyExpr->getAssignDef();
                            
                            $sourceArr = $this->context->inputs->getSourceArrayByName(
                                $tempDefa,
                                $tempDefa->getArrayValue()
                            );
                            // if we use directly echo $_GET["b"];
                            if (!is_null($sourceArr)) {
                                $tempDefa->setArrayValue("PROGPILOT_ALL_INDEX_TAINTED");
                                $tempDefa->setLabel($sourceArr->getLabel());
                            }
                            
                            if ($tempDefaMyExpr->isAssign() && !$tempDefaMyExpr->isAssignIterator()) {
                                ArrayAnalysis::copyArray(
                                    $this->context,
                                    $this->defs->getOutMinusKill($tempDefa->getBlockId()),
                                    $tempDefa,
                                    $tempDefa->getArrayValue(),
                                    $defAssignMyExpr,
                                    $defAssignMyExpr->getArrayValue()
                                );
                            }
                            
                            // stackclass is null
                            // so if we have document a object HTMLDocument is created
                            $myClassNew = \progpilot\Analysis\CustomAnalysis::defineObject(
                                $this->context,
                                $tempDefa,
                                null
                            );
                            
                            if (!is_null($myClassNew)) {
                                $objectId = $this->context->getObjects()->addObject();
                                        
                                $tempDefa->addType(MyDefinition::TYPE_INSTANCE);
                                $tempDefa->setObjectId($objectId);
                                                
                                $myClass = $this->context->getClasses()->getMyClass($myClassNew->getName());
                                                        
                                if (is_null($myClass)) {
                                    $myClass = new MyClass(
                                        $tempDefa->getLine(),
                                        $tempDefa->getColumn(),
                                        $myClassNew->getName()
                                    );
                                }

                                $this->context->getObjects()->addMyclassToObject($objectId, $myClass);
                            }
                            /////////////////////////////////////////////////////////////
                            
                            $tainted = false;
                            $stackClass = null;
                            
                            if ($tempDefa->isType(MyDefinition::TYPE_PROPERTY)) {
                                $stackClass = ResolveDefs::propertyClass($this->context, $this->defs, $tempDefa);
                                $classOfTempDefArr = $stackClass[count($stackClass) - 1];
                                
                                foreach ($classOfTempDefArr as $classOfTempDef) {
                                    $objectIdTmp = $classOfTempDef->getObjectId();
                                    $myClassFromObject =
                                        $this->context->getObjects()->getMyClassFromObject($objectIdTmp);
                                
                                    if (!is_null($myClassFromObject)) {
                                        $sourceTmp = $this->context->inputs->getSourceByName(
                                            $stackClass,
                                            $tempDefa,
                                            false,
                                            $myClassFromObject->getName(),
                                            $tempDefa->getArrayValue()
                                        );
                                    
                                        if (!is_null($sourceTmp)) {
                                            $tainted = true;
                                            $tempDefa->setLabel($sourceTmp->getLabel());
                                        }
                                    }
                                }
                            } else {
                                $sourceTmp = $this->context->inputs->getSourceByName(
                                    null,
                                    $tempDefa,
                                    false,
                                    false,
                                    $tempDefa->getArrayValue()
                                );
                                
                                if (!is_null($sourceTmp)) {
                                    $tainted = true;
                                    $tempDefa->setLabel($sourceTmp->getLabel());
                                }
                            }
                            
                            $tempDefa->setTainted($tainted);

                            $defs = ResolveDefs::temporarySimple(
                                $this->context,
                                $this->defs,
                                $tempDefa,
                                $tempDefaMyExpr->isAssignIterator(),
                                $tempDefaMyExpr->isAssign(),
                                $this->callStack
                            );

                            ValueAnalysis::updateStorageToExpr($tempDefaMyExpr);
                            $storageCast = ValueAnalysis::$exprsCast[$tempDefaMyExpr];
                            $storageKnownValues = ValueAnalysis::$exprsKnownValues[$tempDefaMyExpr];
                            
                            foreach ($defs as $def) {
                                $safe = AssertionAnalysis::temporarySimple(
                                    $this->context,
                                    $this->defs,
                                    $this->currentMyBlock,
                                    $def,
                                    $tempDefa
                                );
                            
                                $visibility = ResolveDefs::getVisibilityFromInstances(
                                    $this->context,
                                    $this->defs->getOutMinusKill($def->getBlockId()),
                                    $defAssignMyExpr
                                );
                                
                                if ($visibility) {
                                    $storageCast[] = $tempDefa->getCast();
                                    $storageKnownValues["".$tempDefa->getId().""][] = $def->getLastKnownValues();

                                    $def->setIsEmbeddedByChars($tempDefa->getIsEmbeddedByChars(), true);
                                }

                                if ($visibility && !$safe) {
                                    TaintAnalysis::setTainted($def->isTainted(), $defAssignMyExpr, $tempDefaMyExpr);
                                    ValueAnalysis::copyValues($def, $defAssignMyExpr);
                                    
                                    if ($def->getLabel() === MyDefinition::SECURITY_HIGH) {
                                        \progpilot\Analysis\CustomAnalysis::disclosureOfInformation(
                                            $this->context,
                                            $this->defs,
                                            $defAssignMyExpr
                                        );
                                    }
                                }

                                // vérifier s'il y a pas de concat
                                // mise a jour de l'object
                                if ($def->isType(MyDefinition::TYPE_INSTANCE)) {
                                    $defAssignMyExpr->addType(MyDefinition::TYPE_INSTANCE);
                                    $defAssignMyExpr->setObjectId($def->getObjectId());

                                    $tmpMyClass = $this->context->getObjects()->getMyClassFromObject(
                                        $def->getObjectId()
                                    );
                                    if (!is_null($tmpMyClass)) {
                                        foreach ($tmpMyClass->getProperties() as $property) {
                                            $myDefTemp = new MyDefinition(
                                                $tempDefa->getLine(),
                                                $tempDefa->getColumn(),
                                                $tempDefa->getName()
                                            );
                                            $myDefTemp->addType(MyDefinition::TYPE_PROPERTY);
                                            $myDefTemp->property->setProperties($property->property->getProperties());
                                            $myDefTemp->setBlockId($tempDefa->getBlockId());
                                            $myDefTemp->setSourceMyFile($tempDefa->getSourceMyFile());
                                            $myDefTemp->setId($tempDefa->getId());

                                            $defsFound = ResolveDefs::selectProperties(
                                                $this->context,
                                                $this->defs->getOutMinusKill($tempDefa->getBlockId()),
                                                $myDefTemp,
                                                true
                                            );
                                            
                                            foreach ($defsFound as $defFound) {
                                                if ($defFound->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                                                    $property->setCopyArrays($defFound->getCopyArrays());
                                                    $property->addType(MyDefinition::TYPE_COPY_ARRAY);
                                                }

                                                TaintAnalysis::setTainted(
                                                    $defFound->isTainted(),
                                                    $property,
                                                    $defFound->getTaintedByExpr()
                                                );

                                                if ($defFound->isSanitized()) {
                                                    $property->setSanitized(true);
                                                    foreach ($defFound->getTypeSanitized() as $typeSanitized) {
                                                        $property->addTypeSanitized($typeSanitized);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            ValueAnalysis::$exprsCast[$tempDefaMyExpr] = $storageCast;
                            ValueAnalysis::$exprsKnownValues[$tempDefaMyExpr] = $storageKnownValues;
                        }

                        break;
                    

                    case Opcodes::FUNC_CALL:
                        $funcName = $instruction->getProperty(MyInstruction::FUNCNAME);
                        $arrFuncCall = $instruction->getProperty(MyInstruction::ARR);
                        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);
                        $myExpr = $instruction->getProperty(MyInstruction::EXPR);
                        
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
                                        $oldExprArg = $instruction->getProperty("argexpr$nbParams");
                                        
                                        $newNbParams = $nbParams - 1;
                                        $newInst->addProperty("argdef$newNbParams", $oldDefArg);
                                        $newInst->addProperty("argexpr$newNbParams", $oldExprArg);
                                    }
                                    
                                    $myFunctionCall->setNbParams($myFuncCall->getNbParams() - 1);
                                } else {
                                    if ($instruction->isPropertyExist("argdef1")) {
                                        $defArgParam = $instruction->getProperty("argdef1");
                                        
                                        if ($defArgParam->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                                            $newNbParams = 0;
                                            foreach ($defArgParam->getCopyArrays() as $copyArray) {
                                                $newInst->addProperty("argdef$newNbParams", $copyArray[1]);
                                                $newInst->addProperty("argexpr$newNbParams", $copyArray[1]->getExpr());
                                                
                                                $newNbParams ++;
                                            }
                                            
                                            $myFunctionCall->setNbParams($newNbParams);
                                        }
                                    }
                                }
                                
                                $newInst->addProperty(MyInstruction::MYFUNC_CALL, $myFunctionCall);
                                $newInst->addProperty(MyInstruction::EXPR, $myExpr);
                                $newInst->addProperty(MyInstruction::ARR, $arrFuncCall);
                                    
                                foreach ($defArg->getLastKnownValues() as $lastValue) {
                                    $myFunctionCall->setName($lastValue);
                                    $newInst->addProperty(MyInstruction::FUNCNAME, $lastValue);

                                    $this->funcCall(
                                        $myCode,
                                        $newInst,
                                        $code,
                                        $index,
                                        $lastValue,
                                        $arrFuncCall,
                                        $myFunctionCall
                                    );
                                }
                            }
                        } else {
                            $this->funcCall(
                                $myCode,
                                $instruction,
                                $code,
                                $index,
                                $funcName,
                                $arrFuncCall,
                                $myFuncCall
                            );
                        }

                        break;
                }

                $index = $index + 1;
            }
        } while (isset($code[$index]) && $index <= $myCode->getEnd());
    }
}
