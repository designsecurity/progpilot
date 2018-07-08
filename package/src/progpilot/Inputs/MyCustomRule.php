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
    private $function_definition;
    private $name_rule;
    private $attack;
    private $cwe;
    private $description_rule;
    private $sequence_rule;
    private $current_order_number;

    public function __construct($name_rule, $description_rule)
    {
        $this->action = null;
        $this->type = MyCustomRule::TYPE_FUNCTION;
        $this->name_rule = $name_rule;
        $this->description_rule = $description_rule;
        $this->sequence_rule = [];
        $this->current_order_number = 0;
        $this->function_definition = null;
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
        return $this->function_definition;
    }

    public function setFunctionDefinition($function_definition)
    {
        $this->function_definition = $function_definition;
    }

    public function getName()
    {
        return $this->name_rule;
    }

    public function setName($name_rule)
    {
        $this->name_rule = $name_rule;
    }

    public function getDescription()
    {
        return $this->description_rule;
    }

    public function setDescription($description_rule)
    {
        $this->description_rule = $description_rule;
    }

    public function getCurrentOrderNumber()
    {
        return $this->current_order_number;
    }

    public function setCurrentOrderNumber($current_order_number)
    {
        $this->current_order_number = $current_order_number;
    }

    public function getSequence()
    {
        return $this->sequence_rule;
    }

    public function addToSequenceWithAction($function_name, $language, $action)
    {
        $this->current_order_number ++;
        $mycustomfunction = new MyCustomFunction($function_name, $language, $this->current_order_number);
        $mycustomfunction->setAction($action);
        $this->sequence_rule[] = $mycustomfunction;

        return $mycustomfunction;
    }

    public function addToSequence($function_name, $language)
    {
        $this->current_order_number ++;
        $mycustomfunction = new MyCustomFunction($function_name, $language, $this->current_order_number);
        $this->sequence_rule[] = $mycustomfunction;

        return $mycustomfunction;
    }

    public function addFunctionDefinition($function_name, $language)
    {
        $mycustomfunction = new MyCustomFunction($function_name, $language);
        $this->function_definition = $mycustomfunction;

        return $mycustomfunction;
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
