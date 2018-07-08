<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php;

use PHPCfg\Block;
use PHPCfg\Func;
use PHPCfg\Op;
use PHPCfg\Script;
use PHPCfg\Visitor;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyBlock;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyFile;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;

use progpilot\Transformations\Php\FuncCall;
use progpilot\Transformations\Php\Expr;
use progpilot\Transformations\Php\Assign;
use progpilot\Transformations\Php\Common;
use progpilot\Transformations\Php\Context;

class Transform implements Visitor
{
    private $s_blocks;
    private $context;
    private $block_if_to_be_resolved;

    public function __construct()
    {
        $this->s_blocks = new \SplObjectStorage;
        $this->block_if_to_be_resolved = [];
    }

    public function setContext($context)
    {
        $this->context = $context;
    }

    public function enterScript(Script $script)
    {
        $this->context->outputs->current_includes_file = [];
    }

    public function leaveScript(Script $script)
    {
        // creating edges for myblocks structure as block structure
        foreach ($this->s_blocks as $block) {
            $myblock = $this->s_blocks[$block];
            foreach ($block->parents as $block_parent) {
                if ($this->s_blocks->contains($block_parent)) {
                    $myblock_parent = $this->s_blocks[$block_parent];
                    $myblock->addParent($myblock_parent);
                }
            }
        }

        foreach ($this->block_if_to_be_resolved as $block_resolved) {
            $instruction_if = $block_resolved[0];
            $block_if = $block_resolved[1];
            $block_else = $block_resolved[2];

            if ($this->s_blocks->contains($block_if) && $this->s_blocks->contains($block_else)) {
                $myblock_if = $this->s_blocks[$block_if];
                $myblock_else = $this->s_blocks[$block_else];

                $instruction_if->addProperty(MyInstruction::MYBLOCK_IF, $myblock_if);
                $instruction_if->addProperty(MyInstruction::MYBLOCK_ELSE, $myblock_else);
            }
        }
    }

    public function enterBlock(Block $block, Block $prior = null)
    {
        $this->inside_include = false;
        if (!($this->context->getCurrentOp() instanceof Op\Expr\Include_)) {
            $myblock = new MyBlock;
            $myblock->setStartAddressBlock(count($this->context->getCurrentMycode()->getCodes()));
            $this->context->setCurrentBlock($block);

            $this->s_blocks[$block] = $myblock;

            $inst_block = new MyInstruction(Opcodes::ENTER_BLOCK);
            $inst_block->addProperty(MyInstruction::MYBLOCK, $myblock);
            $this->context->getCurrentMycode()->addCode($inst_block);

            // block is for himself a parent block (handle dataflow for first block)
            $block->addParent($block);

            $myblock->setId(rand());
        } else {
            $this->inside_include = true;
        }
    }

    public function skipBlock(Block $block, Block $prior = null)
    {
    }

    public function leaveOp(Op $op, Block $block)
    {
    }

    public function leaveBlock(Block $block, Block $prior = null)
    {
        if (!$this->inside_include) {
            if ($this->s_blocks->contains($block)) {
                $myblock = $this->s_blocks[$block];

                $address_end_block = count($this->context->getCurrentMycode()->getCodes());
                $myblock->setEndAddressBlock($address_end_block);

                $inst_block = new MyInstruction(Opcodes::LEAVE_BLOCK);
                $inst_block->addProperty(MyInstruction::MYBLOCK, $myblock);
                $this->context->getCurrentMycode()->addCode($inst_block);
            }
        }
    }

