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
use progpilot\Utils;

class Functions
{
    private $functions;

    public function __construct()
    {
        $this->functions = [];
    }

    public function getAllFunctions($funcname, $className = "function")
    {
        $functionsTmp = [];

        foreach ($this->functions as $id => $functionsFile) {
            if (isset($functionsFile[$className][$funcname])) {
                $functionsTmp[] = $functionsFile[$className][$funcname];
            }
        }

        return $functionsTmp;
    }


    public function getFunction($funcname, $className = null, $specificFile = null)
    {
        if (is_null($className)) {
            $className = "function";
        }

        if (!is_null($specificFile)) {
            if (isset($this->functions[$specificFile][$className][$funcname])) {
                return $this->functions[$specificFile][$className][$funcname];
            }
        } else {
            foreach ($this->functions as $id => $functionsFile) {
                if (isset($functionsFile[$className][$funcname])) {
                    return $functionsFile[$className][$funcname];
                }
            }
        }
        
        return null;
    }

    public function getFunctions()
    {
        return $this->functions;
    }

    public function addFunction($filenamehash, $classname, $funcname, $myFunc)
    {
        $this->functions[$filenamehash][$classname][$funcname] = $myFunc;
    }

    public function delFunction($filenamehash, $classname, $funcname)
    {
        $save = null;

        if (isset($this->functions[$filenamehash][$classname][$funcname])) {
            $save = $this->functions[$filenamehash][$classname][$funcname];
            $this->functions[$filenamehash][$classname][$funcname] = null;
        }

        return $save;
    }
}
