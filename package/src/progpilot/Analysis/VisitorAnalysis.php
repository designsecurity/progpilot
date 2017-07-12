<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\ArrayStatic;
use progpilot\Objects\MyDefinition;
use progpilot\Dataflow\Definitions;

use progpilot\Code\MyCode;
use progpilot\Code\Opcodes;

class VisitorAnalysis {

	private $context;
	private $results;
	private $storagemyblocks;
	private $call_stack;

	private $defs;
	private $olddefs;

	private $inside_instance;
	private $current_myblock;
	private $old_myblock;

	public function __construct() {

		$this->storagemyblocks = new \SplObjectStorage;
		$this->call_stack = [];
		$this->current_myblock = null;
		$this->old_myblock = null;
	}	

	public function in_call_stack($cur_func)
	{
		foreach($this->call_stack as $call)
		{
			if($call->get_name() == $cur_func->get_name() && !$call->is_method() && !$cur_func->is_method())
				return true;

			if($call->get_name() == $cur_func->get_name() && $call->is_method() && $cur_func->is_method())
			{
				$cur_class = $cur_func->get_myclass();
				$call_class = $call->get_myclass();

				if($cur_class->get_name() == $call_class->get_name())
					return true;
			}
		}

		return false;
	}

	public function set_context($context) {

		$this->context = $context;
	}

	public function set_results(&$myresults) {

		$this->results = &$myresults;
	}