    public function enterFunc(Func $func)
    {
        // blocks are set back to zero when entering new function
        $this->context->setCurrentBlock(null);

        $myfunction = new MyFunction($func->name);
        $this->context->setCurrentMycode($myfunction->getMyCode());

        $inst_func = new MyInstruction(Opcodes::ENTER_FUNCTION);
        $inst_func->addProperty(MyInstruction::MYFUNC, $myfunction);
        $this->context->getCurrentMycode()->addCode($inst_func);

        if (!is_null($func->class)) {
            $class_name = $func->class->value;
            // at this moment class is defined
            $myclass = $this->context->getClasses()->getMyClass($class_name);

            if (!is_null($myclass)) {
                $myclass->addMethod($myfunction);

                $myfunction->setVisibility(Common::getTypeVisibility($func->flags));
                $myfunction->addType(MyFunction::TYPE_FUNC_METHOD);
                $myfunction->setMyClass($myclass);

                if (($func->flags & Func::FLAG_STATIC) === Func::FLAG_STATIC) {
                    $myfunction->addType(MyFunction::TYPE_FUNC_STATIC);
                }

                $mythisdef = new MyDefinition(0, 0, "this");
                $mythisdef->setBlockId(0);
                $mythisdef->addType(MyDefinition::TYPE_INSTANCE);
                $myfunction->setThisDef($mythisdef);
            }
        }

        foreach ($func->params as $param) {
            $param_name = $param->name->value;
            $byref = $param->byRef;

            $mydef = new MyDefinition($param->getLine(), $param->getAttribute("startFilePos", -1), $param_name);

            if ($byref) {
                $mydef->addType(MyDefinition::TYPE_REFERENCE);
            }

            $myfunction->addParam($mydef);

            $inst_def = new MyInstruction(Opcodes::DEFINITION);
            $inst_def->addProperty(MyInstruction::DEF, $mydef);
            $this->context->getCurrentMycode()->addCode($inst_def);

            unset($mydef);
        }

        // because when we call (funccall) a function by name, it can be undefined
        $this->context->getFunctions()->addFunction($myfunction->getName(), $myfunction);
        $this->context->setCurrentFunc($myfunction);
    }

    public function leaveFunc(Func $func)
    {
        $mycode_codes = $this->context->getCurrentMycode()->getCodes();

        $inst = $mycode_codes[count($mycode_codes) - 1];

        // we can have a block opened and we need to leave it
        if ($inst->getOpcode() !== Opcodes::LEAVE_BLOCK) {
            if (!is_null($this->context->getCurrentBlock())) {
                $myblock = $this->s_blocks[$this->context->getCurrentBlock()];
                $myblock->setEndAddressBlock(count($this->context->getCurrentMycode()->getCodes()));

                $inst_block = new MyInstruction(Opcodes::LEAVE_BLOCK);
                $inst_block->addProperty(MyInstruction::MYBLOCK, $myblock);
                $this->context->getCurrentMycode()->addCode($inst_block);
            }
        }

        $class_name = null;
        if (!is_null($func->class)) {
            $class_name = $func->class->value;
        }

        $myfunction = $this->context->getFunctions()->getFunction($func->name, $class_name);

        if (!is_null($myfunction)) {
            $myfunction->setLastLine($this->context->getCurrentLine());
            $myfunction->setLastColumn($this->context->getCurrentColumn());
            $myfunction->setLastBlockId(-1);

            $inst_func = new MyInstruction(Opcodes::LEAVE_FUNCTION);
            $inst_func->addProperty(MyInstruction::MYFUNC, $myfunction);
            $this->context->getCurrentMycode()->addCode($inst_func);
        }
    }

    public function parseCondition($inst_start_if, $cond)
    {
        foreach ($cond as $ops) {
            if ($ops instanceof Op\Expr\BooleanNot) {
                $inst_start_if->addProperty(MyInstruction::NOT_BOOLEAN, true);
                $this->parseCondition($inst_start_if, $ops->expr->ops);
            }
        }
    }

