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
        $index = $myCode->getStart();
        $code = $myCode->getCodes();

        if ($this->context->getCurrentNbDefs() > $this->context->getLimitDefs()) {
            Utils::printWarning($this->context, Lang::MAX_DEFS_EXCEEDED);
            return;
        }

        do {
            if (isset($code[$index])) {
                $instruction = $code[$index];

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

                            if (!is_null($this->context->inputs->getSourceArrayByName(
                                $tempDefa,
                                $tempDefa->getArrayValue()
                            ))) {
                                $tempDefa->setArrayValue("PROGPILOT_ALL_INDEX_TAINTED");
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

                            $tainted = false;
                            if (!is_null($this->context->inputs->getSourceByName(
                                null,
                                $tempDefa,
                                false,
                                false,
                                $tempDefa->getArrayValue()
                            ))) {
                                $tainted = true;
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

                                if ($def->isType(MyDefinition::TYPE_PROPERTY)) {
                                    if (!is_null($this->context->inputs->getSourceByName(
                                        null,
                                        $def,
                                        false,
                                        $def->getClassName(),
                                        false,
                                        $def
                                    ))) {
                                        $def->setTainted(true);
                                    }
                                }

                                if ($visibility) {
                                    $storageCast[] = $tempDefa->getCast();
                                    $storageKnownValues["".$tempDefa->getId().""][] = $def->getLastKnownValues();

                                    $def->setIsEmbeddedByChars($tempDefa->getIsEmbeddedByChars(), true);
                                }

                                if ($visibility && !$safe) {
                                    TaintAnalysis::setTainted($def->isTainted(), $defAssignMyExpr, $tempDefaMyExpr);
                                    ValueAnalysis::copyValues($def, $defAssignMyExpr);
                                }

                                // vérifier s'il y a pas de concat
                                // mis a jour de l'object
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
                                    $method = $myClass->getMethod($funcName);

                                    if (!ResolveDefs::getVisibilityMethod($myFuncCall->getNameInstance(), $method)) {
                                        $method = null;
                                    }

                                    if (!is_null($method)) {
                                        $method->getThisDef()->setObjectId($objectId);
                                    }

                                    $listMyFunc[] = [$objectId, $myClass, $method];



                                    TaintAnalysis::funccallSpecifyAnalysis(
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
                                TaintAnalysis::funccallSpecifyAnalysis(
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


                            /*

                            // twig analysis
                            if($this->context->getAnalyzeJs())
                            {
                            if($myClass->getName() == "Twig_Environment")
                            {
                            if($myFuncCall->getName() == "render")
                            {
                            TwigAnalysis::funccall($this->context, $myFuncCall, $instruction);
                            }
                            }
                            }

                             */
                        } elseif ($myFuncCall->isType(MyFunction::TYPE_FUNC_STATIC)) {
                            $myClassStatic = $this->context->getClasses()->getMyClass(
                                $myFuncCall->getNameInstance()
                            );

                            if (!is_null($myClassStatic)) {
                                $method = $myClassStatic->getMethod($funcName);

                                if (!ResolveDefs::getVisibilityMethod(
                                    $myFuncCall->getNameInstance(),
                                    $method
                                )) {
                                    $method = null;
                                }

                                $listMyFunc[] = [0, $myClassStatic, $method];

                                $stackClass[0][0] = $myClassStatic;

                                TaintAnalysis::funccallSpecifyAnalysis(
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
                            TaintAnalysis::funccallSpecifyAnalysis(
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

                            $listMyFunc[] = [0, null, $myFunc];
                        }

                        foreach ($listMyFunc as $list) {
                            $objectId = $list[0];
                            $myClass = $list[1];
                            $myFunc = $list[2];

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

                            \progpilot\Analysis\CustomAnalysis::mustVerifyDefinition(
                                $this->context,
                                $instruction,
                                $myFuncCall,
                                $myClass
                            );

                            FuncAnalysis::funccallAfter(
                                $this->context,
                                $this->defs->getOutMinusKill($myFuncCall->getBlockId()),
                                $myFuncCall,
                                $myFunc,
                                $arrFuncCall,
                                $instruction,
                                $code[$index + 3]
                            );

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
                                $myFuncCall
                            );

                            TaintAnalysis::funccallSpecifyAnalysis(
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

                        break;
                }

                $index = $index + 1;
            }
        } while (isset($code[$index]) && $index <= $myCode->getEnd());
    }
}
