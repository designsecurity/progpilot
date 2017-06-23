<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Code;

class MyCode {

	private $code;
	private $start;
	private $end;

	public function __construct() {

		$this->code = [];
	}

	public function get_start()
	{
		return $this->start;
	}

	public function get_end()
	{
		return $this->end;
	}

	public function set_start($start)
	{
		$this->start = $start;
	}

	public function set_end($end)
	{
		$this->end = $end;
	}

	public function set_codes($codes)
	{
		$this->code = $codes;
	}

	public function get_codes()
	{
		return $this->code;
	}

	public function add_code($code)
	{
		$this->code[] = $code;
	}

	public function print_stdout()
	{
		$index = 0;

		do
		{
            if(isset($this->code[$index]))
            {
                $instruction = $this->code[$index];
                echo "[$index] ";
                switch($instruction->get_opcode())
                {
                    case Opcodes::ENTER_FUNCTION:
                        {
                            echo "enter_func\n";

                            $myfunc = $instruction->get_property("myfunc");
                            echo "name = ".htmlentities($myfunc->get_name(), ENT_QUOTES, 'UTF-8')."\n";
                            break;
                        }

                    case Opcodes::CLASSE:
                        {
                            echo "class\n";

                            $myclass = $instruction->get_property("myclass");
                            echo "name = ".htmlentities($myclass->get_name(), ENT_QUOTES, 'UTF-8')."\n";
                            break;
                        }

                    case Opcodes::ENTER_BLOCK:
                        {
                            echo "enter_block\n";

                            $myblock = $instruction->get_property("myblock");
                            echo "id = ".$myblock->get_id()."\n";

                            break;
                        }

                    case Opcodes::LEAVE_BLOCK:
                        {
                            echo "leave_block\n";

                            break;
                        }

                    case Opcodes::LEAVE_FUNCTION:
                        {
                            echo "leave_func\n";

                            break;
                        }

                    case Opcodes::FUNC_CALL:
                        {
                            echo "funccall\n";

                            $funcname = htmlentities($instruction->get_property("funcname"), ENT_QUOTES, 'UTF-8');
                            echo "name = $funcname\n";
                            break;
                        }

                    case Opcodes::START_EXPRESSION:
                        {
                            echo "start_expression\n";
                            break;
                        }

                    case Opcodes::END_EXPRESSION:
                        {
                            echo "end_expression\n";
                            $myexpr = $instruction->get_property("expr");
                            echo "expression et tainted = ".$myexpr->is_tainted()."\n";
                            break;
                        }

                    case Opcodes::CONCAT_LIST:
                        {
                            echo "concat_list\n";
                            break;
                        }

                    case Opcodes::CONCAT_LEFT:
                        {
                            echo "concat_left\n";
                            break;
                        }

                    case Opcodes::CONCAT_RIGHT:
                        {
                            echo "concat_right\n";
                            break;
                        }

                    case Opcodes::RETURN_FUNCTION:
                        {
                            echo "return\n";
                            break;
                        }

                    case Opcodes::START_ASSIGN:
                        {
                            echo "start_assign\n";
                            break;
                        }

                    case Opcodes::END_ASSIGN:
                        {
                            echo "end_assign\n";
                            break;
                        }

                    case Opcodes::START_INCLUDE:
                        {
                            echo "start_include\n";
                            break;
                        }

                    case Opcodes::END_INCLUDE:
                        {
                            echo "end_include\n";
                            break;
                        }

                    case Opcodes::TEMPORARY:
                        {
                            echo "temporary_simple\n";
                            $def = $instruction->get_property("temporary");
                            $def->print_stdout();

                            break;
                        }

                    case Opcodes::DEFINITION:
                        {
                            echo "definition_simple\n";
                            $def = $instruction->get_property("def");
                            $def->print_stdout();

                            break;
                        }
                }
            
                $index = $index + 1;
            }

		}
		while(isset($this->code[$index]));
	}
}

?>
