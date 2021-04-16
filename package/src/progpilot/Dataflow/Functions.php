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
        /*
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
        }*/
        
        return null;
    }

    public function getFunctions()
    {
        return $this->functions;
    }

    public function updateFunction($filenamehash, $classname, $funcname, $myFunc)
    {
        $this->addFunction($filenamehash, $classname, $funcname, $myFunc);
    }

    public function addFunction($filenamehash, $classname, $funcname, $myFunc)
    {
        // we can have many functions/methods with the same name
        
        //if (!isset($this->functions[$filenamehash][$classname][$funcname])) {
            //$this->functions[$filenamehash][$classname][$funcname] = $func;
            $signature = hash("sha256", "$filenamehash"."$classname"."$funcname");
            echo "before serializing\n";
            var_dump($myFunc);
            Utils::serializeFunc($myFunc, $signature);
            $this->functions[$filenamehash][$classname][$funcname] = $signature;
        //}

        /*
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
        */
    }

    public function delFunction($filenamehash, $classname, $funcname)
    {
        $save = null;

        if (isset($this->functions[$filenamehash][$classname][$funcname])) {
            $save = $this->functions[$filenamehash][$classname][$funcname];
            $this->functions[$filenamehash][$classname][$funcname] = null;
            //unset($this->functions[$filenamehash][$classname][$funcname]);
        }

        return $save;

        /*
        $save = $this->functions[$funcname];
        $this->functions[$funcname] = [];
        //unset($this->functions[$funcname]);
        return $save;
        */
    }
}
