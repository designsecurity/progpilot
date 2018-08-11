<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Code;

use progpilot\Objects\MyOp;
use progpilot\Objects\MyBlock;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyFunction;

class MyCode
{
    private $code;
    private $start;
    private $end;

    public function __construct()
    {
        $this->code = [];
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function setEnd($end)
    {
        $this->end = $end;
    }

    public function setCodes($codes)
    {
        $this->code = $codes;
    }

    public function getCodes()
    {
        return $this->code;
    }

    public function addCode($code)
    {
        $this->code[] = $code;
    }

    public function getLastCode()
    {
        $last_index = count($this->code);
        return $this->code[$last_index - 1];
    }

    public static function readCode($context, $codeInput, $myJavascriptFile)
    {
        $myFunction = new MyFunction("{main}");
        $context->setCurrentMycode($myFunction->getMyCode());
        $context->getFunctions()->addFunction($myFunction->getName(), $myFunction);

        $instFunc = new MyInstruction(Opcodes::ENTER_FUNCTION);
        $instFunc->addProperty(MyInstruction::MYFUNC, $myFunction);
        $myFunction->getMyCode()->addCode($instFunc);

        if (is_array($codeInput)) {
            $arrayMyBlocks = [];
            $arrayMyBlocksChilds = [];

            $arrayExprs = [];
            $arrayDefinitions = [];
            
            $nbInst = 0;

            while (count($codeInput) > $nbInst) {
                $buffer = $codeInput[$nbInst ++];

                switch ($buffer) {
                    case 'EnterBlock':
                        $myBlockString = $codeInput[$nbInst ++];
                        $myBlockId = (int) $codeInput[$nbInst ++];
                        $edges = $codeInput[$nbInst ++];
                        $nbEdges = (int) $codeInput[$nbInst ++];

                        $myBlock = new MyBlock;
                        $myBlock->setId($myBlockId);
                        $myBlock->setStartAddressBlock(count($myFunction->getMyCode()->getCodes()));

                        $arrayMyBlocks[$myBlockId] = $myBlock;
                        $arrayMyBlocksChilds[$myBlockId] = [];

                        for ($i = 0; $i < $nbEdges; $i ++) {
                            $idChild = (int) $codeInput[$nbInst ++];
                            $arrayMyBlocksChilds[$myBlockId][] = $idChild;
                        }

                        $instBlock = new MyInstruction(Opcodes::ENTER_BLOCK);
                        $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
                        $myFunction->getMyCode()->addCode($instBlock);

                        break;

                    case 'LeaveBlock':
                        $myBlockString = $codeInput[$nbInst ++];
                        $myBlockId = (int) $codeInput[$nbInst ++];

                        if (isset($arrayMyBlocks[$myBlockId])) {
                            $myBlock = $arrayMyBlocks[$myBlockId];
                            $myBlock->setEndAddressBlock(count($myFunction->getMyCode()->getCodes()));

                            $instBlock = new MyInstruction(Opcodes::LEAVE_BLOCK);
                            $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
                            $myFunction->getMyCode()->addCode($instBlock);
                        }

                        break;

                    case 'Definition':
                        $code = $myFunction->getMyCode()->getCodes();
                        $lastOpCode = $code[count($code) - 1];

                        $defString = $codeInput[$nbInst ++];
                        $defName = $codeInput[$nbInst ++];
                        $defLine = (int) $codeInput[$nbInst ++];
                        $defColumn = (int) $codeInput[$nbInst ++];

                        $myDef = new MyDefinition($defLine, $defColumn, $defName);
                        $myDef->setSourceMyFile($myJavascriptFile);
                        $arrayDefinitions[] = $myDef;

                        $instDef = new MyInstruction(Opcodes::DEFINITION);
                        $instDef->addProperty(MyInstruction::DEF, $myDef);
                        $myFunction->getMyCode()->addCode($instDef);

                        break;

                    case 'funccall':
                        $funcString = $codeInput[$nbInst ++];
                        $funcLine = (int) $codeInput[$nbInst ++];
                        $funcColumn = (int) $codeInput[$nbInst ++];
                        $funcName = $codeInput[$nbInst ++];
                        $funcIsInstance = $codeInput[$nbInst ++];
                        $funcNameInstance = $codeInput[$nbInst ++];
                        $funcNbParams = (int) $codeInput[$nbInst ++];

                        $instFuncCallMain = new MyInstruction(Opcodes::FUNC_CALL);
                        $instFuncCallMain->addProperty(MyInstruction::FUNCNAME, $funcName);

                        $myFunctionCall = new MyFunction($funcName);
                        $myFunctionCall->setLine($funcLine);
                        $myFunctionCall->setColumn($funcColumn);
                        $myFunctionCall->setNbParams($funcNbParams);
                        $myFunctionCall->setSourceMyFile($myJavascriptFile);

                        if ($funcIsInstance === "true") {
                            $myFunctionCall->addType(MyFunction::TYPE_FUNC_METHOD);
                            $myFunctionCall->setNameInstance($funcNameInstance);

                            $mybackdef = new MyDefinition($funcLine, $funcColumn, $funcNameInstance);
                            $mybackdef->addType(MyDefinition::TYPE_INSTANCE);
                            $mybackdef->setSourceMyFile($myJavascriptFile);
                            $myFunctionCall->setBackDef($mybackdef);
                        }

                        for ($j = 0; $j < $funcNbParams; $j ++) {
                            $funcDefIdParam = (int) $codeInput[$nbInst ++];
                            $funcExprIdParam = (int) $codeInput[$nbInst ++];
                            $funcDefParam = $arrayDefinitions[$funcDefIdParam];
                            $funcExprParam = $arrayExprs[$funcExprIdParam];
                            $instFuncCallMain->addProperty("argdef$j", $funcDefParam);
                            $instFuncCallMain->addProperty("argexpr$j", $funcExprParam);
                        }

                        $funcExprString = $codeInput[$nbInst ++];
                        $funcExprId = (int) $codeInput[$nbInst ++];

                        // !!!!????
                        //$myExpr = $arrayExprs[$funcExprId];
                        $myExpr = null;

                        $instFuncCallMain->addProperty(MyInstruction::MYFUNC_CALL, $myFunctionCall);
                        $instFuncCallMain->addProperty(MyInstruction::EXPR, $myExpr);
                        $instFuncCallMain->addProperty(MyInstruction::ARR, null);
                        $myFunction->getMyCode()->addCode($instFuncCallMain);

                        break;

                    case 'temporary':
                        $defString = $codeInput[$nbInst ++];
                        $defName = $codeInput[$nbInst ++];
                        $defLine = (int) $codeInput[$nbInst ++];
                        $defColumn = (int) $codeInput[$nbInst ++];

                        $myTemp = new MyDefinition($defLine, $defColumn, $defName);
                        $myTemp->setSourceMyFile($myJavascriptFile);
                        $arrayDefinitions[] = $myTemp;

                        $nbExprs = (int) $codeInput[$nbInst ++];
                        for ($i = 0; $i < $nbExprs; $i ++) {
                            $idExpr = (int) $codeInput[$nbInst ++];
                            $myTemp->setExpr($idExpr);
                        }

                        $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
                        $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $myTemp);
                        $myFunction->getMyCode()->addCode($instTemporarySimple);

                        break;

                    case 'start_assign':
                        $myFunction->getMyCode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));

                        break;

                    case 'end_assign':
                        $myFunction->getMyCode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

                        break;

                    case 'start_expression':
                        $myFunction->getMyCode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                        break;

                    case 'end_expression':
                        $exprString = $codeInput[$nbInst ++];
                        $exprLine = (int) $codeInput[$nbInst ++];
                        $exprColumn = (int) $codeInput[$nbInst ++];

                        $myExpr = new MyExpr($exprLine, $exprColumn);

                        $exprIsAssign =  $codeInput[$nbInst ++];

                        if ($exprIsAssign === "true") {
                            $exprDefAssignId = (int) $codeInput[$nbInst ++];
                            $myExpr->setAssign(true);
                            $myExpr->setAssignDef($exprDefAssignId);
                        }

                        $nbExprs = (int) $codeInput[$nbInst ++];

                        $arrayExprs[] = $myExpr;

                        for ($i = 0; $i < $nbExprs; $i ++) {
                            $defId = (int) $codeInput[$nbInst ++];
                            $myExpr->addDef($defId);
                        }

                        $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                        $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                        $myFunction->getMyCode()->addCode($instEndExpr);

                        break;
                }
            }

