<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Analysis;

use progpilot\Objects\MyOp;
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
			if($call->get_name() == $cur_func->get_name() && $call->get_type() != MyOp::TYPE_METHOD && $cur_func->get_type() != MyOp::TYPE_METHOD)
				return true;

			if($call->get_name() == $cur_func->get_name() && $call->get_type() == MyOp::TYPE_METHOD && $cur_func->get_type() == MyOp::TYPE_METHOD)
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

							$tainted = false;
							if(!is_null($this->context->inputs->get_source_byname($tempdefa->get_name(), false, false, $tempdefa->get_array_value())))
								$tainted = true;
							$tempdefa->set_tainted($tainted);

							$defs = ResolveDefs::temporary_simple($this->context, $this->defs, $tempdefa);

							foreach($defs as $def)
							{	
								if($def->get_type() == MyOp::TYPE_PROPERTY)
								{
									if(!is_null($this->context->inputs->get_source_byname($def->get_name(), false, $def->get_class_name(), false)))
										$def->set_tainted(true);
								}

								$exprs = $def->get_exprs();
								foreach($exprs as $expr)
								{
									if($expr->is_assign())
									{
										$defassign = $expr->get_assign_def();

										$defassign->last_known_value($def->get_last_known_value());
										
										if($tempdefa->get_cast() == MyDefinition::CAST_NOT_SAFE)
                                            $defassign->set_cast($def->get_cast());
                                        else
                                            $defassign->set_cast($tempdefa->get_cast());

										ArrayAnalysis::copy_array($this->context, $this->defs->getoutminuskill($tempdefa->get_block_id()), $tempdefa, $tempdefa->get_array_value(), $defassign, $defassign->get_array_value());

										$safe = AssertionAnalysis::temporary_simple($this->context, $this->defs, $this->current_myblock, $def, $tempdefa);

										TaintAnalysis::set_tainted($this->context, $this->defs->getoutminuskill($def->get_block_id()), $def, $defassign, $expr, $safe); 
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
							if($myfunc_call->get_type() == MyOp::TYPE_INSTANCE)
							{
								$mydef_tmp = new MyDefinition($myfunc_call->getLine(), $myfunc_call->getColumn(), $myfunc_call->get_name_instance());
								$mydef_tmp->set_block_id($myfunc_call->get_block_id());
								$mydef_tmp->set_assign_id($myfunc_call->get_back_def()->get_assign_id());
								$mydef_tmp->set_source_myfile($myfunc_call->get_source_myfile());

								$instances = ResolveDefs::select_instances(
										$this->context, 
										$this->defs->getoutminuskill($mydef_tmp->get_block_id()), 
										$mydef_tmp, 
										false);

								foreach($instances as $instance)
								{
									if($instance->get_type() == MyOp::TYPE_INSTANCE)
									{
										// the class is defined (it's always the case (build-in php or not), see visitorflowanalysis)
										$myclasses = $instance->get_all_myclass();

										foreach($myclasses as $myclass)
										{
											$myfunc = $myclass->get_method($funcname);

											if(ResolveDefs::get_visibility_method($instance, $myfunc))
												$list_myfunc[] = [$myfunc, $myclass];
											else
												$list_myfunc[] = [null, $myclass];

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

								ResolveDefs::instance_build_this($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myfunc, $myfunc_call);

								if(!is_null($myfunc) && !$this->in_call_stack($myfunc))
								{
									$addr_start = $myfunc->get_start_address_func();
									$addr_end = $myfunc->get_end_address_func();

									// the called function is a method and this method exists in the class 
									if($myfunc_call->get_type() == MyOp::TYPE_INSTANCE && $myfunc->get_type() == MyOp::TYPE_METHOD || ($myfunc_call->get_type() != MyOp::TYPE_INSTANCE && $myfunc->get_type() != MyOp::TYPE_METHOD))
									{
										// the called function is defined in our project (not php build'in function)
										if($addr_start >= 0)
										{
											ArrayAnalysis::funccall_before($this->context, $this->defs, $myfunc, $myfunc_call, $instruction);
											TaintAnalysis::funccall_before($this->context, $this->defs, $myfunc, $instruction, $this->context->get_classes());

											$mycodefunction = new MyCode;
											$mycodefunction->set_codes($mycode->get_codes());
											$mycodefunction->set_start($addr_start);
											$mycodefunction->set_end($addr_end);

											$this->analyze($mycodefunction);

											ArrayAnalysis::funccall_after($this->context, $myfunc, $myfunc_call, $arr_funccall, $code[$index + 3]);
											TaintAnalysis::funccall_after($this->context, $this->defs, $myfunc, $arr_funccall, $instruction);  
										}
									}
								}

								if(is_null($myfunc))
									ResolveDefs::copy_instance($this->context, $this->defs, $myfunc_call);

								ResolveDefs::instance_build_back($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myfunc, $myfunc_call);

								TaintAnalysis::funccall_validator($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myinstance, $myfunc_call, $arr_funccall, $instruction, $index); 
								TaintAnalysis::funccall_sanitizer($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myinstance, $myfunc_call, $arr_funccall, $instruction, $index);     
								TaintAnalysis::funccall_source($this->context, $this->defs->getoutminuskill($myfunc_call->get_block_id()), $myinstance, $myfunc_call, $arr_funccall, $instruction);  
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
