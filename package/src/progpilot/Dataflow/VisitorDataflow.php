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

use progpilot\Helpers\Analysis as HelpersAnalysis;

class VisitorDataflow
{
    private $blocksArrays;

    protected function isArrayAlreadyDefined($nameArray, $blockId)
    {
        if (isset($this->blocksArrays["".$blockId.""]["".$nameArray.""])) {
            return true;
        }

        return false;
    }

    protected function defineArray($nameArray, $blockId)
    {
        $this->blocksArrays["".$blockId.""]["".$nameArray.""] = true;
    }

    public function analyze($context, $myFunc, $defsIncluded = null)
    {
        $myCode = $myFunc->getMyCode();
        $code = $myCode->getCodes();

        $index = 0;
        $myFunc->getMyCode()->setEnd(count($code));

        $blocks = null;
        $blocksStack = null;
        $lastBlockId = 0;
        $firstBlock = true;
        $firstBlockId = 0;
        $alreadyWarned = false;
        $alreadyWarned = false;
        $defs = null;

        do {
            if (isset($code[$index])) {
                $instruction = $code[$index];
                switch ($instruction->getOpcode()) {
                    case Opcodes::START_EXPRESSION:
                        // representations start
                        $idCfg = hash(
                            "sha256",
                            $context->getCurrentFunc()->getName()."-".$context->getCurrentBlock()->getId()
                        );
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::START_EXPRESSION."\n"
                        );
                        // representations end
                        break;

                    case Opcodes::END_EXPRESSION:
                        // representations start
                        $idCfg = hash(
                            "sha256",
                            $context->getCurrentFunc()->getName()."-".$context->getCurrentBlock()->getId()
                        );
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::END_EXPRESSION."\n"
                        );
                        // representations end

                        $myExpr = $instruction->getProperty(MyInstruction::EXPR);
                        $context->getCurrentFunc()->addExpr($myExpr);
                        
                        break;
                            
                    case Opcodes::ENTER_FUNCTION:
                        $alreadyWarned = false;

                        $myFunc = $instruction->getProperty(MyInstruction::MYFUNC);
                        $myFunc->setSourceMyFile($context->getCurrentMyfile());

                        $blocks = [];
                        $blocksStack = [];
                        $defs = new Definitions();
                        //$defs->createBlock(0); // transform.php: properties have block id 0

                        $myFunc->setDefs($defs);

                        $context->setCurrentFunc($myFunc);

                        // representations start
                        $hashedValue = $context->getCurrentFunc()->getName()."-".$context->getCurrentBlock()->getId();
                        $idCfg = hash("sha256", $hashedValue);
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::ENTER_FUNCTION." ".htmlentities($myFunc->getName(), ENT_QUOTES, 'UTF-8')."\n"
                        );
                        // representations end

                        break;

                    case Opcodes::ENTER_BLOCK:
                        $myBlock = $instruction->getProperty(MyInstruction::MYBLOCK);
                        $myBlock->setSourceMyFile($context->getCurrentMyfile());

                        $context->setCurrentBlock($myBlock);
                        array_push($blocksStack, $myBlock);
                        array_push($blocks, $myBlock);

                        $context->getCurrentFunc()->getDefs()->createBlock($myBlock->getId());

                        $assertions = $myBlock->getAssertions();
                        foreach ($assertions as $assertion) {
                            $myDef = $assertion->getDef();
                            $myDef->setBlockId($myBlock->getId());
                        }

                        // representations start
                        $idCfg = hash("sha256", $context->getCurrentFunc()->getName()."-".$myBlock->getId());
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::ENTER_BLOCK."\n"
                        );
                        $context->outputs->cfgAddNode($context->getCurrentFunc(), $idCfg, $myBlock);

                        foreach ($myBlock->parents as $parent) {
                            $context->outputs->cfgAddEdge($context->getCurrentFunc(), $parent, $myBlock);
                        }
                        // representations end

