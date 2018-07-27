<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Code;

use progpilot\Objects\MyOp;
use progpilot\objects\MyBlock;
use progpilot\objects\MyDefinition;
use progpilot\objects\MyExpr;
use progpilot\objects\MyFunction;

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

    public static function readCode($context, $file, $defs, $myJavascriptFile)
    {
        $firstBlock = true;
        $handle = fopen($file, "r");

        $myFunction = new MyFunction("{main}");
        $myFunction->setStart_address_func(0);
        $context->getFunctions()->addFunction($myFunction->getName(), $myFunction);

        $instFunc = new MyInstruction(Opcodes::ENTER_FUNCTION);
        $instFunc->addProperty(MyInstruction::MYFUNC, $myFunction);
        $context->getMyCode()->addCode($instFunc);

        if ($handle) {
            $arrayMyBlocks = [];
            $arrayMyBlocksChilds = [];

            $arrayExprs = [];
            $arrayDefinitions = [];

            while (!feof($handle)) {
                $buffer = rtrim(fgets($handle));

                switch ($buffer) {
                    case 'EnterBlock':
                        $myBlockString = fgets($handle);
                        $myBlockId = (int) fgets($handle);
                        $myBlockStartAddressBlock = (int) fgets($handle);
                        $myBlockEndAddressBlock = (int) fgets($handle);
                        $edges = fgets($handle);
                        $nbEdges = (int) fgets($handle);

                        $myBlock = new MyBlock;
                        $myBlock->setId($myBlockId);
                        $myBlock->setStartAddressBlock(count($context->getMyCode()->getCodes()));

                        $arrayMyBlocks[$myBlockId] = $myBlock;
                        $arrayMyBlocksChilds[$myBlockId] = [];

                        for ($i = 0; $i < $nbEdges; $i ++) {
                            $idChild = (int) fgets($handle);
                            $arrayMyBlocksChilds[$myBlockId][] = $idChild;
                        }

                        $instBlock = new MyInstruction(Opcodes::ENTER_BLOCK);
                        $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
                        $context->getMyCode()->addCode($instBlock);

                        if ($firstBlock) {
                            $firstBlock = false;

                            foreach ($defs as $myDef) {
                                $instDef = new MyInstruction(Opcodes::DEFINITION);
                                $instDef->addProperty(MyInstruction::DEF, $myDef);
                                $context->getMyCode()->addCode($instDef);
                            }
                        }

                        break;

                    case 'LeaveBlock':
                        $myBlockString = fgets($handle);
                        $myBlockId = (int) fgets($handle);

                        if (isset($arrayMyBlocks[$myBlockId])) {
                            $myBlock = $arrayMyBlocks[$myBlockId];
                            $myBlock->setEndAddressBlock(count($context->getMyCode()->getCodes()));

                            $instBlock = new MyInstruction(Opcodes::LEAVE_BLOCK);
                            $instBlock->addProperty(MyInstruction::MYBLOCK, $myBlock);
                            $context->getMyCode()->addCode($instBlock);
                        }

                        break;

                    case 'Definition':
                        $code = $context->getMyCode()->getCodes();
                        $lastOpCode = $code[count($code) - 1];

                        $defString = fgets($handle);
                        $defName = rtrim(fgets($handle));
                        $defLine = (int) fgets($handle);
                        $defColumn = (int) fgets($handle);

                        $myDef = new MyDefinition($defLine, $defColumn, $defName);
                        $myDef->setSourceMyFile($myJavascriptFile);
                        $arrayDefinitions[] = $myDef;

                        $instDef = new MyInstruction(Opcodes::DEFINITION);
                        $instDef->addProperty(MyInstruction::DEF, $myDef);
                        $context->getMyCode()->addCode($instDef);

                        break;

                    case 'funccall':
                        $funcString = fgets($handle);
                        $funcLine = (int) fgets($handle);
                        $funcColumn = (int) fgets($handle);
                        $funcName = rtrim(fgets($handle));
                        $funcIsInstance = rtrim(fgets($handle));
                        $funcNameInstance = rtrim(fgets($handle));
                        $funcNbParams = (int) fgets($handle);

                        $instFuncCallMain = new MyInstruction(Opcodes::FUNC_CALL);
                        $instFuncCallMain->addProperty(MyInstruction::FUNCNAME, $funcName);

                        $myFunctionCall = new MyFunction($funcName);
                        $myFunctionCall->setLine($funcLine);
                        $myFunctionCall->setColumn($funcColumn);
                        $myFunctionCall->setNbParams($funcNbParams);
                        $myFunctionCall->setSourceMyFile($myJavascriptFile);

                        if ($funcIsInstance === "true") {
                            $myFunctionCall->addType(MyOp::TYPE_INSTANCE);
                            $myFunctionCall->setNameInstance($funcNameInstance);

                            $mybackdef = new MyDefinition($funcLine, $funcColumn, $funcNameInstance);
                            $mybackdef->addType(MyDefinition::TYPE_INSTANCE);
                            $mybackdef->setSourceMyFile($myJavascriptFile);
                            $myFunctionCall->setBackDef($mybackdef);
                        }

                        for ($j = 0; $j < $funcNbParams; $j ++) {
                            $funcDefIdParam = (int) fgets($handle);
                            $funcDefParam = $arrayDefinitions[$funcDefIdParam];
                            $instFuncCallMain->addProperty("argdef$j", $funcDefParam);
                        }

                        $funcExprString = fgets($handle);
                        $funcExprId = (int) fgets($handle);

                        // !!!!????
                        //$myExpr = $arrayExprs[$funcExprId];
                        $myExpr = null;

                        $instFuncCallMain->addProperty(MyInstruction::MYFUNC_CALL, $myFunctionCall);
                        $instFuncCallMain->addProperty(MyInstruction::EXPR, $myExpr);
                        $instFuncCallMain->addProperty(MyInstruction::ARR, null);
                        $context->getMyCode()->addCode($instFuncCallMain);

                        break;

                    case 'temporary':
                        $defString = fgets($handle);
                        $defName = rtrim(fgets($handle));
                        $defLine = (int) fgets($handle);
                        $defColumn = (int) fgets($handle);

                        $myTemp = new MyDefinition($defLine, $defColumn, $defName);
                        $myTemp->setSourceMyFile($myJavascriptFile);
                        $arrayDefinitions[] = $myTemp;

                        $nbExprs = (int) fgets($handle);
                        for ($i = 0; $i < $nbExprs; $i ++) {
                            $idExpr = (int) fgets($handle);
                            $myTemp->add_expr($idExpr);
                        }

                        $instTemporarySimple = new MyInstruction(Opcodes::TEMPORARY);
                        $instTemporarySimple->addProperty(MyInstruction::TEMPORARY, $myTemp);
                        $context->getMyCode()->addCode($instTemporarySimple);

                        break;

                    case 'start_assign':
                        $context->getMyCode()->addCode(new MyInstruction(Opcodes::START_ASSIGN));

                        break;

                    case 'end_assign':
                        $context->getMyCode()->addCode(new MyInstruction(Opcodes::END_ASSIGN));

                        break;

                    case 'start_expression':
                        $context->getMyCode()->addCode(new MyInstruction(Opcodes::START_EXPRESSION));

                        break;

                    case 'end_expression':
                        $exprString = fgets($handle);
                        $exprLine = (int) fgets($handle);
                        $exprColumn = (int) fgets($handle);

                        $myExpr = new MyExpr($exprLine, $exprColumn);

                        $exprIsAssign = rtrim(fgets($handle));

                        if ($exprIsAssign === "true") {
                            $exprDefAssignId = (int) fgets($handle);
                            $myExpr->setAssign(true);
                            $myExpr->setAssignDef($exprDefAssignId);
                        }

                        $nbExprs = (int) fgets($handle);

                        $arrayExprs[] = $myExpr;

                        for ($i = 0; $i < $nbExprs; $i ++) {
                            $defId = (int) fgets($handle);
                            $myExpr->addDef($defId);
                        }

                        $instEndExpr = new MyInstruction(Opcodes::END_EXPRESSION);
                        $instEndExpr->addProperty(MyInstruction::EXPR, $myExpr);
                        $context->getMyCode()->addCode($instEndExpr);

                        break;
                }
            }

            foreach ($arrayMyBlocks as $parent) {
                $parent->addParent($parent);
                $childs = $arrayMyBlocksChilds[$parent->getId()];

                foreach ($childs as $child) {
                    $myBlockChild = $arrayMyBlocks[$child];
                    $myBlockChild->addParent($parent);
                }
            }

            foreach ($arrayExprs as $myExpr) {
                $defs = $myExpr->getDefs();
                $myExpr->setDefs(array());

                if ($myExpr->isAssign()) {
                    $defId = $myExpr->getAssignDef();
                    $myDef = $arrayDefinitions[$defId];
                    $myExpr->setAssignDef($myDef);
                }

                foreach ($defs as $defId) {
                    $myDef = $arrayDefinitions[$defId];
                    $myExpr->addDef($myDef);
                }
            }

            foreach ($arrayDefinitions as $myDef) {
                $exprs = $myDef->getExprs();
                $myDef->setExprs(array());

                foreach ($exprs as $exprId) {
                    $myExpr = $arrayExprs[$exprId];
                    $myDef->add_expr($myExpr);
                }
            }

            fclose($handle);


            $myFunction->setEnd_address_func(count($context->getMyCode()->getCodes()));

            $instFunc = new MyInstruction(Opcodes::LEAVE_FUNCTION);
            $instFunc->addProperty(MyInstruction::MYFUNC, $myFunction);
            $context->getMyCode()->addCode($instFunc);

            $context->getMyCode()->setStart(0);
            $context->getMyCode()->setEnd(count($context->getMyCode()->getCodes()));
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
                        if($instruction->isPropertyExist(MyInstruction::PHI))
                        {
                            for($i = 0; $i < $instruction->getProperty(MyInstruction::PHI); $i++)
                                $listOfMyTemp[] = $instruction->getProperty("temp_".$i);
                        }
                        else
                            $listOfMyTemp[] = $instruction->getProperty(MyInstruction::TEMPORARY);
                            
                        foreach($listOfMyTemp as $def)
                            $def->printStdout();

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
