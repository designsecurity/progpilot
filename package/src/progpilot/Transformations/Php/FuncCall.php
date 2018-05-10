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

use progpilot\Objects\MyFunction;
use progpilot\Objects\MyDefinition;
use progpilot\Objects\MyExpr;
use progpilot\Objects\MyOp;

use progpilot\Code\MyInstruction;
use progpilot\Code\Opcodes;
use progpilot\Transformations\Php\Transform;
use progpilot\Transformations\Php\Expr;

class FuncCall
{

        public static function argument($context, $arg, $inst_funcall_main, $funccall_name, $num_param)
        {
            // each argument will be a definition defined by an expression
            $def_name = $funccall_name."_param".$num_param."_".mt_rand();
            $mydef = new MyDefinition($context->get_current_line(), $context->get_current_column(), $def_name);

            $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::START_ASSIGN));
            $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::START_EXPRESSION));

            $myexprparam = new MyExpr($context->get_current_line(), $context->get_current_column());
            $myexprparam->set_assign(true);
            $myexprparam->set_assign_def($mydef);

            $inst_funcall_main->add_property("argdef$num_param", $mydef);
            $inst_funcall_main->add_property("argexpr$num_param", $myexprparam);

            $mytemp = Expr::instruction($arg, $context, $myexprparam);

            if (!is_null($mytemp))
                $mydef->set_value_from_def($mytemp);

            $inst_end_expr = new MyInstruction(Opcodes::END_EXPRESSION);
            $inst_end_expr->add_property(MyInstruction::EXPR, $myexprparam);
            $context->get_current_mycode()->add_code($inst_end_expr);

            $context->get_current_mycode()->add_code(new MyInstruction(Opcodes::END_ASSIGN));

            $inst_def = new MyInstruction(Opcodes::DEFINITION);
            $inst_def->add_property(MyInstruction::DEF, $mydef);
            $context->get_current_mycode()->add_code($inst_def);

            unset($myexprparam);
            unset($mydef);
        }

        /*
        arg2 : expr for the return
        arg3 : arr for the return : function_call()[0] (arr = [0])
         */
        public static function instruction($context, $myexpr, $funccall_arr, $is_method = false, $is_static = false)
        {
            $mybackdef = null;
            $nbparams = 0;
            $property_name = "";
            $class_name = "";

            // instance_name = new obj; instance_name->method_name()
            if ($is_method)
            {
                $instance_name = Common::get_name_definition($context->get_current_op()->var);
                if (isset($context->get_current_op()->var->ops[0]))
                    $property_name = Common::get_name_property($context->get_current_op()->var->ops[0]);
            }

            $funccall_name = "";
            if ($context->get_current_op() instanceof Op\Expr\New_)
            {
                $funccall_name = "__construct";
                // we have the class name

                if (isset($context->get_current_op()->class->value))
                    $class_name = $context->get_current_op()->class->value;

                $is_method = true;

                $instance_name = Common::get_name_definition($context->get_current_op()->result->usages[0]);
                if (isset($context->get_current_op()->result->usages[0]->var->ops[0]))
                    $property_name = Common::get_name_property($context->get_current_op()->result->usages[0]->var->ops[0]);

            }
            else if (isset($context->get_current_op()->name->value))
            {
                $funccall_name = $context->get_current_op()->name->value;
            }

            if ($funccall_name === "define")
            {
                Assign::instruction($context, false, true);
            }

            if ($context->get_current_op() instanceof Op\Expr\Include_)
                $funccall_name = "include";

            else if ($context->get_current_op() instanceof Op\Expr\Print_)
                $funccall_name = "print";

            else if ($context->get_current_op() instanceof Op\Terminal\Echo_)
                $funccall_name = "echo";

            else if ($context->get_current_op() instanceof Op\Expr\Eval_)
                $funccall_name = "eval";

            $inst_funcall_main = new MyInstruction(Opcodes::FUNC_CALL);
            $inst_funcall_main->add_property(MyInstruction::FUNCNAME, $funccall_name);

            $myfunction_call = new MyFunction($funccall_name);
            $myfunction_call->setLine($context->get_current_line());
            $myfunction_call->setColumn($context->get_current_column());


            if ($is_static && isset($context->get_current_op()->class->value))
            {
                $name_class = $context->get_current_op()->class->value;
                $myfunction_call->add_type(MyFunction::TYPE_FUNC_STATIC);
                $myfunction_call->set_name_instance($name_class);
            }

            if ($is_method)
            {
                // when we define a method in a class (TYPE_METHOD) but when we use a method (TYPE_INSTANCE)
                $myfunction_call->add_type(MyFunction::TYPE_FUNC_METHOD);
                $myfunction_call->set_name_instance($instance_name);

                $mybackdef = new MyDefinition($context->get_current_line(), $context->get_current_column(), $instance_name);
                $mybackdef->add_type(MyDefinition::TYPE_INSTANCE);
                $mybackdef->set_class_name($class_name);

                if ($property_name !== "" && count($property_name) > 0)
                {
                    $mybackdef->add_type(MyDefinition::TYPE_PROPERTY);
                    $mybackdef->property->set_properties($property_name);
                }

                $myfunction_call->set_back_def($mybackdef);


            }

            $list_args = [];

            if ($context->get_current_op() instanceof Op\Expr\Include_
                    || $context->get_current_op() instanceof Op\Expr\Print_
                    || $context->get_current_op() instanceof Op\Terminal\Echo_
                    || $context->get_current_op() instanceof Op\Expr\Eval_)
            {
                $list_args[] = $context->get_current_op()->expr;

                if ($context->get_current_op() instanceof Op\Expr\Include_)
                    $inst_funcall_main->add_property(MyInstruction::TYPE_INCLUDE, $context->get_current_op()->type);
            }
            else
                $list_args = $context->get_current_op()->args;

            foreach ($list_args as $arg)
            {
                FuncCall::argument($context, $arg, $inst_funcall_main, $funccall_name, $nbparams);
                $nbparams ++;
            }

            $myfunction_call->set_nb_params($nbparams);
            $inst_funcall_main->add_property(MyInstruction::MYFUNC_CALL, $myfunction_call);
            $inst_funcall_main->add_property(MyInstruction::EXPR, $myexpr);
            $inst_funcall_main->add_property(MyInstruction::ARR, $funccall_arr);
            $context->get_current_mycode()->add_code($inst_funcall_main);

            return $mybackdef;
        }
}

?>
