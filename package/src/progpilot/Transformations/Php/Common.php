<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php;

use PHPCfg\Block;
use PHPCfg\Op;
use PHPCfg\Operand;

use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyOp;
use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;

class Common
{
    public static function validLastKnownValue($value)
    {
        if (strpos($value, '\n') === false && strpos($value, '\r') === false && strlen($value) < 200) {
            return true;
        }

        return false;
    }

    public static function getNameProperty($op)
    {

        // we ensure to have the last property test->foo->bar = bar
        if (isset($op->name->value) && ($op instanceof Op\Expr\PropertyFetch
            || $op instanceof Op\Expr\StaticPropertyFetch)) {
            return $op->name->value;
        }

        if (isset($op->ops[0]->name->value)) {
            if ($op->ops[0] instanceof Op\Expr\ArrayDimFetch
                || $op->ops[0] instanceof Op\Expr\PropertyFetch
                    || $op->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                return $op->ops[0]->name->value;
            }
        }

        // array t->test[0]
        if (isset($op->var->ops[0]->name->value)) {
            if ($op->var->ops[0] instanceof Op\Expr\ArrayDimFetch
                || $op->var->ops[0] instanceof Op\Expr\PropertyFetch
                    || $op->var->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                return $op->var->ops[0]->name->value;
            }
        }
        /*
        $propertyNameArray = [];

        if (isset($op->ops[0])) {
            if ($op->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                echo "here1___\n";
                $propertyNameArray = Common::getNameProperty($op->ops[0]);
            }

            if ($op instanceof Op\Expr\PropertyFetch) {
                echo "here2___\n";
                $propertyNameArray = Common::getNameProperty($op->ops[0]);
            }

            if ($op instanceof Op\Expr\StaticPropertyFetch) {
                echo "here3___\n";
                $propertyNameArray = Common::getNameProperty($op->ops[0]);
            }
        }

        if (isset($op->var->ops)) {
            foreach ($op->var->ops as $opeach) {
                if ($opeach instanceof Op\Expr\ArrayDimFetch) {
                    echo "here4___\n";
                    $propertyNameArray =  Common::getNameProperty($opeach);
                }

                if ($opeach instanceof Op\Expr\PropertyFetch) {
                    echo "here5___\n";
                    $propertyNameArray = Common::getNameProperty($opeach);
                }

                if ($opeach instanceof Op\Expr\StaticPropertyFetch) {
                    echo "here6___\n";
                    $propertyNameArray = Common::getNameProperty($opeach);
                }
            }
        }

        if (isset($op->name->value)) {
            echo "here7___'".$op->name->value."'\n";
            $propertyNameArray[] = $op->name->value;
        }

        return $propertyNameArray;
        */

        /*
                if (isset($op->var->ops)) {
                    foreach ($op->var->ops as $opeach) {
                        if ($opeach instanceof Op\Expr\ArrayDimFetch) {
                            echo "here1___\n";
                        }

                        if ($opeach instanceof Op\Expr\PropertyFetch) {
                            echo "here2___\n";
                            //var_dump($opeach);
                            return Common::getNameProperty($opeach);
                        }

                        if ($opeach instanceof Op\Expr\StaticPropertyFetch) {
                            echo "here3___\n";
                        }
                    }
                }

                if (isset($op->ops[0]->name->value)) {
                    if ($op->ops[0] instanceof Op\Expr\ArrayDimFetch
                        || $op->ops[0] instanceof Op\Expr\PropertyFetch
                            || $op->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                                echo "here4___\n";
                        return $op->ops[0]->name->value;
                    }
                }

                // array t->test[0]
                if (isset($op->var->ops[0]->name->value)) {
                    if ($op->var->ops[0] instanceof Op\Expr\ArrayDimFetch
                        || $op->var->ops[0] instanceof Op\Expr\PropertyFetch
                            || $op->var->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                        return $op->var->ops[0]->name->value;
                    }
                }

                if (isset($op->name->value) && ($op instanceof Op\Expr\PropertyFetch
                    || $op instanceof Op\Expr\StaticPropertyFetch)) {
                    return $op->name->value;
                }
        */
        return null;
    }

