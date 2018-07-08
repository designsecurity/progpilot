<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

use progpilot\Objects\MyInstance;
use progpilot\Objects\MyCode;
use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyFunction;

use progpilot\Dataflow\Definitions;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Utils;
use progpilot\Lang;

class VisitorDataflow
{
    private $defs;
    private $blocks;
    private $current_block_id;
    private $current_class;

    private $current_func;

    public function __construct()
    {
    }

    protected function getBlockId($myblock)
    {
        if (isset($this->blocks[$myblock])) {
            return $this->blocks[$myblock];
        }

        return -1;
    }

    protected function setBlockId($myblock)
    {
        if (!isset($this->blocks[$myblock])) {
            $this->blocks[$myblock] = count($this->blocks);
        }
    }

    public function analyze($context, $myfunc, $defs_included = null)
    {
        $mycode = $myfunc->getMyCode();
        $code = $mycode->getCodes();

        $index = 0;
        $myfunc->getMyCode()->setEnd(count($code));

        $blocks_stack_id = [];
        $last_block_id = 0;
        $first_block = true;

        do {
            if (isset($code[$index])) {
                $instruction = $code[$index];
                switch ($instruction->getOpcode()) {
                    case Opcodes::START_EXPRESSION:
                        // representations start
                        $id_cfg = hash("sha256", $this->current_func->getName()."-".$this->current_block_id);
                        $context->outputs->cfg->addTextOfMyBlock($id_cfg, Opcodes::START_EXPRESSION."\n");
                        // representations end
                        break;

                    case Opcodes::END_EXPRESSION:
                        // representations start
                        $id_cfg = hash("sha256", $this->current_func->getName()."-".$this->current_block_id);
                        $context->outputs->cfg->addTextOfMyBlock($id_cfg, Opcodes::END_EXPRESSION."\n");
                        // representations end
                        break;

                    case Opcodes::CLASSE:
                        $myclass = $instruction->getProperty(MyInstruction::MYCLASS);
                        foreach ($myclass->getProperties() as $property) {
                            if (is_null($property->getSourceMyFile())) {
                                $property->setSourceMyFile($context->getCurrentMyfile());
                            }
                        }

                        $object_id = $context->getObjects()->addObject();
                        $myclass->setObjectIdThis($object_id);

                        $this->current_class = $myclass;

                        break;

                    case Opcodes::ENTER_FUNCTION:
                        $block_id_zero = hash("sha256", "0-".$context->getCurrentMyfile()->getName());

                        $myfunc = $instruction->getProperty(MyInstruction::MYFUNC);
                        $myfunc->setSourceMyFile($context->getCurrentMyfile());

                        $blocks = new \SplObjectStorage;
                        $defs = new Definitions();
                        $defs->createBlock($block_id_zero);

                        $myfunc->setDefs($defs);
                        $myfunc->setBlocks($blocks);

                        $this->defs = $defs;
                        $this->blocks = $blocks;

                        $this->current_block_id = $block_id_zero;
                        $this->current_func = $myfunc;

                        if ($myfunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                            $thisdef = $myfunc->getThisDef();
                            $thisdef->setSourceMyFile($context->getCurrentMyfile());

                            $thisdef->setObjectId($this->current_class->getObjectIdThis());
                            $thisdef->setBlockId($block_id_zero);

                            $this->defs->addDef($thisdef->getName(), $thisdef);
                            $this->defs->addGen($thisdef->getBlockId(), $thisdef);

                            $context->getObjects()->addMyclassToObject(
                                $this->current_class->getObjectIdThis(),
                                $this->current_class
                            );
                        }

                        // representations start
                        $hashed_value = $this->current_func->getName()."-".$this->current_block_id;
                        $id_cfg = hash("sha256", $hashed_value);
                        $context->outputs->cfg->addTextOfMyBlock(
                            $id_cfg,
                            Opcodes::ENTER_FUNCTION." ".htmlentities($myfunc->getName(), ENT_QUOTES, 'UTF-8')."\n"
                        );
                        // representations end

                        break;

                    case Opcodes::ENTER_BLOCK:
                        $myblock = $instruction->getProperty(MyInstruction::MYBLOCK);

                        $this->setBlockId($myblock);
                        $block_id_tmp = $this->getBlockId($myblock);

                        $block_id = hash("sha256", "$block_id_tmp-".$context->getCurrentMyfile()->getName());
                        $myblock->setId($block_id);

                        array_push($blocks_stack_id, $block_id);
                        $this->current_block_id = $block_id;

                        if ($block_id !== hash("sha256", "0-".$context->getCurrentMyfile()->getName())) {
                            $this->defs->createBlock($block_id);
                        }

                        $assertions = $myblock->getAssertions();
                        foreach ($assertions as $assertion) {
                            $mydef = $assertion->getDef();
                            $mydef->setBlockId($block_id);
                        }

                        // representations start
                        $id_cfg = hash("sha256", $this->current_func->getName()."-".$this->current_block_id);
                        $context->outputs->cfg->addTextOfMyBlock($id_cfg, Opcodes::ENTER_BLOCK."\n");
                        $context->outputs->cfg->addNode($id_cfg, $myblock);

                        foreach ($myblock->parents as $parent) {
                            $context->outputs->cfg->addEdge($parent, $myblock);
                        }
                        // representations end

                        if ($first_block && !is_null($defs_included) && $this->current_func->getName() === "{main}") {
                            foreach ($defs_included as $def_included) {
                                $this->defs->addDef($def_included->getName(), $def_included);
                                $this->defs->addGen($block_id, $def_included);
                            }

                            $first_block = false;
                        }

                        break;

                    case Opcodes::LEAVE_BLOCK:
                        $myblock = $instruction->getProperty(MyInstruction::MYBLOCK);

                        $blockid = $myblock->getId();

                        $pop = array_pop($blocks_stack_id);

                        if (count($blocks_stack_id) > 0) {
                            $this->current_block_id = $blocks_stack_id[count($blocks_stack_id) - 1];
                        }

                        if (($this->current_func->getDefs()->getNbDefs() > $context->getLimitDefs()) ||
                        ($context->getCurrentNbDefs() > $context->getLimitDefs())) {
                            Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
                            return;
                        }

                        $this->defs->computeKill($context, $blockid);
                        $last_block_id = $blockid;

                        // representations start
                        $id_cfg = hash("sha256", $this->current_func->getName()."-".$this->current_block_id);
                        $context->outputs->cfg->addTextOfMyBlock($id_cfg, Opcodes::LEAVE_BLOCK."\n");
                        // representations end

                        break;


                    case Opcodes::LEAVE_FUNCTION:
                        $myfunc = $instruction->getProperty(MyInstruction::MYFUNC);

                        $context->setCurrentNbDefs($context->getCurrentNbDefs() + $myfunc->getDefs()->getNbDefs());

                        if ($context->getCurrentNbDefs() > $context->getLimitDefs()) {
                            Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
                            return;
                        }

                        $this->defs->reachingDefs($this->blocks);

                        $myfunc->setLastBlockId($last_block_id);

                        // representations start
                        $id_cfg = hash("sha256", $this->current_func->getName()."-".$this->current_block_id);
                        $context->outputs->cfg->addTextOfMyBlock($id_cfg, Opcodes::LEAVE_FUNCTION."\n");
                        // representations end

                        break;

                    case Opcodes::FUNC_CALL:
                        $myfunc_call = $instruction->getProperty(MyInstruction::MYFUNC_CALL);
                        $myfunc_call->setBlockId($this->current_block_id);

                        if (is_null($myfunc_call->getSourceMyFile())) {
                            $myfunc_call->setSourceMyFile($context->getCurrentMyfile());
                        }

                        if ($myfunc_call->isType(MyFunction::TYPE_FUNC_METHOD)) {
                            $mybackdef = $myfunc_call->getBackDef();
                            $mybackdef->setBlockId($this->current_block_id);
                            $mybackdef->addType(MyDefinition::TYPE_INSTANCE);
                            $mybackdef->setSourceMyFile($context->getCurrentMyfile());

                            $id_object = $context->getObjects()->addObject();
                            $mybackdef->setObjectId($id_object);

                            if (!empty($mybackdef->getClassName())) {
                                $myclass = $context->getClasses()->getMyClass($mybackdef->getClassName());
                                if (is_null($myclass)) {
                                    $myclass = new MyClass(
                                        $mybackdef->getLine(),
                                        $mybackdef->getColumn(),
                                        $mybackdef->getClassName()
                                    );
                                }

                                $context->getObjects()->addMyclassToObject($id_object, $myclass);
                            }

                            $this->defs->addDef($mybackdef->getName(), $mybackdef);
                            $this->defs->addGen($mybackdef->getBlockId(), $mybackdef);
                        }

                        $mysource = $context->inputs->getSourceByName(null, $myfunc_call, true, false, false);
                        if (!is_null($mysource)) {
                            if ($mysource->hasParameters()) {
                                $nbparams = 0;
                                while (true) {
                                    if (!$instruction->isPropertyExist("argdef$nbparams")) {
                                        break;
                                    }

                                    $defarg = $instruction->getProperty("argdef$nbparams");

                                    if ($mysource->isParameter($nbparams + 1)) {
                                        $deffrom = $defarg->getValueFromDef();
                                        if (!is_null($deffrom)) {
                                            $this->defs->addDef($deffrom->getName(), $deffrom);
                                            $this->defs->addGen($deffrom->getBlockId(), $deffrom);
                                        }
                                    }

                                    $nbparams ++;
                                }
                            }
                        }

                        // representations start
                        $id_cfg = hash("sha256", $this->current_func->getName()."-".$this->current_block_id);
                        $context->outputs->cfg->addTextOfMyBlock(
                            $id_cfg,
                            Opcodes::FUNC_CALL." ".htmlentities($myfunc_call->getName(), ENT_QUOTES, 'UTF-8')."\n"
                        );
                        // representations end

                        break;

                    case Opcodes::TEMPORARY:
                        $mydef = $instruction->getProperty(MyInstruction::TEMPORARY);
                        $mydef->setBlockId($this->current_block_id);

                        if (is_null($mydef->getSourceMyFile())) {
                            $mydef->setSourceMyFile($context->getCurrentMyfile());
                        }

                        // representations start
                        $id_cfg = hash("sha256", $this->current_func->getName()."-".$this->current_block_id);
                        $context->outputs->cfg->addTextOfMyBlock($id_cfg, Opcodes::TEMPORARY."\n");
                        // representations end

                        break;

                    case Opcodes::DEFINITION:
                        $mydef = $instruction->getProperty(MyInstruction::DEF);
                        $mydef->setBlockId($this->current_block_id);

                        if (is_null($mydef->getSourceMyFile())) {
                            $mydef->setSourceMyFile($context->getCurrentMyfile());
                        }

                        $this->defs->addDef($mydef->getName(), $mydef);
                        $this->defs->addGen($mydef->getBlockId(), $mydef);

                        // representations start
                        $id_cfg = hash("sha256", $this->current_func->getName()."-".$this->current_block_id);
                        $context->outputs->cfg->addTextOfMyBlock($id_cfg, Opcodes::DEFINITION."\n");
                        // representations end

                        break;
                }

                $index = $index + 1;
            }
        } while (isset($code[$index]) && $index <= $mycode->getEnd());
    }
}
