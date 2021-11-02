<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyClass extends MyOp
{
    private $methods;
    private $properties;
    //private $objectIdThis;
    private $extendsof;

    public function __construct($varLine, $varColumn, $varName)
    {
        parent::__construct($varName, $varLine, $varColumn);

        $this->properties = [];
        $this->methods = [];
        //$this->objectIdThis = null;
        $this->extendsof = null;
    }

    public function __clone()
    {
        for ($i = 0; $i < count($this->properties); $i++) {
            $this->properties[$i] = clone $this->properties[$i];
        }

        for ($i = 0; $i < count($this->methods); $i++) {
            $this->methods[$i] = clone $this->methods[$i];
        }
    }

    public function addMethod($method)
    {
        $exist = false;
        foreach ($this->methods as $methodClass) {
            if ($methodClass->getName() === $method->getName()) {
                $exist = true;
                break;
            }
        }

        if (!$exist) {
            $this->methods[] = $method;
        }
    }

    public function getMethod($name)
    {
        foreach ($this->methods as $method) {
            if ($method->getName() === $name) {
                return $method;
            }
        }

        return null;
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function addProperty($property)
    {
        $exist = false;
        foreach ($this->properties as $defClass) {
            if ($defClass->getName() === $property->getName()) {
                $exist = true;
                break;
            }
        }

        if (!$exist) {
            $this->properties[] = $property;
        }
    }

    public function getProperty($context, $tempdef, $instance, $name)
    {
        foreach ($this->properties as $def) {
            // we don't check if it's STATIC property or NOT
            if ($def->getName() === $name) {
                return $def;
            }
        }

        // we didn't find any propery but in this case php create automatically the property
        // same code than in selectproperties resolvedef
        $myProperty = new MyProperty(
            $tempdef->getBlockId(),
            $context->getCurrentMyFile(),
            $tempdef->getLine(),
            $tempdef->getColumn(),
            $name
        );
        $myProperty->setVisibility("public");
        $this->addProperty($myProperty);

        if ($instance->getCurrentState()->isType(MyDefinition::ALL_PROPERTIES_TAINTED)) {
            $myProperty->getCurrentState()->setTainted(true);
            $myProperty->getCurrentState()->addTaintedByDef([$instance, $instance->getCurrentState()]);
        }

        return $myProperty;
    }
    /*
        public function setObjectIdThis($objectId)
        {
            $this->objectIdThis = $objectId;
        }

        public function getObjectIdThis()
        {
            return $this->objectIdThis;
        }
    */
    public function getExtendsOf()
    {
        return $this->extendsof;
    }

    public function setExtendsOf($extendsof)
    {
        $this->extendsof = $extendsof;
    }
}