    public static function isInAssign($op)
    {
        if (isset($op->var->ops[0]) && $op->var->ops[0] instanceof Op\Expr\Assign) {
            return true;
        } else {
            return Common::isInAssign($op->var->ops[0]);
        }
    }

    public static function transformPropertyFetch($context, $op)
    {
        echo "transformPropertyFetch 1\n";
        if (isset($op)
            && ($op instanceof Op\Expr\PropertyFetch
                || $op instanceof Op\Expr\StaticPropertyFetch)) {
            if (isset($op->var->ops[0])) {
                Common::transformPropertyFetch($context, $op->var->ops[0]);
            }

            $instDefChained = new MyInstruction(Opcodes::PROPERTY_FETCH);
            $instDefChained->addProperty(MyInstruction::PROPERTY_NAME, $op->name->value);

            // beginning of the chain
            if (isset($op->var->original)) {
                $originalDef = new MyDefinition(
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                    $op->var->original->name->value
                );
                $originalDef->addType(MyDefinition::TYPE_PROPERTY);

                $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
            }

            // static property
            if (isset($op->class->value)) {
                $originalDef = new MyDefinition(
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                    $op->class->value
                );
                $originalDef->addType(MyDefinition::TYPE_STATIC_PROPERTY);
            
                $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
            }

            if (isset($op->var) && $op->var instanceof Operand\BoundVariable) {
                $originalDef = new MyDefinition(
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                    "this"
                );
                
                $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
            }

            if (isset($op->result)) {
                $instDefChained->addProperty(
                    MyInstruction::RESULTID,
                    $context->getCurrentFunc()->getOpId($op->result)
                );
            }
            if (isset($op->var)) {
                $instDefChained->addProperty(
                    MyInstruction::VARID,
                    $context->getCurrentFunc()->getOpId($op->var)
                );
            }

            $context->getCurrentMycode()->addCode($instDefChained);
        }

        else if (isset($op)
            && $op instanceof Op\Expr\ArrayDimFetch) {

            echo "transformPropertyFetch 2\n";
            if (isset($op->var->ops[0])) {
                echo "transformPropertyFetch3\n";
                Common::transformPropertyFetch($context, $op->var->ops[0]);
            }

            $instDefChained = new MyInstruction(Opcodes::ARRAYDIM_FETCH);
            $instDefChained->addProperty(MyInstruction::ARRAY_DIM, $op->dim->value);

            if (isset($op->result)) {
                $instDefChained->addProperty(
                    MyInstruction::RESULTID,
                    $context->getCurrentFunc()->getOpId($op->result)
                );
            }

            if (isset($op->var)) {
                $instDefChained->addProperty(
                    MyInstruction::VARID,
                    $context->getCurrentFunc()->getOpId($op->var)
                );
            }

            // beginning of the chain
            if (isset($op->var->original)) {
                $originalDef = new MyDefinition(
                    $context->getCurrentBlock()->getId(),
                    $context->getCurrentMyFile(),
                    $context->getCurrentLine(),
                    $context->getCurrentColumn(),
                    $op->var->original->name->value
                );

                $instDefChained->addProperty(MyInstruction::ORIGINAL_DEF, $originalDef);
            }

            $context->getCurrentMycode()->addCode($instDefChained);
        }

        else if(isset($op->ops[0])) {
            Common::transformPropertyFetch($context, $op->ops[0]);
        }
        else if (isset($op) && $op instanceof Operand\Literal) {
            $myTemp = new MyDefinition(
                $context->getCurrentBlock()->getId(),
                $context->getCurrentMyFile(),
                $context->getCurrentLine(), 
                $context->getCurrentColumn(), 
                $op->value);

            $instTemporary = new MyInstruction(Opcodes::TEMPORARY);
            $instTemporary->addProperty(MyInstruction::TEMPORARY, $myTemp);
            /*
            $instTemporary->addProperty(
                MyInstruction::RESULTID,
                $context->getCurrentFunc()->getOpId($op->result)
            );*/
            $context->getCurrentMycode()->addCode($instTemporary);
        }
        /*
        if (isset($ops->var->original->name)) {
            if ($ops->var->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_VARIABLE;
            }
        }

        if (isset($ops->expr->original->name)) {   // return
            if ($ops->expr->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_LITERAL;
            }
        }

        if (isset($ops->original->name)) {
            if ($ops->original instanceof Operand\Variable) {
                return MyOp::TYPE_VARIABLE;
            }

            if ($ops->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_LITERAL;
            }
        }

        if ($ops instanceof Operand\Literal) {
            return MyOp::TYPE_LITERAL;
        }*/

/*
        if (isset($op->var->original) 
            && $op->var->original instanceof Operand\Variable) {
            $instDefChained = new MyInstruction(Opcodes::VARIABLE);
            $instDefChained->addProperty(MyInstruction::VARIABLE_NAME, $op->var->original->name->value);
            $context->getCurrentMycode()->addCode($instDefChained);
        }
        */
    }