            foreach ($arrayMyBlocks as $parent) {
                $parent->addParent($parent);
                $childs = $arrayMyBlocksChilds[$parent->getId()];

                foreach ($childs as $child) {
                    if (isset($arrayMyBlocks[$child])) {
                        $myBlockChild = $arrayMyBlocks[$child];
                        $myBlockChild->addParent($parent);
                    }
                }
            }

            foreach ($arrayExprs as $myExpr) {
                $defs = $myExpr->getDefs();
                $myExpr->setDefs(array());

                if ($myExpr->isAssign()) {
                    $defId = $myExpr->getAssignDef();
                    if (isset($arrayDefinitions[$defId])) {
                        $myDef = $arrayDefinitions[$defId];
                        $myExpr->setAssignDef($myDef);
                    }
                }

                foreach ($defs as $defId) {
                    if (isset($arrayDefinitions[$defId])) {
                        $myDef = $arrayDefinitions[$defId];
                        $myExpr->addDef($myDef);
                    }
                }
            }

            foreach ($arrayDefinitions as $myDef) {
                $expr = $myDef->getExpr();
                
                if (isset($arrayExprs[$expr])) {
                    $myExpr = $arrayExprs[$expr];
                    $myDef->setExpr($myExpr);
                }
            }

            $instFunc = new MyInstruction(Opcodes::LEAVE_FUNCTION);
            $instFunc->addProperty(MyInstruction::MYFUNC, $myFunction);
            $myFunction->getMyCode()->addCode($instFunc);

