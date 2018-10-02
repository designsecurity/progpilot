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
use PHPCfg\Printer;

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
    private $sBlocks;
    private $context;
    private $blockIfToBeResolved;
    private $insideInclude;

    public function __construct()
    {
        $this->sBlocks = new \SplObjectStorage;
        $this->blockIfToBeResolved = [];
    }

    public function setContext($context)
    {
        $this->context = $context;
    }

    public function enterScript(Script $script)
    {
        $this->context->outputs->currentIncludesFile = [];
    }

    public function leaveScript(Script $script)
    {
        // creating edges for myblocks structure as block structure
        foreach ($this->sBlocks as $block) {
            $myBlock = $this->sBlocks[$block];
            foreach ($block->parents as $block_parent) {
                if ($this->sBlocks->contains($block_parent)) {
                    $myBlockParent = $this->sBlocks[$block_parent];
                    $myBlock->addParent($myBlockParent);
                }
            }
        }

        foreach ($this->blockIfToBeResolved as $blockResolved) {
            $instructionIf = $blockResolved[0];
            $blockIf = $blockResolved[1];
            $blockElse = $blockResolved[2];

            if ($this->sBlocks->contains($blockIf) && $this->sBlocks->contains($blockElse)) {
                $myBlockIf = $this->sBlocks[$blockIf];
                $myBlockElse = $this->sBlocks[$blockElse];

                $instructionIf->addProperty(MyInstruction::MYBLOCK_IF, $myBlockIf);
                $instructionIf->addProperty(MyInstruction::MYBLOCK_ELSE, $myBlockElse);
            }
        }
        
        // extends class
        foreach ($this->context->getClasses()->getListClasses() as $myClass) {
            if (!is_null($myClass->getExtendsOf())) {
                $myClassFather = $this->context->getClasses()->getMyClass($myClass->getExtendsOf());
                if (!is_null($myClassFather)) {
                    foreach ($myClassFather->getMethods() as $methodFather) {
                        $myClass->addMethod(clone $methodFather);
                        $methodFather->setMyClass($myClass);
                    }
                                    
                    foreach ($myClassFather->getProperties() as $propertyFather) {
                        $myClass->addProperty(clone $propertyFather);
                    }
                }
            }
        }
        
        /*
        $printer = new Printer\Text();
        var_dump($printer->printScript($script));
        */
    }

    public function enterBlock(Block $block, Block $prior = null)
    {
        $this->insideInclude = false;
        if (!($this->context->getCurrentOp() instanceof Op\Expr\Include_)) {
            $myBlock = new MyBlock;
            $myBlock->setStartAddressBlock(count($this->context->getCurrentMycode()->getCodes()));
            $this->context->setCurrentBlock($block);

            $this->sBlocks[$block] = $myBlock;

            $instBlock = new MyInstruction(Opcodes::ENTER_BLOCK);
            $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
            $this->context->getCurrentMycode()->addCode($instBlock);

            // block is for himself a parent block (handle dataflow for first block)
            $block->addParent($block);

            $myBlock->setId(rand());
        } else {
            $this->insideInclude = true;
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
        if (!$this->insideInclude) {
            if ($this->sBlocks->contains($block)) {
                $myBlock = $this->sBlocks[$block];

                $address_end_block = count($this->context->getCurrentMycode()->getCodes());
                $myBlock->setEndAddressBlock($address_end_block);

                $instBlock = new MyInstruction(Opcodes::LEAVE_BLOCK);
                $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
                $this->context->getCurrentMycode()->addCode($instBlock);
            }
        }
    }

    public function enterFunc(Func $func)
    {
        // blocks are set back to zero when entering new function
        $this->context->setCurrentBlock(null);

        $myFunction = new MyFunction($func->name);
        $this->context->setCurrentMycode($myFunction->getMyCode());

        $instFunc = new MyInstruction(Opcodes::ENTER_FUNCTION);
        $instFunc->addProperty(MyInstruction::MYFUNC, $myFunction);
        $this->context->getCurrentMycode()->addCode($instFunc);

        if (!is_null($func->class)) {
            $className = $func->class->value;
            // at this moment class is defined
            $myClass = $this->context->getClasses()->getMyClass($className);

            if (!is_null($myClass)) {
                $myClass->addMethod($myFunction);

                $myFunction->setVisibility(Common::getTypeVisibility($func->flags));
                $myFunction->addType(MyFunction::TYPE_FUNC_METHOD);
                $myFunction->setMyClass($myClass);

                if (($func->flags & Func::FLAG_STATIC) === Func::FLAG_STATIC) {
                    $myFunction->addType(MyFunction::TYPE_FUNC_STATIC);
                }

                $mythisdef = new MyDefinition(0, 0, "this");
                $mythisdef->setBlockId(0);
                $mythisdef->addType(MyDefinition::TYPE_INSTANCE);
                $myFunction->setThisDef($mythisdef);
            }
        }

        foreach ($func->params as $param) {
            $paramName = $param->name->value;
            $byref = $param->byRef;

            $myDef = new MyDefinition($param->getLine(), $param->getAttribute("startFilePos", -1), $paramName);

            if ($byref) {
                $myDef->addType(MyDefinition::TYPE_REFERENCE);
            }

            $myFunction->addParam($myDef);

            $instDef = new MyInstruction(Opcodes::DEFINITION);
            $instDef->addProperty(MyInstruction::DEF, $myDef);
            $this->context->getCurrentMycode()->addCode($instDef);

            unset($myDef);
        }

        // because when we call (funccall) a function by name, it can be undefined
        $this->context->getFunctions()->addFunction($myFunction->getName(), $myFunction);
        $this->context->setCurrentFunc($myFunction);
    }

    public function leaveFunc(Func $func)
    {
        $myCodeCodes = $this->context->getCurrentMycode()->getCodes();

        $inst = $myCodeCodes[count($myCodeCodes) - 1];

        // we can have a block opened and we need to leave it
        if ($inst->getOpcode() !== Opcodes::LEAVE_BLOCK) {
            if (!is_null($this->context->getCurrentBlock())) {
                $myBlock = $this->sBlocks[$this->context->getCurrentBlock()];
                $myBlock->setEndAddressBlock(count($this->context->getCurrentMycode()->getCodes()));

                $instBlock = new MyInstruction(Opcodes::LEAVE_BLOCK);
                $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
                $this->context->getCurrentMycode()->addCode($instBlock);
            }
        }

        $className = null;
        if (!is_null($func->class)) {
            $className = $func->class->value;
        }

        $myFunction = $this->context->getFunctions()->getFunction($func->name, $className);

        if (!is_null($myFunction)) {
            $myFunction->setLastLine($this->context->getCurrentLine());
            $myFunction->setLastColumn($this->context->getCurrentColumn());
            $myFunction->setLastBlockId(-1);

            $instFunc = new MyInstruction(Opcodes::LEAVE_FUNCTION);
            $instFunc->addProperty(MyInstruction::MYFUNC, $myFunction);
            $this->context->getCurrentMycode()->addCode($instFunc);
        }
    }

    public function parseconditions($instStartIf, $cond)
    {
        foreach ($cond as $ops) {
            if ($ops instanceof Op\Expr\BooleanNot) {
                $instStartIf->addProperty(MyInstruction::NOT_BOOLEAN, true);
                $this->parseconditions($instStartIf, $ops->expr->ops);
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
            $instStartIf = new MyInstruction(Opcodes::COND_START_IF);
            $this->context->getCurrentMycode()->addCode($instStartIf);

            $this->blockIfToBeResolved[] = [$instStartIf, $op->if, $op->else];
            
            $myblock = $this->sBlocks[$block];
            $myblock->setIsLoop(true);
            
            $this->parseconditions($instStartIf, $op->cond->ops);
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
                $myExpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myExpr, false);

                $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                $this->context->getCurrentMycode()->addCode($instEndExpr);
            }
        } elseif ($op instanceof Op\Terminal\GlobalVar) {
            $nameGlobal = Common::getNameDefinition($this->context->getCurrentOp()->var);

            $myDefGlobal = new MyDefinition(
                $this->context->getCurrentLine(),
                $this->context->getCurrentColumn(),
                $nameGlobal
            );
            $myDefGlobal->setType(MyDefinition::TYPE_GLOBAL);

            $instDef = new MyInstruction(Opcodes::DEFINITION);
            $instDef->addProperty(MyInstruction::DEF, $myDefGlobal);
            $this->context->getCurrentMycode()->addCode($instDef);
        } elseif ($op instanceof Op\Terminal\Return_) {
            Assign::instruction($this->context, true);

            $inst = new MyInstruction(Opcodes::RETURN_FUNCTION);
            $inst->addProperty(MyInstruction::RETURN_DEFS, $this->context->getCurrentFunc()->getReturnDefs());
            $this->context->getCurrentMycode()->addCode($inst);
        } elseif ($op instanceof Op\Expr\Eval_) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myExpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myExpr, false);

                $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                $this->context->getCurrentMycode()->addCode($instEndExpr);
            }
        } elseif ($op instanceof Op\Terminal\Echo_) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myExpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myExpr, false);

                $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                $this->context->getCurrentMycode()->addCode($instEndExpr);
            }
        } elseif ($op instanceof Op\Expr\Print_) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myExpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myExpr, false);

                $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                $this->context->getCurrentMycode()->addCode($instEndExpr);
            }
        } elseif ($op instanceof Op\Expr\Exit_) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myExpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myExpr, false);

                $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                $this->context->getCurrentMycode()->addCode($instEndExpr);
            }
        } elseif ($op instanceof Op\Expr\StaticCall) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myExpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myExpr, false, false, true);

                $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                $this->context->getCurrentMycode()->addCode($instEndExpr);
            }
        } elseif ($op instanceof Op\Expr\FuncCall || $op instanceof Op\Expr\NsFuncCall) {
            if (Common::isFuncCallWithoutReturn($op)) {
                // expr of type "assign" to have a defined return
                $myExpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());
                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myExpr, false);

                $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                $this->context->getCurrentMycode()->addCode($instEndExpr);
            }
        } elseif ($op instanceof Op\Expr\MethodCall) {
            if (Common::isFuncCallWithoutReturn($op)) {
                $className = Common::getNameDefinition($op->var);

                $myExpr = new MyExpr($this->context->getCurrentLine(), $this->context->getCurrentColumn());

                $this->context->getCurrentMycode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                FuncCall::instruction($this->context, $myExpr, false, true);

                $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                $this->context->getCurrentMycode()->addCode($instEndExpr);
            }
        } elseif ($op instanceof Op\Expr\Assign || $op instanceof Op\Expr\AssignRef) {
            Assign::instruction($this->context);
        } elseif ($op instanceof Op\Stmt\Class_) {
            $className = Common::getNameDefinition($op);

            $myClass = new MyClass(
                $this->context->getCurrentLine(),
                $this->context->getCurrentColumn(),
                $className
            );
            
            if (!is_null($op->extends)) {
                $myClass->setExtendsOf($op->extends->value);
            }
                
            $this->context->getClasses()->addMyclass($myClass);
            
            foreach ($op->stmts->children as $property) {
                // if($property instanceof Op\Stmt\ClassMethod)
                if ($property instanceof Op\Stmt\Property) {
                    $propertyName = Common::getNameDefinition($property);
                    $visibility = Common::getTypeVisibility($property->visiblity);

                    $myDef = new MyDefinition(
                        $property->getLine(),
                        $property->getAttribute("startFilePos", -1),
                        "this"
                    );
                    $myDef->property->setVisibility($visibility);
                    $myDef->property->addProperty($propertyName);
                    $myDef->setClassName($className);

                    // it's necessary for SecurityAnalysis (visibility)
                    
                    if ($property->static === 8) {
                        $myDef->addType(MyDefinition::TYPE_STATIC_PROPERTY);
                    } else {
                        $myDef->addType(MyDefinition::TYPE_PROPERTY);
                    }
                        
                    $myClass->addProperty($myDef);
                }
            }

            $instClass = new MyInstruction(Opcodes::CLASSE);
            $instClass->addProperty(MyInstruction::MYCLASS, $myClass);
            $this->context->getCurrentMycode()->addCode($instClass);
        }
    }
}