                        if ($firstBlock) {
                            $context->getCurrentFunc()->setFirstBlockId($myBlock->getId());
                            $firstBlock = false;

                            // param are part of the first block of the function
                            foreach ($context->getCurrentFunc()->getParams() as $param) {
                                $param->setBlockId($myBlock->getId());
                                $param->unsetState(0);
                                $param->addState($myBlock->getId());
                            }
                            // end


                            if ($context->getCurrentFunc()->isType(MyFunction::TYPE_FUNC_METHOD)) {
                                $thisdef = $context->getCurrentFunc()->getThisDef();

                                //$thisdef->setObjectId($this->currentClass->getObjectIdThis());
                                $thisdef->setBlockId($myBlock->getId());
                                $thisdef->unsetState(0);
                                $thisdef->addState($myBlock->getId());
                                $thisdef->getCurrentState()->addType(MyDefinition::TYPE_INSTANCE);

                                $context->getCurrentFunc()->getDefs()->addDef($thisdef->getName(), $thisdef);
                                $context->getCurrentFunc()->getDefs()->addGen($thisdef->getBlockId(), $thisdef);
                                /*
                                $context->getObjects()->addMyclassToObject(
                                    $this->currentClass->getObjectIdThis(),
                                    $this->currentClass
                                );
                                */
                            }
                        }

                        // just to keep array def uptodate
                        $blocksArrays["".$myBlock->getId().""] = [];

                        break;

                    case Opcodes::LEAVE_BLOCK:
                        $myBlock = $instruction->getProperty(MyInstruction::MYBLOCK);

                        array_pop($blocksStack);
                        if (!empty($blocksStack)) {
                            $context->setCurrentBlock($blocksStack[count($blocksStack) - 1]);
                        }

                        $context->getCurrentFunc()->getDefs()->computeKill($myBlock->getId());
                        $lastBlockId = $myBlock->getId();

                        echo "VISITORDATAFLOW LEAVE_BLOCK= '$lastBlockId'\n";

