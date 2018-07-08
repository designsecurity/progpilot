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
    private $current_storagemyblocks;
    private $call_stack;

    private $defs;
    private $blocks;

    private $current_myfunc;
    private $current_context_call;
    private $current_myblock;

    public function __construct()
    {
        $this->current_storagemyblocks = null;
        $this->call_stack = [];
        $this->myblock_stack = [];

        $this->current_myfunc = null;
        $this->current_context_call = null;
        $this->current_myblock = null;

        $this->defs = null;
        $this->blocks = null;
    }

    public function inCallStack($cur_func)
    {
        foreach ($this->call_stack as $call) {
            $call_func = $call[0];

            if ($call_func->getName() === $cur_func->getName()
                && !$call_func->isType(MyFunction::TYPE_FUNC_METHOD)
                    && !$cur_func->isType(MyFunction::TYPE_FUNC_METHOD)) {
                return true;
            }

            if ($call_func->getName() === $cur_func->getName()
                && $call_func->isType(MyFunction::TYPE_FUNC_METHOD)
                    && $cur_func->isType(MyFunction::TYPE_FUNC_METHOD)) {
                $cur_class = $cur_func->getMyClass();
                $call_class = $call_func->getMyClass();

                if ($cur_class->getName() === $call_class->getName()) {
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

    public function analyze($mycode, $myfunc_called = null)
    {
        $index = $mycode->getStart();
        $code = $mycode->getCodes();

        if ($this->context->getCurrentNbDefs() > $this->context->getLimitDefs()) {
            Utils::printWarning($this->context, Lang::MAX_DEFS_EXCEEDED);
            return;
        }

        do {
            if (isset($code[$index])) {
                $instruction = $code[$index];

                switch ($instruction->getOpcode()) {
                    case Opcodes::ENTER_BLOCK:
                        $myblock = $instruction->getProperty(MyInstruction::MYBLOCK);

                        if ($this->current_storagemyblocks->contains($myblock)) {
                            array_pop($this->myblock_stack);

                            if (count($this->myblock_stack) > 0) {
                                $this->current_myblock = $this->myblock_stack[count($this->myblock_stack) - 1];
                            }

                            $index = $myblock->getEndAddressBlock();
                            break;
                        }

                        $this->current_myblock = $myblock;

                        array_push($this->myblock_stack, $this->current_myblock);

                        $this->current_storagemyblocks->attach($myblock);

                        foreach ($myblock->parents as $blockparent) {
                            $addr_start = $blockparent->getStartAddressBlock();
                            $addr_end = $blockparent->getEndAddressBlock();

                            if (!$this->current_storagemyblocks->contains($blockparent)) {
                                $oldindex_start = $mycode->getStart();
                                $oldindex_end = $mycode->getEnd();

                                $mycode->setStart($addr_start);
                                $mycode->setEnd($addr_end);

                                $this->analyze($mycode);

                                $mycode->setStart($oldindex_start);
                                $mycode->setEnd($oldindex_end);
                            }
                        }

                        break;
                    

                    case Opcodes::LEAVE_BLOCK:
                        array_pop($this->myblock_stack);

                        if (count($this->myblock_stack) > 0) {
                            $this->current_myblock = $this->myblock_stack[count($this->myblock_stack) - 1];
                        }

                        break;
                    

                    case Opcodes::LEAVE_FUNCTION:
                        $myfunc = $instruction->getProperty(MyInstruction::MYFUNC);

                        if ($myfunc->getName() === "{main}") {
                            return;
                        }

                        $val = array_pop($this->call_stack);

                        $this->current_context_call = $val[4];
                        $this->current_storagemyblocks = $val[3];
                        $this->defs = $val[2];
                        $this->blocks = $val[1];
                            
                        break;
                    

                    case Opcodes::ENTER_FUNCTION:
                        $this->current_context_call = new \stdClass;
                        $this->current_context_call->func_called = $myfunc_called;
                        $this->current_context_call->func_callee = $this->current_myfunc;

                        $this->current_myfunc = $instruction->getProperty(MyInstruction::MYFUNC);

                        $val = [
                            $this->current_myfunc,
                                $this->blocks,
                                    $this->defs,
                                        $this->current_storagemyblocks,
                                            $this->current_context_call];
                        array_push($this->call_stack, $val);

                        $this->current_storagemyblocks = new \SplObjectStorage;
                        $this->defs = $this->current_myfunc->getDefs();
                        $this->blocks = $this->current_myfunc->getBlocks();

                        break;
                    

                    case Opcodes::DEFINITION:
                        $mydef = $instruction->getProperty(MyInstruction::DEF);
                        break;
                    


                    case Opcodes::END_EXPRESSION:
                        $expr = $instruction->getProperty(MyInstruction::EXPR);

                        if ($expr->isAssign()) {
                            $defassign = $expr->getAssignDef();

                            /*
                             * we have all the resolved defs so maybe when we have two def for one tempdef
                             * that could lead to abuse the compute of embedded chars for example
                             * but it's not because all def have the same name (they have been resolved)
                             * and so same embedded char of tempdef
                             */

                            ValueAnalysis::computeSanitizedValues($defassign, $expr);
                            ValueAnalysis::computeEmbeddedChars($defassign, $expr);
                            ValueAnalysis::computeCastValues($defassign, $expr);
                            ValueAnalysis::computeKnownValues($defassign, $expr);
                        }

                        break;
                    


                    case Opcodes::TEMPORARY:
                        $tempdefa = $instruction->getProperty(MyInstruction::TEMPORARY);
                        $tempdefa_myexpr = $tempdefa->getExpr();
                        $defassign_myexpr = $tempdefa_myexpr->getAssignDef();

                        if ($tempdefa_myexpr->isAssign() && !$tempdefa_myexpr->isAssignIterator()) {
                            ArrayAnalysis::copyArray(
                                $this->context,
                                $this->defs->getOutMinusKill($tempdefa->getBlockId()),
                                $tempdefa,
                                $tempdefa->getArrayValue(),
                                $defassign_myexpr,
                                $defassign_myexpr->getArrayValue()
                            );
                        }

                        $tainted = false;
                        if (!is_null($this->context->inputs->getSourceByName(
                            null,
                            $tempdefa,
                            false,
                            false,
                            $tempdefa->getArrayValue()
                        ))) {
                            $tainted = true;
                        }
                        $tempdefa->setTainted($tainted);

                        $defs = ResolveDefs::temporarySimple(
                            $this->context,
                            $this->defs,
                            $tempdefa,
                            $tempdefa_myexpr->isAssignIterator(),
                            $tempdefa_myexpr->isAssign(),
                            $this->call_stack
                        );

                        ValueAnalysis::updateStorageToExpr($tempdefa_myexpr);
                        $storage_cast = ValueAnalysis::$exprs_cast[$tempdefa_myexpr];
                        $storage_knownvalues = ValueAnalysis::$exprs_knownvalues[$tempdefa_myexpr];

                        //$new_defsassign[] = $defassign_myexpr;

                        foreach ($defs as $def) {
                            $safe = AssertionAnalysis::temporarySimple(
                                $this->context,
                                $this->defs,
                                $this->current_myblock,
                                $def,
                                $tempdefa
                            );
                            $visibility = ResolveDefs::getVisibilityFromInstances(
                                $this->context,
                                $this->defs->getOutMinusKill($def->getBlockId()),
                                $defassign_myexpr
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
                                $storage_cast[] = $tempdefa->getCast();
                                $storage_knownvalues["".$tempdefa->getId().""][] = $def->getLastKnownValues();

                                ValueAnalysis::copyValues($tempdefa, $def);
                            }

                            if ($visibility && !$safe) {
                                TaintAnalysis::setTainted($def->isTainted(), $defassign_myexpr, $tempdefa_myexpr);
                            }

                            // vérifier s'il y a pas de concat
                            // mis a jour de l'object
                            if ($def->isType(MyDefinition::TYPE_INSTANCE)) {
                                $defassign_myexpr->addType(MyDefinition::TYPE_INSTANCE);
                                $defassign_myexpr->setObjectId($def->getObjectId());

                                $tmp_myclass = $this->context->getObjects()->getMyClassFromObject($def->getObjectId());
                                if (!is_null($tmp_myclass)) {
                                    foreach ($tmp_myclass->getProperties() as $property) {
                                        $mydeftemp = new MyDefinition(
                                            $tempdefa->getLine(),
                                            $tempdefa->getColumn(),
                                            $tempdefa->getName()
                                        );
                                        $mydeftemp->addType(MyDefinition::TYPE_PROPERTY);
                                        $mydeftemp->property->setProperties($property->property->getProperties());
                                        $mydeftemp->setBlockId($tempdefa->getBlockId());
                                        $mydeftemp->setSourceMyFile($tempdefa->getSourceMyFile());
                                        $mydeftemp->setId($tempdefa->getId());

                                        $defs_found = ResolveDefs::selectProperties(
                                            $this->context,
                                            $this->defs->getOutMinusKill($tempdefa->getBlockId()),
                                            $mydeftemp,
                                            true
                                        );
                                        foreach ($defs_found as $def_found) {
                                            if ($def_found->isType(MyDefinition::TYPE_COPY_ARRAY)) {
                                                $property->setCopyArrays($def_found->getCopyArrays());
                                                $property->addType(MyDefinition::TYPE_COPY_ARRAY);
                                            }

                                            TaintAnalysis::setTainted(
                                                $def_found->isTainted(),
                                                $property,
                                                $def_found->getTaintedByExpr()
                                            );

                                            if ($def_found->isSanitized()) {
                                                $property->setSanitized(true);
                                                foreach ($def_found->getTypeSanitized() as $type_sanitized) {
                                                    $property->addTypeSanitized($type_sanitized);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        ValueAnalysis::$exprs_cast[$tempdefa_myexpr] = $storage_cast;
                        ValueAnalysis::$exprs_knownvalues[$tempdefa_myexpr] = $storage_knownvalues;

                        break;
                    

                    case Opcodes::FUNC_CALL:
                        $funcname = $instruction->getProperty(MyInstruction::FUNCNAME);
                        $arr_funccall = $instruction->getProperty(MyInstruction::ARR);
                        $myfunc_call = $instruction->getProperty(MyInstruction::MYFUNC_CALL);

                        $list_myfunc = [];
                        IncludeAnalysis::funccall(
                            $this->context,
                            $this->defs,
                            $this->blocks,
                            $instruction,
                            $code,
                            $index
                        );

                        $stack_class = null;
                        if ($myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD)) {
                            $stack_class = ResolveDefs::funccallClass(
                                $this->context,
                                $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                $myfunc_call
                            );

                            $class_of_funccall_arr = $stack_class[count($stack_class) - 1];
                            foreach ($class_of_funccall_arr as $class_of_funccall) {
                                $object_id = $class_of_funccall->getObjectId();

                                $myclass = $this->context->getObjects()->getMyClassFromObject($object_id);
                                if (!is_null($myclass)) {
                                    $method = $myclass->getMethod($funcname);

                                    if (!ResolveDefs::getVisibilityMethod($myfunc_call->getNameInstance(), $method)) {
                                        $method = null;
                                    }

                                    if (!is_null($method)) {
                                        $method->getThisDef()->setObjectId($object_id);
                                    }

                                    $list_myfunc[] = [$object_id, $myclass, $method];



                                    TaintAnalysis::funccallSpecifyAnalysis(
                                        $method,
                                        $stack_class,
                                        $this->context,
                                        $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                        $myclass,
                                        $myfunc_call,
                                        $arr_funccall,
                                        $instruction,
                                        $mycode,
                                        $index
                                    );
                                }
                            }

                            // we didn't resolve any class so the class of method is unknown (undefined)
                            // but we authorize to specify method of unknown class during the configuration of sinks ...
                            if (count($class_of_funccall_arr) === 0) {
                                TaintAnalysis::funccallSpecifyAnalysis(
                                    null,
                                    $stack_class,
                                    $this->context,
                                    $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                    null,
                                    $myfunc_call,
                                    $arr_funccall,
                                    $instruction,
                                    $mycode,
                                    $index
                                );
                            }


                            /*

                            // twig analysis
                            if($this->context->getAnalyzeJs())
                            {
                            if($myclass->getName() == "Twig_Environment")
                            {
                            if($myfunc_call->getName() == "render")
                            {
                            TwigAnalysis::funccall($this->context, $myfunc_call, $instruction);
                            }
                            }
                            }

                             */
                        } elseif ($myfunc_call->isType(MyFunction::TYPE_FUNC_STATIC)) {
                            $myclass_static = $this->context->getClasses()->getMyClass(
                                $myfunc_call->getNameInstance()
                            );

                            if (!is_null($myclass_static)) {
                                $method = $myclass_static->getMethod($funcname);

                                if (!ResolveDefs::getVisibilityMethod(
                                    $myfunc_call->getNameInstance(),
                                    $method
                                )) {
                                    $method = null;
                                }

                                $list_myfunc[] = [0, $myclass_static, $method];

                                $stack_class[0][0] = $myclass_static;

                                TaintAnalysis::funccallSpecifyAnalysis(
                                    $method,
                                    $stack_class,
                                    $this->context,
                                    $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                    $myclass_static,
                                    $myfunc_call,
                                    $arr_funccall,
                                    $instruction,
                                    $mycode,
                                    $index
                                );
                            }
                        } else {
                            $myfunc = $this->context->getFunctions()->getFunction($funcname);
                            TaintAnalysis::funccallSpecifyAnalysis(
                                $myfunc,
                                null,
                                $this->context,
                                $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                null,
                                $myfunc_call,
                                $arr_funccall,
                                $instruction,
                                $mycode,
                                $index
                            );

                            $list_myfunc[] = [0, null, $myfunc];
                        }

                        foreach ($list_myfunc as $list) {
                            $object_id = $list[0];
                            $myclass = $list[1];
                            $myfunc = $list[2];

                            ResolveDefs::instanceBuildThis(
                                $this->context,
                                $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                $object_id,
                                $myclass,
                                $myfunc,
                                $myfunc_call
                            );

                            if (!is_null($myfunc) && !$this->inCallStack($myfunc)) {
                                // the called function is a method and this method exists in the class
                                if (($myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD)
                                    || $myfunc_call->isType(MyFunction::TYPE_FUNC_STATIC))
                                        && $myfunc->isType(MyFunction::TYPE_FUNC_METHOD)
                                            || ((!$myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD)
                                                && !$myfunc_call->isType(MyFunction::TYPE_FUNC_STATIC))
                                                    && !$myfunc->isType(MyFunction::TYPE_FUNC_METHOD))) {
                                    FuncAnalysis::funccallBefore(
                                        $this->context,
                                        $this->defs,
                                        $myfunc,
                                        $myfunc_call,
                                        $instruction,
                                        $this->context->getClasses()
                                    );

                                    $mycodefunction = new MyCode;
                                    $mycodefunction->setCodes($myfunc->getMyCode()->getCodes());
                                    $mycodefunction->setStart(0);
                                    $mycodefunction->setEnd(count($myfunc->getMyCode()->getCodes()));

                                    $this->analyze($mycodefunction, $myfunc_call);
                                }
                            }

                            \progpilot\Analysis\CustomAnalysis::mustVerifyDefinition(
                                $this->context,
                                $instruction,
                                $myfunc_call,
                                $myclass
                            );

                            FuncAnalysis::funccallAfter(
                                $this->context,
                                $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                $myfunc_call,
                                $myfunc,
                                $arr_funccall,
                                $instruction,
                                $code[$index + 3]
                            );

                            $class_of_funccall = null;
                            if (is_null($myfunc)) {
                                ResolveDefs::funccallReturnValues(
                                    $this->context,
                                    $myfunc_call,
                                    $instruction,
                                    $mycode,
                                    $index
                                );

                                // representations start
                                $this->context->outputs->callgraph->addFuncCall(
                                    $this->current_myblock,
                                    $myfunc_call,
                                    $myclass
                                );
                            // representations end
                            } else {
                                $class_of_funccall = $myfunc->getMyClass();

                                // representations start
                                foreach ($myfunc->getBlocks() as $myblock) {
                                    $this->context->outputs->callgraph->addChild(
                                        $this->current_myblock,
                                        $myblock
                                    );
                                    $this->context->outputs->cfg->addEdge(
                                        $this->current_myblock,
                                        $myblock
                                    );
                                    break;
                                }

                                $this->context->outputs->callgraph->addFuncCall(
                                    $this->current_myblock,
                                    $myfunc_call,
                                    $myclass
                                );
                                // representations end
                            }

                            ResolveDefs::instanceBuildBack(
                                $this->context,
                                $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                $myfunc,
                                $myfunc_call
                            );

                            TaintAnalysis::funccallSpecifyAnalysis(
                                $myfunc,
                                $stack_class,
                                $this->context,
                                $this->defs->getOutMinusKill($myfunc_call->getBlockId()),
                                $class_of_funccall,
                                $myfunc_call,
                                $arr_funccall,
                                $instruction,
                                $mycode,
                                $index
                            );
                        }

                        break;
                }

                $index = $index + 1;
            }
        } while (isset($code[$index]) && $index <= $mycode->getEnd());
    }
}