            $myFunction->getMyCode()->setStart(0);
            $myFunction->getMyCode()->setEnd(count($myFunction->getMyCode()->getCodes()));
        }
    }

    public function printStdout()
    {
        $index = 0;

        do {
            if (isset($this->code[$index])) {
                $instruction = $this->code[$index];
                echo "[$index] ";
                switch ($instruction->getOpcode()) {
                    case Opcodes::ENTER_FUNCTION:
                        echo Opcodes::ENTER_FUNCTION."\n";

                        $myFunc = $instruction->getProperty(MyInstruction::MYFUNC);
                        echo "name = ".htmlentities($myFunc->getName(), ENT_QUOTES, 'UTF-8')."\n";
                        break;

                    case Opcodes::CLASSE:
                        echo Opcodes::CLASSE."\n";

                        $myClass = $instruction->getProperty(MyInstruction::MYCLASS);
                        echo "name = ".htmlentities($myClass->getName(), ENT_QUOTES, 'UTF-8')."\n";
                        break;

                    case Opcodes::ENTER_BLOCK:
                        echo Opcodes::ENTER_BLOCK."\n";

                        $myBlock = $instruction->getProperty(MyInstruction::MYBLOCK);
                        echo "id = ".$myBlock->getId()."\n";

                        break;

                    case Opcodes::LEAVE_BLOCK:
                        echo Opcodes::LEAVE_BLOCK."\n";

                        $myBlock = $instruction->getProperty(MyInstruction::MYBLOCK);
                        echo "id = ".$myBlock->getId()."\n";

                        break;

                    case Opcodes::LEAVE_FUNCTION:
                        echo Opcodes::LEAVE_FUNCTION."\n";

                        break;
                    

                    case Opcodes::FUNC_CALL:
                        echo Opcodes::FUNC_CALL."\n";

                        $funcname = htmlentities(
                            $instruction->getProperty(MyInstruction::FUNCNAME),
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        echo "name = $funcname\n";
                        break;

                    case Opcodes::START_EXPRESSION:
                        echo Opcodes::START_EXPRESSION."\n";
                        break;

                    case Opcodes::END_EXPRESSION:
                        echo Opcodes::END_EXPRESSION."\n";
                        $myExpr = $instruction->getProperty(MyInstruction::EXPR);
                        echo "expression et tainted = ".$myExpr->isTainted()."\n";
                        break;

                    case Opcodes::CONCAT_LIST:
                        echo Opcodes::CONCAT_LIST."\n";
                        break;

                    case Opcodes::CONCAT_LEFT:
                        echo Opcodes::CONCAT_LEFT."\n";
                        break;

                    case Opcodes::CONCAT_RIGHT:
                        echo Opcodes::CONCAT_RIGHT."\n";
                        break;

                    case Opcodes::RETURN_FUNCTION:
                        echo Opcodes::RETURN_FUNCTION."\n";
                        break;

                    case Opcodes::START_ASSIGN:
                        echo Opcodes::START_ASSIGN."\n";
                        break;

                    case Opcodes::END_ASSIGN:
                        echo Opcodes::END_ASSIGN."\n";
                        break;

                    case Opcodes::COND_BOOLEAN_NOT:
                        echo Opcodes::COND_BOOLEAN_NOT."\n";
                        break;

                    case Opcodes::COND_START_IF:
                        echo Opcodes::COND_START_IF."\n";
                        break;

                    case Opcodes::TEMPORARY:
                        echo Opcodes::TEMPORARY."\n";
                        $listOfMyTemp = [];
                        if ($instruction->isPropertyExist(MyInstruction::PHI)) {
                            for ($i = 0; $i < $instruction->getProperty(MyInstruction::PHI); $i++) {
                                $listOfMyTemp[] = $instruction->getProperty("temp_".$i);
                            }
                        } else {
                            $listOfMyTemp[] = $instruction->getProperty(MyInstruction::TEMPORARY);
                        }
                            
                        foreach ($listOfMyTemp as $def) {
                            $def->printStdout();
                        }

                        break;

                    case Opcodes::DEFINITION:
                        echo Opcodes::DEFINITION."\n";
                        $def = $instruction->getProperty(MyInstruction::DEF);
                        $def->printStdout();

                        break;
                }

                $index = $index + 1;
            }
        } while (isset($this->code[$index]));
    }
}