                        // representations start
                        $idCfg = hash("sha256", $context->getCurrentFunc()->getName()."-".$myBlock->getId());
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::LEAVE_BLOCK."\n"
                        );
                        // representations end

                        break;


                    case Opcodes::LEAVE_FUNCTION:
                        $myFunc = $instruction->getProperty(MyInstruction::MYFUNC);

                        $context->getCurrentFunc()->getDefs()->reachingDefs($blocks);

                        $myFunc->setBlocks($blocks);
                        $myFunc->setLastBlockId($lastBlockId);
                        echo "VISITORDATAFLOW LEAVE_FUNCTION 1\n";
                        echo "myfuncid = '".$myFunc->getId()."'\n";
                        echo "myfunc getLastBlockId = '".$myFunc->getLastBlockId()."'\n";

                        // functions are generally parsed before the main and so declarations of instances
                        if ($myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                            echo "VISITORDATAFLOW LEAVE_FUNCTION 2\n";
                            foreach ($context->getObjects()->getObjects() as $idobject => $myClass) {
                                echo "VISITORDATAFLOW LEAVE_FUNCTION 3 idobject = '$idobject'\n";
                                foreach ($myClass->getMethods() as $myMethod) {
                                    echo "VISITORDATAFLOW LEAVE_FUNCTION 4\n";
                                    if ($myMethod->getName() === $myFunc->getName()) {
                                        echo "VISITORDATAFLOW LEAVE_FUNCTION 5\n";
                                        $myMethod->setLastBlockId($lastBlockId);
                                    }
                                }
                            }
                        }

                        // representations start
                        $idCfg = hash("sha256", $context->getCurrentFunc()->getName()."-".$lastBlockId);
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::LEAVE_FUNCTION."\n"
                        );
                        // representations end

                        break;

                    case Opcodes::FUNC_CALL:
                        $myFuncCall = $instruction->getProperty(MyInstruction::MYFUNC_CALL);
                        $myFuncCall->setBlockId($context->getCurrentBlock()->getId());

                        if (is_null($myFuncCall->getSourceMyFile())) {
                            $myFuncCall->setSourceMyFile($context->getCurrentMyfile());
                        }

                        $mySource = $context->inputs->getSourceByName($context, null, $myFuncCall, true, false, false);
                        if (!is_null($mySource)) {
                            if ($mySource->hasParameters()) {
                                $nbparams = 0;
                                while (true) {
                                    if (!$instruction->isPropertyExist("argdef$nbparams")) {
                                        break;
                                    }

                                    $defarg = $instruction->getProperty("argdef$nbparams");

                                    echo "visitdataflow defarg___\n";

                                    if ($mySource->isParameter($nbparams + 1)) {

                                        $deffrom = $instruction->getProperty("argoriginaldef$nbparams");
                                        if (!is_null($deffrom)) {
                                            $context->getCurrentFunc()->getDefs()->addDef(
                                                $deffrom->getName(),
                                                $deffrom
                                            );
                                            $context->getCurrentFunc()->getDefs()->addGen(
                                                $deffrom->getBlockId(),
                                                $deffrom
                                            );
                                        }
                                    }

                                    $nbparams ++;
                                }
                            }
                        }

                        // representations start
                        $idCfg = hash(
                            "sha256",
                            $context->getCurrentFunc()->getName()."-".$context->getCurrentBlock()->getId()
                        );
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::FUNC_CALL." ".htmlentities($myFuncCall->getName(), ENT_QUOTES, 'UTF-8')."\n"
                        );
                        // representations end

                        break;

                    case Opcodes::TEMPORARY:
                        // representations start
                        $idCfg = hash(
                            "sha256",
                            $context->getCurrentFunc()->getName()."-".$context->getCurrentBlock()->getId()
                        );
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::TEMPORARY."\n"
                        );
                        // representations end
                        
                        break;

                    case Opcodes::DEFINITION:
                        $myDef = $instruction->getProperty(MyInstruction::DEF);

                        if ($context->getCurrentFunc()->getDefs()->getNbDefs() < $context->getMaxDefinitions()) {
                            if ($myDef->isType(MyDefinition::TYPE_ARRAY)) {
                                // only one array by name is defined in a function (or blocks see arrays12.php)

                                echo "VisitorDataFlow__ DEFINITION array 1\n";

                                if (!$this->isArrayAlreadyDefined(
                                    $myDef->getName(),
                                    $myDef->getBlockId()
                                )) {
                                    echo "VisitorDataFlow__ DEFINITION array 2\n";
                                    $context->getCurrentFunc()->getDefs()->addDef($myDef->getName(), $myDef);
                                    $context->getCurrentFunc()->getDefs()->addGen($myDef->getBlockId(), $myDef);
                                    $this->defineArray($myDef->getName(), $myDef->getBlockId());
                                }
                            } elseif (!$myDef->isType(MyDefinition::TYPE_PROPERTY)
                                && !$myDef->isType(MyDefinition::TYPE_STATIC_PROPERTY)) {
                                $context->getCurrentFunc()->getDefs()->addDef($myDef->getName(), $myDef);
                                $context->getCurrentFunc()->getDefs()->addGen($myDef->getBlockId(), $myDef);
                            }
                        } else {
                            if (!$alreadyWarned) {
                                Utils::printWarning($context, Lang::MAX_DEFS_EXCEEDED);
                                $alreadyWarned = true;
                            }
                        }

                        // representations start
                        $idCfg = hash(
                            "sha256",
                            $context->getCurrentFunc()->getName()."-".$context->getCurrentBlock()->getId()
                        );
                        $context->outputs->cfgAddTextOfMyBlock(
                            $context->getCurrentFunc(),
                            $idCfg,
                            Opcodes::DEFINITION."\n"
                        );
                        // representations end

                        break;
                }

                $index = $index + 1;
            }
        } while (isset($code[$index]) && $index <= $myCode->getEnd());
    }
}