    public static function getTypeDef($op)
    {
        if (isset($op->var->ops[0])) {
            if ($op->var->ops[0] instanceof Op\Expr\PropertyFetch) {
                return MyOp::TYPE_PROPERTY;
            }

            if ($op->var->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                return MyOp::TYPE_STATIC_PROPERTY;
            }

            if ($op->var->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                return MyOp::TYPE_ARRAY;
            }

            if (isset($op->var->original->name->value)) {
                return MyOp::TYPE_VARIABLE;
            }
        }

        return null;
    }

    public static function getNameDefinition($ops, $lookingForProperty = false)
    {
        //  $this->property = property
        if ($lookingForProperty
            && ($ops instanceof Op\Expr\PropertyFetch || $ops instanceof Op\Expr\StaticPropertyFetch)
                && isset($ops->name->value)) {
            return $ops->name->value;
        }

        //  $this->property = this
        if (isset($ops->var) && $ops->var instanceof Operand\BoundVariable && isset($ops->var->name->value)) {
            return $ops->var->name->value;
        }

        if (isset($ops->ops[0])) {
            if ($ops->ops[0] instanceof Op\Expr\ConstFetch) {
                return Common::getNameDefinition($ops->ops[0], $lookingForProperty);
            }

            if ($ops->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                return Common::getNameDefinition($ops->ops[0], $lookingForProperty);
            }

            if ($ops->ops[0] instanceof Op\Expr\PropertyFetch) {
                return Common::getNameDefinition($ops->ops[0], $lookingForProperty);
            }

            if ($ops->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                return Common::getNameDefinition($ops->ops[0], $lookingForProperty);
            }
        }

        if (isset($ops->var->ops)) {
            foreach ($ops->var->ops as $op) {
                if ($op instanceof Op\Expr\ConstFetch) {
                    return Common::getNameDefinition($op, $lookingForProperty);
                }

                if ($op instanceof Op\Expr\ArrayDimFetch) {
                    return Common::getNameDefinition($op, $lookingForProperty);
                }

                if ($op instanceof Op\Expr\PropertyFetch) {
                    return Common::getNameDefinition($op, $lookingForProperty);
                }

                if ($op instanceof Op\Expr\StaticPropertyFetch) {
                    return Common::getNameDefinition($op, $lookingForProperty);
                }
            }
        }
        
        if ($ops instanceof Op\Iterator\Value) {
            return Common::getNameDefinition($ops->var, $lookingForProperty);
        }

        // use variable
        if (isset($ops->original->name->value)) {
            return $ops->original->name->value;
        }

        // def variable
        if (isset($ops->var->original->name->value)) {
            return $ops->var->original->name->value;
        }

        // static property
        if (isset($ops->class->value)) {
            return $ops->class->value;
        }

        // class name
        if (isset($ops->name->value)) {
            return $ops->name->value;
        }
        
        // arrayexpr
        if (isset($ops->value)) {
            return $ops->value;
        }

        return "";
    }

    /*
         const FLAG_PUBLIC      = 0x01;
         const FLAG_PROTECTED   = 0x02;
         const FLAG_PRIVATE     = 0x04;
         const FLAG_STATIC      = 0x08;
         const FLAG_ABSTRACT    = 0x10;
         const FLAG_FINAL       = 0x20;
         const FLAG_RETURNS_REF = 0x40;
         const FLAG_CLOSURE     = 0x80;
     */

