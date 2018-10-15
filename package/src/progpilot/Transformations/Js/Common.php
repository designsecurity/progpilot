<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Js;

use PHPCfg\Block;
use PHPCfg\Op;
use PHPCfg\Operand;

use progpilot\Objects\MyOp;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Js\Transform;

class Common
{
    public static function getNameProperty($op)
    {
        $propertyNameArray = [];
        
        if (isset($op->property->type)) {
            if ($op->property->type === "MemberExpression") {
                $propertyNameArray = Common::getNameProperty($op->property);
            }
        }

        if (isset($op->property->name)) {
            $propertyNameArray[] = $op->property->name;
        }

        return $propertyNameArray;
    }
    
    public static function getNameDefinition($op)
    {
        $mytype = $op->type;

        switch ($mytype) {
            case 'Identifier':
                return $op->name;
                break;

            case 'Literal':
                return "temporary_".rand();
                break;

            case 'MemberExpression':
            /*
                    var myobject = mydata.object;
                this.isobject = true;
                this.objecttype = myobject.type;
                this.var_name = myobject.name;

                var myproperty = mydata.property;
                this.propertytype = myproperty.type;
                this.var_name = myproperty.name;
                */
                return $op->object->name;
                break;
        }
    }
    
    public static function getTypeDefinition($op)
    {
        return $op->type;
    }
}