    public function enterOp(Op $op, Block $block)
    {
        $this->context->setCurrentOp($op);
        $this->context->setCurrentBlock($block);

        // for theses objects getline et getcolumn methods exists except for assertion
        if ($op instanceof Op\Stmt ||
                    ($op instanceof Op\Expr && !($op instanceof Op\Expr\Assertion)) ||
                    $op instanceof Op\Terminal) {
            if ($op->getLine() !== -1 && $op->getAttribute("startFilePos", -1) !== -1) {
                $this->context->setCurrentLine($op->getLine());
                $this->context->setCurrentColumn($op->getAttribute("startFilePos", -1));
            }
        }

        if ($op instanceof Op\Stmt\JumpIf) {
            $inst_start_if = new MyInstruction(Opcodes::COND_START_IF);
            $this->context->getCurrentMycode()->addCode($inst_start_if);

            $this->block_if_to_be_resolved[] = [$inst_start_if, $op->if, $op->else];

            $this->parseCondition($inst_start_if, $op->cond->ops);
        }
        /*
           const TYPE_INCLUDE = 1;
           const TYPE_INCLUDE_OPNCE = 2;
           const TYPE_REQUIRE = 3;
           const TYPE_REQUIRE_ONCE = 4;
        */

        if ($op instanceof Op\Expr\Include_) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myexpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myexpr, false);

                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                $this->context->getCurrentMycode()->addCode($inst_end_expr);
            }
        } elseif ($op instanceof Op\Terminal\GlobalVar) {
            $name_global = Common::getNameDefinition($this->context->getCurrentOp()->var);

            $mydef_global = new MyDefinition(
                $this->context->getCurrentLine(),
                $this->context->getCurrentColumn(),
                $name_global
            );
            $mydef_global->setType(MyDefinition::TYPE_GLOBAL);

            $inst_def = new MyInstruction(Opcodes::DEFINITION);
            $inst_def->addProperty(MyInstruction::DEF, $mydef_global);
            $this->context->getCurrentMycode()->addCode($inst_def);
        } elseif ($op instanceof Op\Terminal\Return_) {
            Assign::instruction($this->context, true);

            $inst = new MyInstruction(Opcodes::RETURN_FUNCTION);
            $inst->addProperty(MyInstruction::RETURN_DEFS, $this->context->getCurrentFunc()->getReturnDefs());
            $this->context->getCurrentMycode()->addCode($inst);
        } elseif ($op instanceof Op\Expr\Eval_) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myexpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myexpr, false);

                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                $this->context->getCurrentMycode()->addCode($inst_end_expr);
            }
        } elseif ($op instanceof Op\Terminal\Echo_) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myexpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myexpr, false);

                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                $this->context->getCurrentMycode()->addCode($inst_end_expr);
            }
        } elseif ($op instanceof Op\Expr\Print_) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myexpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myexpr, false);

                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                $this->context->getCurrentMycode()->addCode($inst_end_expr);
            }
        } elseif ($op instanceof Op\Expr\StaticCall) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myexpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myexpr, false, false, true);

                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                $this->context->getCurrentMycode()->addCode($inst_end_expr);
            }
        } elseif ($op instanceof Op\Expr\FuncCall || $op instanceof Op\Expr\NsFuncCall) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myexpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myexpr, false);

                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                $this->context->getCurrentMycode()->addCode($inst_end_expr);
            }
        } elseif ($op instanceof Op\Expr\MethodCall) {
            if (Common::isFuncCallWithoutReturn($op)) {
                $class_name = Common::getNameDefinition($op->var);

                $myexpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());

                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myexpr, false, true);

                $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
                $inst_end_expr->addProperty(MyInstruction::EXPR, $myexpr);
                $this->context->getCurrentMycode()->addCode($inst_end_expr);
            }
        } elseif ($op instanceof Op\Expr\Assign || $op instanceof Op\Expr\AssignRef) {
            Assign::instruction($this->context);
        } elseif ($op instanceof Op\Stmt\Class_) {
            $class_name = Common::getNameDefinition($op);

            $myclass = new MyClass(
                $this->context->getCurrentLine(),
                $this->context->getCurrentColumn(),
                $class_name
            );
            $this->context->getClasses()->addMyclass($myclass);
            
            foreach ($op->stmts->children as $property) {
                // if($property instanceof Op\Stmt\ClassMethod)
                if ($property instanceof Op\Stmt\Property) {
                    $property_name = Common::getNameDefinition($property);
                    $visibility = Common::getTypeVisibility($property->visiblity);

                    $mydef = new MyDefinition(
                        $property->getLine(),
                        $property->getAttribute("startFilePos", -1),
                        "this"
                    );
                    $mydef->property->setVisibility($visibility);
                    $mydef->property->addProperty($property_name);
                    $mydef->setClassName($class_name);

                    // it's necessary for securityanalysis (visibility)
                    $mydef->addType(MyDefinition::TYPE_PROPERTY);
                    $myclass->addProperty($mydef);
                }
            }

            $inst_class = new MyInstruction(Opcodes::CLASSE);
            $inst_class->addProperty(MyInstruction::MYCLASS, $myclass);
            $this->context->getCurrentMycode()->addCode($inst_class);
        }
    }
}
