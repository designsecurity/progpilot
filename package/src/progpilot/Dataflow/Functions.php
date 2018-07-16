<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyOp;

class Functions
{
    private $functions;

    public function getFunction($funcname, $className = null)
    {
        if (isset($this->functions[$funcname])) {
            $list_funcs = $this->functions[$funcname];
            foreach ($list_funcs as $myFunc) {
                if (!$myFunc->isType(MyFunction::TYPE_FUNC_METHOD) && is_null($className)) {
                    return $myFunc;
                }

                if ($myFunc->isType(MyFunction::TYPE_FUNC_METHOD)) {
                    $myClass = $myFunc->getMyClass();
                    if ($className === $myClass->getName()) {
                        return $myFunc;
                    }
                }
            }
        }

        return null;
    }

    public function getFunctionsByName($name)
    {
        if (isset($this->functions[$name])) {
            return $this->functions[$name];
        }

        return null;
    }

    public function getFunctions()
    {
        return $this->functions;
    }

    public function addFunction($funcname, $func)
    {
        // we can have many functions/methods with the same name
        $continue = true;
        if (isset($this->functions[$funcname])) {
            $continue = false;
            if (!in_array($func, $this->functions[$funcname], true)) {
                $continue = true;
            }
        }

        if ($continue) {
            $this->functions[$funcname][] = $func;
        }
    }

    public function delFunction($funcname)
    {
        $save = $this->functions[$funcname];
        $this->functions[$funcname] = [];
        //unset($this->functions[$funcname]);
        return $save;
    }
}