    public static function getTypeVisibility($visibility)
    {
        switch ($visibility) {
            case 1:
                return "public";
            case 2:
                return "protected";
            case 4:
                return "private";
            default:
                return "public";
        }
    }

    public static function isFuncCallWithoutReturn($op)
    {
        if (isset($op->var->ops[0]) && $op->var->ops[0] instanceof Op\Expr\MethodCall) {
            return true;
        } elseif (isset($op->result->usages[0]) && $op->result->usages[0] instanceof Op\Expr\MethodCall) {
            return true;
        } else {
            if (!(isset($op->result->usages[0])) || (
                          // funccall()[0]
                          !(isset($op->result->usages[0]) && $op->result->usages[0] instanceof Op\Expr\ArrayDimFetch) &&
                          // test = funccall() // funcccall(funccall())
                          !(isset($op->result->usages[0])
                            && (
                                $op->result->usages[0] instanceof Op\Terminal\Echo_
                                || $op->result->usages[0] instanceof Op\Terminal\Return_
                                || $op->result->usages[0] instanceof Op\Expr\Print_
                                || $op->result->usages[0] instanceof Op\Expr\StaticCall
                                || $op->result->usages[0] instanceof Op\Expr\MethodCall
                                || $op->result->usages[0] instanceof Op\Expr\NsFuncCall
                                || $op->result->usages[0] instanceof Op\Expr\FuncCall
                                || $op->result->usages[0] instanceof Op\Expr\Assign
                                || $op->result->usages[0] instanceof Op\Expr\BinaryOp\Concat
                                || $op->result->usages[0] instanceof Op\Expr\Array_
                                || $op->result->usages[0] instanceof Op\Expr\Include_
                                || $op->result->usages[0] instanceof Op\Expr\Eval_
                                
                                || $op->result->usages[0] instanceof Op\Expr\Cast\Int_
                                || $op->result->usages[0] instanceof Op\Expr\Cast\Array_
                                || $op->result->usages[0] instanceof Op\Expr\Cast\Bool_
                                || $op->result->usages[0] instanceof Op\Expr\Cast\Double_
                                || $op->result->usages[0] instanceof Op\Expr\Cast\Object_
                                || $op->result->usages[0] instanceof Op\Expr\Cast\String_
                                
                                || $op->result->usages[0] instanceof Op\Iterator\Reset
                            ))
            )) {
                return true;
            }
        }

        return false;
    }

    public static function getTypeIsArray($ops)
    {
        if (isset($ops->ops[0])) {
            if ($ops->ops[0] instanceof Op\Expr\FuncCall
                || $ops->ops[0] instanceof Op\Expr\NsFuncCall
                    || $ops->ops[0] instanceof Op\Expr\MethodCall
                        || $ops->ops[0] instanceof Op\Expr\StaticCall
                            || $ops->ops[0] instanceof Op\Expr\New_) {
                return MyOp::TYPE_FUNCCALL_ARRAY;
            }

            if ($ops->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                $ret = Common::getTypeDefinition($ops->ops[0]);

                if ($ret === MyOp::TYPE_FUNCCALL_ARRAY) {
                    return MyOp::TYPE_FUNCCALL_ARRAY;
                }

                return MyOp::TYPE_ARRAY;
            }

            if ($ops->ops[0] instanceof Op\Expr\Array_) {
                return MyOp::TYPE_ARRAY_EXPR;
            }
        }

        if (isset($ops->expr->ops[0])) {
            if ($ops->expr->ops[0] instanceof Op\Expr\Array_) {
                return MyOp::TYPE_ARRAY_EXPR;
            }
        }

        if (isset($ops->var->ops[0])) {
            if ($ops->var->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                $ret = Common::getTypeDefinition($ops->var->ops[0]);

                if ($ret == MyOp::TYPE_FUNCCALL_ARRAY) {
                    return MyOp::TYPE_FUNCCALL_ARRAY;
                }

                return MyOp::TYPE_ARRAY;
            }

            if ($ops->var->ops[0] instanceof Op\Expr\FuncCall
                || $ops->var->ops[0] instanceof Op\Expr\NsFuncCall
                    || $ops->var->ops[0] instanceof Op\Expr\MethodCall
                        || $ops->var->ops[0] instanceof Op\Expr\StaticCall
                            || $ops->var->ops[0] instanceof Op\Expr\New_) {
                return MyOp::TYPE_FUNCCALL_ARRAY;
            }
        }

        if (isset($ops->var->original->name)) {
            if ($ops->var->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_LITERAL;
            }
        }

        if (isset($ops->expr->original->name)) {   // return
            if ($ops->expr->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_LITERAL;
            }
        }

        if (isset($ops->original->name)) {
            if ($ops->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_LITERAL;
            }
        }

        if ($ops instanceof Op\Expr\ArrayDimFetch) {
            return MyOp::TYPE_ARRAY;
        }

        if ($ops instanceof Operand\Literal) {
            return MyOp::TYPE_LITERAL;
        }

        return null;
    }


