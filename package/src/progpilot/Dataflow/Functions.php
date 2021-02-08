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

    public function getFunction($funcname, $className = null, $specificFile = null)
    {
        if(is_null($className)) {
            $className = "function";
        }

        if (!is_null($specificFile)) {
            echo "specific file 1\n";
            if(isset($this->functions[$specificFile][$className][$funcname])) {
                echo "specific file 2\n";
                return $this->functions[$specificFile][$className][$funcname];
            }
        }
        else {
            foreach ($this->functions as $id => $functionsFile) {
                if (isset($functionsFile[$className][$funcname])) {
                    echo "getfunction = '$className' '$funcname' '$id'\n";
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

        echo "no functions found\n";
        
        return null;
    }

    public function getFunctions()
    {
        return $this->functions;
    }

    public function addFunction($filenamehash, $classname, $funcname, $func)
    {
        // we can have many functions/methods with the same name
        
        if(!isset($this->functions[$filenamehash][$classname][$funcname])) {
            $this->functions[$filenamehash][$classname][$funcname] = $func;
        }

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

        if(isset($this->functions[$filenamehash][$classname][$funcname])) {
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
