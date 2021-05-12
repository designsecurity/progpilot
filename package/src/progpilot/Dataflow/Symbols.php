<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

class Symbols
{
    public function __construct()
    {
        $this->values = [];
        $this->myFiles = [];
        $this->rawDefs = [];
    }
/*
    public function addRawDef($def)
    {
        $this->rawDefs[$def->getId()] = $def;
    }

    public function getRawDefs()
    {
        return $this->rawDefs;
    }

    public function getRawDef($id)
    {
        if (isset($this->rawDefs[$id])) {
            return $this->rawDefs[$id];
        }

        return null;
    }

    public function getFreeDefId()
    {

        $id = rand();
        while (isset($this->rawDefs[$id])) {
            $id = rand();
        }

        return $id;
    }
*/
    public function addValue($value)
    {
        $key = array_search($value, $this->values);

        if ($key !== false) {
            $key = count($this->values);
            $this->values[$key] = $value;
        }

        return $key;
    }
/*
    public function addMyFile($myFile)
    {
        $exist = false;
        foreach($this->myFiles as $file) {
            if($file->getName() === $myFile->getName()) {
                $exist = true;
                break;
            }
        }

        if (!$exist) {
            $key = count($this->myFiles);
            $this->myFiles[$key] = $myFile;
        }

        return $key;
    }

    public function getMyFile($id)
    {
        if(isset($this->myFiles[$id])) {
            return $this->myFiles[$id];
        }

        return null;
    }
*/
    public function getValue($id)
    {
        if (isset($this->values[$id])) {
            return $this->values[$id];
        }
        
        return null;
    }
}
