<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyCustomRule
{
    const TYPE_FUNCTION = "function";
    const TYPE_SEQUENCE = "sequence";

    private $action;
    private $type;
    private $functionDefinition;
    private $nameRule;
    private $attack;
    private $cwe;
    private $descriptionRule;
    private $sequenceRule;
    private $currentOrderNumber;

    public function __construct($nameRule, $descriptionRule)
    {
        $this->action = null;
        $this->type = MyCustomRule::TYPE_FUNCTION;
        $this->nameRule = $nameRule;
        $this->descriptionRule = $descriptionRule;
        $this->sequenceRule = [];
        $this->currentOrderNumber = 0;
        $this->functionDefinition = null;
        $this->attack = null;
        $this->cwe = null;
    }

    public function getAttack()
    {
        return $this->attack;
    }

    public function setAttack($attack)
    {
        $this->attack = $attack;
    }

    public function getCwe()
    {
        return $this->cwe;
    }

    public function setCwe($cwe)
    {
        $this->cwe = $cwe;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getFunctionDefinition()
    {
        return $this->functionDefinition;
    }

    public function setFunctionDefinition($functionDefinition)
    {
        $this->functionDefinition = $functionDefinition;
    }

    public function getName()
    {
        return $this->nameRule;
    }

    public function setName($nameRule)
    {
        $this->nameRule = $nameRule;
    }

    public function getDescription()
    {
        return $this->descriptionRule;
    }

    public function setDescription($descriptionRule)
    {
        $this->descriptionRule = $descriptionRule;
    }

    public function getCurrentOrderNumber()
    {
        return $this->currentOrderNumber;
    }

    public function setCurrentOrderNumber($currentOrderNumber)
    {
        $this->currentOrderNumber = $currentOrderNumber;
    }

    public function getSequence()
    {
        return $this->sequenceRule;
    }

    public function addToSequenceWithAction($functionName, $language, $action)
    {
        $this->currentOrderNumber ++;
        $myCustomFunction = new MyCustomFunction($functionName, $language, $this->currentOrderNumber);
        $myCustomFunction->setAction($action);
        $this->sequenceRule[] = $myCustomFunction;

        return $myCustomFunction;
    }

    public function addToSequence($functionName, $language)
    {
        $this->currentOrderNumber ++;
        $myCustomFunction = new MyCustomFunction($functionName, $language, $this->currentOrderNumber);
        $this->sequenceRule[] = $myCustomFunction;

        return $myCustomFunction;
    }

    public function addFunctionDefinition($functionName, $language)
    {
        $myCustomFunction = new MyCustomFunction($functionName, $language);
        $this->functionDefinition = $myCustomFunction;

        return $myCustomFunction;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        return $this->action = $action;
    }
}
