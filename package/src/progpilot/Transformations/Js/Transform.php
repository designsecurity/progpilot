<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Js;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyBlock;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyClass;
use progpilot\Objects\MyOp;
use progpilot\Objects\MyFile;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;

use progpilot\Transformations\Js\V8JsNodeModuleLoader_NormalisePath;
use progpilot\Transformations\Js\V8JsNodeModuleLoader_NativeFileAccess;
use progpilot\Transformations\Js\V8JsNodeModuleLoader;

class Transform
{
    private $sIdBlocks;
    private $context;
    private $blockIfToBeResolved;
    private $insideInclude;

    public function __construct()
    {
        $this->sIdBlocks = [];
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
    
    public function v8jsExecute()
    {
        $loader = new V8JsNodeModuleLoader();

        $loader->addOverride('walkes', './node_modules/walkes/index.js');
        $loader->addOverride('esgraph', './node_modules/esgraph/lib/index.js');

        $v8 = new \V8Js();
        $v8->setModuleNormaliser([ $loader, 'normaliseIdentifier' ]);
        $v8->setModuleLoader([ $loader, 'loadModule' ]);
        $v8->code = file_get_contents($this->context->inputs->getFile());
        
        $v8->echo = function ($string) {
            echo $string;
        };

        try {
            $cfg = $v8->executeString(file_get_contents(__DIR__.'/Parse.js'));
                    
            if (is_array($cfg[2])) {
                // main javascript
                $myFunction = new MyFunction("{main}");
                $this->context->setCurrentMycode($myFunction->getMyCode());
                
                $instFunc = new MyInstruction(Opcodes::ENTER_FUNCTION);
                $instFunc->addProperty(MyInstruction::MYFUNC, $myFunction);
                $this->context->getCurrentMycode()->addCode($instFunc);
                
                // because when we call (funccall) a function by name, it can be undefined
                $this->context->getFunctions()->addFunction($myFunction->getName(), $myFunction);
                $this->context->setCurrentFunc($myFunction);
            
                foreach ($cfg[2] as $FlowNode) {
                    $astNode = $FlowNode->astNode;
                    
                    
                    if (isset($astNode->type)) {
                        if ($astNode->type !== "exit") {
                            $myBlock = new MyBlock;
                            $myBlock->setStartAddressBlock(count($this->context->getCurrentMycode()->getCodes()));
                            //$this->context->setCurrentBlock($FlowNode);

                            $this->sIdBlocks[$FlowNode->id] = [$FlowNode, $myBlock];

                            $instBlock = new MyInstruction(Opcodes::ENTER_BLOCK);
                            $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
                            $this->context->getCurrentMycode()->addCode($instBlock);

                            // block is for himself a parent block (handle dataflow for first block)
                            //$block->addParent($block);

                            $myBlock->setId(rand());
                            
                            
                            switch ($astNode->type) {
                                case 'AssignmentExpression':
                                    $myExpr = new MyExpr(
                                        $astNode->right->loc->start->line,
                                        $astNode->right->loc->start->column
                                    );
                                    
                                    $this->context->getCurrentMycode()->addCode(
                                        new MyInstruction(Opcodes::START_ASSIGN)
                                    );
                                    $this->context->getCurrentMycode()->addCode(
                                        new MyInstruction(Opcodes::START_EXPRESSION)
                                    );
                                    
                                    $backDef = Expr::assignment($astNode, $this->context, $myExpr);
                                    
                                    $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                                    $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                                    $this->context->getCurrentMycode()->addCode($instEndExpr);

                                    $this->context->getCurrentMycode()->addCode(
                                        new MyInstruction(Opcodes::END_ASSIGN)
                                    );
                                    
                                    $name = Common::getNameDefinition($astNode->left);
                                    
                                    $myDef = new MyDefinition(
                                        $astNode->left->loc->start->line,
                                        $astNode->left->loc->start->column,
                                        $name
                                    );
                                    $myExpr->setAssign(true);
                                    $myExpr->setAssignDef($myDef);

                                    $instDef = new MyInstruction(Opcodes::DEFINITION);
                                    $instDef->addProperty(MyInstruction::DEF, $myDef);
                                    $this->context->getCurrentMycode()->addCode($instDef);
                                    
                                    break;
                            
                                case 'VariableDeclaration':
                                    foreach ($astNode->declarations as $VariableDeclarator) {
                                        $myinit = $VariableDeclarator->init;
                                        if ($myinit != null) {
                                            $myExpr = new MyExpr(
                                                $VariableDeclarator->id->loc->start->line,
                                                $VariableDeclarator->id->loc->start->column
                                            );
                                    
                                            $this->context->getCurrentMycode()->addCode(
                                                new MyInstruction(Opcodes::START_ASSIGN)
                                            );
                                            $this->context->getCurrentMycode()->addCode(
                                                new MyInstruction(Opcodes::START_EXPRESSION)
                                            );
                                            
                                            /* var identifier = */
                                            /* = init */
                                            $mydef = new MyDefinition(
                                                $VariableDeclarator->id->loc->start->line,
                                                $VariableDeclarator->id->loc->start->column,
                                                $VariableDeclarator->id->name
                                            );
                                            
                                            switch ($myinit->type) {
                                                case 'CallExpression':
                                                    FuncCall::instruction($this->context, $myExpr, $myinit);
                                                    break;

                                                default:
                                                    $name = Common::getNameDefinition($myinit);
                                                    $type = Common::getTypeDefinition($myinit);
                                                    $mytemp = new MyDefinition(
                                                        $myinit->loc->start->line,
                                                        $myinit->loc->start->column,
                                                        $name
                                                    );
                                                        
                                                    $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
                                                    $instTemporarySimple->addProperty(
                                                        MyInstruction::TEMPORARY,
                                                        $mytemp
                                                    );
                                                    $this->context->getCurrentMycode()->addCode($instTemporarySimple);
                                                    $mytemp->setExpr($myExpr);
                                                
                                                    break;
                                            }
                                                
                                            $myExpr->setAssign(true);
                                            $myExpr->setAssignDef($mydef);
                                            
                                            $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                                            $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                                            $this->context->getCurrentMycode()->addCode($instEndExpr);

                                            $this->context->getCurrentMycode()->addCode(
                                                new MyInstruction(Opcodes::END_ASSIGN)
                                            );
                                                
                                            $instDef = new MyInstruction(Opcodes::DEFINITION);
                                            $instDef->addProperty(MyInstruction::DEF, $mydef);
                                            $this->context->getCurrentMycode()->addCode($instDef);
                                        }
                                    }
                                    
                                    break;
                            
                                case 'CallExpression':
                                    $myExpr = new MyExpr(
                                        $astNode->loc->start->line,
                                        $astNode->loc->start->column
                                    );
                                    $this->context->getCurrentMycode()->addCode(
                                        new MyInstruction(Opcodes::START_EXPRESSION)
                                    );
        
                                    FuncCall::instruction($this->context, $myExpr, $astNode);
                                                    
                                    $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                                    $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                                    $this->context->getCurrentMycode()->addCode($instEndExpr);
                                    
                                    break;
                            
                                case 'ReturnStatement':
                                    break;
                            }
                            
                            $address_end_block = count($this->context->getCurrentMycode()->getCodes());
                            $myBlock->setEndAddressBlock($address_end_block);

                            $instBlock = new MyInstruction(Opcodes::LEAVE_BLOCK);
                            $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
                            $this->context->getCurrentMycode()->addCode($instBlock);
                        }
                    }
                }
                
                /*
                $myFunction->setLastLine($astNode);
                $myFunction->setLastColumn($astNode);
                */
                $myFunction->setLastBlockId(-1);

                $instFunc = new MyInstruction(Opcodes::LEAVE_FUNCTION);
                $instFunc->addProperty(MyInstruction::MYFUNC, $myFunction);
                $this->context->getCurrentMycode()->addCode($instFunc);
            
                // creating edges for myblocks structure as block structure
                foreach ($this->sIdBlocks as $id => $arrNode) {
                    $aFlowNode = $arrNode[0];
                    $myBlock = $arrNode[1];
                    
                    foreach ($aFlowNode->prev as $aFlowNodeParent) {
                        if (isset($this->sIdBlocks[$aFlowNodeParent->id])) {
                            $arrParent = $this->sIdBlocks[$aFlowNodeParent->id];
                            $aFlowNodeParent = $arrParent[0];
                            $myBlockParent = $arrParent[1];
                            $myBlock->addParent($myBlockParent);
                        }
                    }
                }
            }
        } catch (V8JsScriptException $e) {
            var_dump($e);
        }
    }
}