	public function analyze($mycode) {

		$index = $mycode->get_start();
		$code = $mycode->get_codes();

		do
		{
            if(isset($code[$index]))
            {
                $instruction = $code[$index];
                switch($instruction->get_opcode())
                {
                    case Opcodes::ENTER_BLOCK:
                        {
                            $myblock = $instruction->get_property("myblock");
                            $this->old_myblock = $this->current_myblock;
                            $this->current_myblock = $myblock;

                            if($this->storagemyblocks->contains($myblock))
                                return;

                            $this->storagemyblocks->attach($myblock);

                            foreach($myblock->parents as $blockparent)
                            {
                                $addr_start = $blockparent->get_start_address_block();
                                $addr_end = $blockparent->get_end_address_block();
                                
                                if(!$this->storagemyblocks->contains($blockparent))
                                {
                                    $oldindex_start = $mycode->get_start();
                                    $oldindex_end = $mycode->get_end();

                                    $mycode->set_start($addr_start);
                                    $mycode->set_end($addr_end);

                                    $this->analyze($mycode);

                                    $mycode->set_start($oldindex_start);
                                    $mycode->set_end($oldindex_end);
                                }
                            }

                            break;
                        }

                    case Opcodes::LEAVE_BLOCK:
                        {
                            $this->current_myblock = $this->old_myblock;

                            break;
                        }

                    case Opcodes::LEAVE_FUNCTION:
                        {
                            $myfunc = $instruction->get_property("myfunc");
                            if($myfunc->get_name() == "{main}")
                                return;

                            array_pop($this->call_stack);
                            
                            $this->defs = $this->olddefs;

                            break;
                        }

                    case Opcodes::ENTER_FUNCTION:
                        {
                            $myfunc = $instruction->get_property("myfunc");

                            array_push($this->call_stack, $myfunc);

                            $this->olddefs = $this->defs;
                            $this->defs = $myfunc->get_defs();

                            break;
                        }

                    case Opcodes::DEFINITION:
                        {
                            $mydef = $instruction->get_property("def");
                            
                            break;
                        }
                            

                    case Opcodes::TEMPORARY:
                        {
                            $tempdefa = $instruction->get_property("temporary");
                            
                            echo "Opcodes::TEMPORARY\n";
                            $tempdefa->print_stdout();
                            
                            $defs = ResolveDefs::temporary_simple($this->defs, $tempdefa, $this->inside_instance);
                            
                            foreach($defs as $def)
                            {	
                                echo "Opcodes::TEMPORARY foreach ------------\n";
                                $def->print_stdout();
                                
                                $exprs = $def->get_exprs();
                                foreach($exprs as $expr)
                                {
                                    if($expr->is_assign())
                                    {
                                        $defassign = $expr->get_assign_def();
                           
                                        echo "Opcodes::TEMPORARY foreach foreach !!!!!!!!!!!!!!!!!!!!!!!\n";
                                        $defassign->print_stdout();
                                        
                                        ResolveDefs::definition_myinstance_and_visibility($this->defs, $defassign, $this->inside_instance);

                                        $defassign->last_known_value($def->get_last_known_value());

                                        ArrayAnalysis::copy_array($this->defs, $def, $def->get_arr_value(), $defassign, $defassign->get_arr_value());
                                        
                                        $safe = AssertionAnalysis::temporary_simple($this->defs, $this->current_myblock, $def, $tempdefa, $this->inside_instance);

                                        TaintAnalysis::set_tainted($this->defs, $def, $defassign, $expr, $safe, $this->inside_instance); 
                                    }
                                }
                            }

                            break;
                        }

                    case Opcodes::FUNC_CALL:
                        {
                            $funcname = $instruction->get_property("funcname");
                            $arr_funccall = $instruction->get_property("arr");
                            $myfunc_call = $instruction->get_property("myfunc_call");

                            SecurityAnalysis::funccall($this->context, $myfunc_call, $instruction);
                            
                            $list_myfunc = [];
                            if($myfunc_call->is_instance())
                            {
                                $mydef_tmp = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name_instance(), false, false);
                                $mydef_tmp->set_block_id($myfunc_call->get_block_id());
                                $mydef_tmp->set_method(true);
                                $mydef_tmp->method->set_name($funcname);
                                
                                $instances = ResolveDefs::select_instances($this->defs, $mydef_tmp, $this->inside_instance);
                                
                                foreach($instances as $instance_tab)
                                {
                                    $myclass = $instance_tab[0];
                                    $method = $instance_tab[1];
                                    $visibility_instance = $instance_tab[2];
                                    
                                    echo "Opcodes::FUNC_CALL °°°° foreach name = '".$method->get_name()."'\n";
                                    
                                    // the class is defined (! build in php class for example)
                                    $myfunc = $myclass->get_method($funcname);

                                    if(!is_null($myfunc))
                                    {
                                        $mydefthis = $myfunc->get_this_def();
                                        echo "================================================================== >>>>>>>>>>> !is_null(myfunc)\n";
                                        $mydefthis->print_stdout();
                                        
                                        $clone_mydefthis = new MyDefinition(
                                            $myfunc_call->getLine(), 
                                                $myfunc_call->getColumn(),
                                                    $myfunc_call->get_name_instance(),
                                                        false,
                                                            false);
                                        
                                        $clone_mydefthis->set_block_id($myfunc_call->get_block_id());
                                        $clone_mydefthis->set_method(true);
                                        $clone_mydefthis->method->set_name($funcname);
                                        
                                        $clone_mydefthis->print_stdout();
                                        
                                        ResolveDefs::definition_myinstance_and_visibility($this->defs, $clone_mydefthis, $this->inside_instance);

                                        echo "------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> clone_mydefthis->method->get_myinstances() = '".count($clone_mydefthis->method->get_myinstances())."'\n";
                                        
                                        //var_dump($clone_mydefthis->method->get_myinstances());
                                        $mydefthis->method->set_myinstances($clone_mydefthis->method->get_myinstances());
                                        
                                        $list_myfunc[] = [$myfunc, $myclass];
                                    }
                                    
                                    // twig analysis
                                    if($this->context->get_analyze_js())
                                    {
                                        if($myclass->get_name() == "Twig_Environment")
                                        {
                                            if($myfunc_call->get_name() == "render")
                                            {
                                                TwigAnalysis::funccall($this->context, $myfunc_call, $instruction);
                                            }
                                        }
                                    }
                                }
                            }
                            else
                            {
                                $myfunc = $this->context->get_functions()->get_function($funcname);
                                $list_myfunc[] = [$myfunc, null];
                            }


                            foreach($list_myfunc as $tabfunc)
                            {
                                $myfunc = $tabfunc[0];
                                $myinstance = $tabfunc[1];

                                if(!is_null($myfunc) && !$this->in_call_stack($myfunc))
                                {
                                    $addr_start = $myfunc->get_start_address_func();
                                    $addr_end = $myfunc->get_end_address_func();

                                    // the called function is a method and this method exists in the class 
                                    if($myfunc_call->is_instance() && $myfunc->is_method() || (!$myfunc_call->is_instance() && !$myfunc->is_method()))
                                    {
                                        echo "))))))))))))))))))))))) myfunc_call is_instance\n";
                                        // the called function is defined in our project (not php build'in function)
                                        if($addr_start >= 0)
                                        {
                                            ArrayAnalysis::funccall_before($this->defs, $myfunc, $myfunc_call, $instruction);
                                            TaintAnalysis::funccall_before($this->defs, $myfunc, $instruction, $this->context->get_classes());

                                            $mycodefunction = new MyCode;
                                            $mycodefunction->set_codes($mycode->get_codes());
                                            $mycodefunction->set_start($addr_start);
                                            $mycodefunction->set_end($addr_end);

                                            if($myfunc->is_method())
                                                $this->inside_instance = $mydef_tmp;

                                            $this->analyze($mycodefunction); 

                                            $this->inside_instance = null;

                                            ArrayAnalysis::funccall_after($myfunc, $myfunc_call, $arr_funccall, $code[$index + 3]);
                                            TaintAnalysis::funccall_after($this->defs, $myfunc, $arr_funccall, $instruction);  
                                        }
                                        
                                        if($myfunc_call->is_instance() && $myfunc->is_method())
                                        {
                                            $mybackdef = $myfunc_call->get_back_def();
                                            $mythisdef = $myfunc->get_this_def();
                                            $mythisdef_myinstances = $mythisdef->method->get_myinstances();
                                            
                                            foreach($mythisdef_myinstances as $myinstance)
                                            {
                                                $properties = $myinstance->get_myclass()->get_properties();
                                                
                                                foreach($properties as $property)
                                                {
                                                    echo "FOREACH FOREACH PROPERTY\n";
                                                    $property->print_stdout();
                                                }
                                                
                                                $mybackdef->method->add_myinstance($myinstance);
                                            }
                                        }
                                    }
                                }
                                
                                if(is_null($myfunc))
                                {
                                    TaintAnalysis::funccall_sanitizer($this->context, $this->defs, $myfunc_call, $arr_funccall, $instruction, $index, $this->inside_instance);  
                                    TaintAnalysis::funccall_source($this->context, $this->defs, $myfunc_call, $arr_funccall, $instruction);     
                                }
                            }

                            break;
                        }
                }

                $index = $index + 1;
            }
		}
		while(isset($code[$index]) && $index <= $mycode->get_end());
	}
}