    public static function getTypeIsInstance($ops)
    {
        if (isset($ops->expr->ops[0])) {
            if ($ops->expr->ops[0] instanceof Op\Expr\New_) {
                return MyOp::TYPE_INSTANCE;
            }
        }

        return null;
    }

    public static function getTypeDefinition($ops)
    {
        if (isset($ops->ops[0])) {
            if ($ops->ops[0] instanceof Op\Expr\ConstFetch) {
                return MyOp::TYPE_CONST;
            }

            if ($ops->ops[0] instanceof Op\Expr\FuncCall
                || $ops->ops[0] instanceof Op\Expr\NsFuncCall
                    || $ops->ops[0] instanceof Op\Expr\MethodCall
                        || $ops->ops[0] instanceof Op\Expr\StaticCall
                            || $ops->ops[0] instanceof Op\Expr\New_) {
                return MyOp::TYPE_FUNCCALL_ARRAY;
            }

            if ($ops->ops[0] instanceof Op\Expr\PropertyFetch) {
                return MyOp::TYPE_PROPERTY;
            }

            if ($ops->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                return MyOp::TYPE_STATIC_PROPERTY;
            }

            if ($ops->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                return Common::getTypeDefinition($ops->ops[0]);
            }
        }

        if (isset($ops->var->ops[0])) {
            if ($ops->var->ops[0] instanceof Op\Expr\ArrayDimFetch) {
                return Common::getTypeDefinition($ops->var->ops[0]);
            }

            if ($ops->var->ops[0] instanceof Op\Expr\PropertyFetch) {
                return MyOp::TYPE_PROPERTY;
            }

            if ($ops->var->ops[0] instanceof Op\Expr\StaticPropertyFetch) {
                return MyOp::TYPE_STATIC_PROPERTY;
            }

            if ($ops->var->ops[0] instanceof Op\Expr\FuncCall
                || $ops->var->ops[0] instanceof Op\Expr\NsFuncCall
                    || $ops->var->ops[0] instanceof Op\Expr\MethodCall
                        || $ops->var->ops[0] instanceof Op\Expr\StaticCall
                            || $ops->var->ops[0] instanceof Op\Expr\New_) {
                return MyOp::TYPE_FUNCCALL_ARRAY;
            }
        }

        if (isset($ops->var->original->name)) {
            if ($ops->var->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_VARIABLE;
            }
        }

        if (isset($ops->expr->original->name)) {   // return
            if ($ops->expr->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_LITERAL;
            }
        }

        if (isset($ops->original->name)) {
            if ($ops->original instanceof Operand\Variable) {
                return MyOp::TYPE_VARIABLE;
            }

            if ($ops->original->name instanceof Operand\Literal) {
                return MyOp::TYPE_LITERAL;
            }
        }

        if ($ops instanceof Operand\Literal) {
            return MyOp::TYPE_LITERAL;
        }

        if ($ops instanceof Op\Expr\PropertyFetch) {
            return MyOp::TYPE_PROPERTY;
        }

        if ($ops instanceof Op\Expr\StaticPropertyFetch) {
            return MyOp::TYPE_STATIC_PROPERTY;
        }

        if ($ops instanceof Op\Iterator\Value) {
            return MyOp::TYPE_VARIABLE;
        }

        return null;
    }
}
