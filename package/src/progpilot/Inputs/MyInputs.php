<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

use progpilot\Lang;

class MyInputs {

	private $includes;
	private $includes_file;

	private $sanitizers;
	private $sinks;
	private $sources;
	private $validators;
	private $false_positives;

	private $false_positives_file;
	private $sources_file;
	private $sinks_file;
	private $sanitizers_file;
	private $validators_file;

	private $file;
	private $code;

	public function __construct() {

		$this->includes = [];
		$this->sanitizers = [];
		$this->sinks = [];
		$this->sources = [];
		$this->validators = [];
		$this->false_positives = [];

		$this->false_positives_file = null;
		$this->includes_file = null;
		$this->sanitizers_file = null;
		$this->sinks_file = null;
		$this->sources_file = null;
		$this->validators_file = null;

		$this->file = null;
		$this->code = null;
	}

	public function get_file()
	{
		return $this->file;
	}

	public function get_code()
	{
		return $this->code;
	}

	public function set_file($file)
	{
		$this->file = $file;
	}

	public function set_code($code)
	{
		$this->code = $code;
	}

	public function get_include_bylocation($line, $column, $source_file)
	{
		foreach($this->includes as $myinclude)
		{
			if($myinclude->get_line() == $line 
					&& $myinclude->get_column() == $column
					&& $myinclude->get_source_file() == $source_file)
				return $myinclude;
		}

		return null;
	}

	public function get_validator_byname($stack_class, $myfunc, $myclass)
	{
		foreach($this->validators as $myvalidator)
		{
            if($myvalidator->get_name() == $myfunc->get_name())
			{
                if(!$myvalidator->is_instance() && !$myfunc->get_is_method())
					return $myvalidator;
					
                if($myvalidator->is_instance() && $myfunc->get_is_method())
                {
                    if(!is_null($myclass) && $myvalidator->get_instanceof_name() == $myclass->get_name())
                        return $myvalidator;
                    
                    $properties_validator = explode("->", $myvalidator->get_instanceof_name());
                    
                    if(is_array($properties_validator))
                    {
                        $myvalidator_instance_name = $properties_validator[0];
                            
                        $myvalidator_number_ofproperties = count($properties_validator);
                        $stack_number_ofproperties = count($stack_class);

                        if($stack_number_ofproperties >= $myvalidator_number_ofproperties)
                        {
                            $known_properties = $stack_class[$stack_number_ofproperties - $myvalidator_number_ofproperties];
                            
                            foreach($known_properties as $prop_class)
                            {
                                if($prop_class->get_name() == $myvalidator_instance_name)
                                    return $myvalidator;
                            }
                        }
                    }
                }
			}
		}

		return null;
	}

	public function get_sanitizer_byname($stack_class, $myfunc, $myclass)
	{
		foreach($this->sanitizers as $mysanitizer)
		{
			if($mysanitizer->get_name() == $myfunc->get_name())
			{
                if(!$mysanitizer->is_instance() && !$myfunc->get_is_method())
					return $mysanitizer;
					
                if($mysanitizer->is_instance() && $myfunc->get_is_method())
                {
                    if(!is_null($myclass) && $mysanitizer->get_instanceof_name() == $myclass->get_name())
                        return $mysanitizer;
                    
                    $properties_sanitizer = explode("->", $mysanitizer->get_instanceof_name());
                    
                    if(is_array($properties_sanitizer))
                    {
                        $mysanitizer_instance_name = $properties_sanitizer[0];
                            
                        $mysanitizer_number_ofproperties = count($properties_sanitizer);
                        $stack_number_ofproperties = count($stack_class);

                        if($stack_number_ofproperties >= $mysanitizer_number_ofproperties)
                        {
                            $known_properties = $stack_class[$stack_number_ofproperties - $mysanitizer_number_ofproperties];
                            
                            foreach($known_properties as $prop_class)
                            {
                                if($prop_class->get_name() == $mysanitizer_instance_name)
                                    return $mysanitizer;
                            }
                        }
                    }
                }
			}
		}

		return null;
	}

	public function get_sink_byname($stack_class, $myfunc, $myclass)
	{
		foreach($this->sinks as $mysink)
		{
            if($mysink->get_name() == $myfunc->get_name())
			{
                if(!$mysink->is_instance() && !$myfunc->get_is_method())
					return $mysink;
					
                if($mysink->is_instance() && $myfunc->get_is_method())
                {
                    if(!is_null($myclass) && $mysink->get_instanceof_name() == $myclass->get_name())
                        return $mysink;
                    
                    $properties_sink = explode("->", $mysink->get_instanceof_name());
                    
                    if(is_array($properties_sink))
                    {
                        $mysink_instance_name = $properties_sink[0];
                            
                        $mysink_number_ofproperties = count($properties_sink);
                        $stack_number_ofproperties = count($stack_class);

                        if($stack_number_ofproperties >= $mysink_number_ofproperties)
                        {
                            $known_properties = $stack_class[$stack_number_ofproperties - $mysink_number_ofproperties];
                            
                            foreach($known_properties as $prop_class)
                            {
                                if($prop_class->get_name() == $mysink_instance_name)
                                    return $mysink;
                            }
                        }
                    }
                }
			}
		}

		return null;
	}

	public function get_source_byname($stack_class, $myfunc_or_def, $is_function = false, $instance_name = false, $arr_value = false)
	{
		foreach($this->sources as $mysource)
		{
			if($mysource->get_name() == $myfunc_or_def->get_name())
			{
				$check_function = false;
				$check_array = false;
				$check_instance = false;
				
                if(!$instance_name)
					$check_instance = true;
                
                
                if($instance_name && $mysource->is_instance())
                {
                    if($mysource->get_instanceof_name() == $instance_name)
                        $check_instance = true;
                        
                    $properties_source = explode("->", $mysource->get_instanceof_name());
                    
                    if(is_array($properties_source))
                    {
                        $mysource_instance_name = $properties_source[0];
                            
                        $mysource_number_ofproperties = count($properties_source);
                        $stack_number_ofproperties = count($stack_class);

                        if($stack_number_ofproperties >= $mysource_number_ofproperties)
                        {
                            $known_properties = $stack_class[$stack_number_ofproperties - $mysource_number_ofproperties];
                            
                            foreach($known_properties as $prop_class)
                            {
                                if($prop_class->get_name() == $mysource_instance_name)
                                    $check_instance = true;
                            }
                        }
                    }
                }

				if($mysource->is_function() == $is_function)
					$check_function = true;

				if(($arr_value != false
							&& $mysource->get_is_array()
							&& is_null($mysource->get_array_value())) 
						|| (!$arr_value && !$mysource->get_is_array()))
					$check_array = true;

				if(($arr_value != false 
							&& $mysource->get_is_array() 
							&& !is_null($mysource->get_array_value())
							&& $mysource->get_array_value() == $arr_value))
					$check_array = true;

				if($check_array && $check_instance && $check_function)
					return $mysource;
			}
		}

		return null;
	}

	public function get_false_positive_byid($id)
	{
		foreach($this->false_positives as $false_positive)
		{
			if($false_positive->get_id() == $id)
				return $false_positive;
		}

		return null;
	}

	public function get_sanitizers()
	{
		return $this->sanitizers;
	}

	public function get_sinks()
	{
		return $this->sinks;
	}

	public function get_sources()
	{
		return $this->sources;
	}

	public function get_validators()
	{
		return $this->validators;
	}

	public function get_includes()
	{
		return $this->includes;
	}

	public function get_false_positives()
	{
		return $this->false_positives_file;
	}

	public function set_false_positives($file)
	{
		$this->false_positives_file = $file;
	}

	public function set_includes($file)
	{
		$this->includes_file = $file;
	}

	public function set_sources($file)
	{
		$this->sources_file = $file;
	}

	public function set_sinks($file)
	{
		$this->sinks_file = $file;
	}

	public function set_sanitizers($file)
	{
		$this->sanitizers_file = $file;
	}

	public function set_validators($file)
	{
		$this->validators_file = $file;
	}

	public function read_sanitizers()
	{
		if(!is_null($this->sanitizers_file))
		{
			if(!file_exists($this->sanitizers_file))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);

			$output_json = file_get_contents($this->sanitizers_file);

			$parsed_json = json_decode($output_json);

			if(isset($parsed_json->{'sanitizers'}))
			{
				$sanitizers = $parsed_json->{'sanitizers'};
				foreach($sanitizers as $sanitizer)
				{
					if(!isset($sanitizer->{'name'}) 
							|| !isset($sanitizer->{'language'})
							|| !isset($sanitizer->{'prevent'}))
						throw new \Exception(Lang::FORMAT_SANITIZERS);


					$name = $sanitizer->{'name'};
					$language = $sanitizer->{'language'};
					$prevent = $sanitizer->{'prevent'};

					$mysanitizer = new MySanitizer($name, $language, $prevent);

					if(isset($sanitizer->{'instanceof'}))
					{
						$mysanitizer->set_is_instance(true);
						$mysanitizer->set_instanceof_name($sanitizer->{'instanceof'});
					}
					
					if(isset($sanitizer->{'parameters'}))
					{
						$parameters = $sanitizer->{'parameters'};
						foreach($parameters as $parameter)
						{
							if(isset($parameter->{'id'}) && isset($parameter->{'condition'}))
							{
								if(is_int($parameter->{'id'}) 
										&& ($parameter->{'condition'} == "equals"
											|| $parameter->{'condition'} == "valid"))
								{
                                    if($parameter->{'condition'} == "equals")
                                    {
                                        if(isset($parameter->{'values'}))
                                        {
                                            $mysanitizer->add_parameter($parameter->{'id'}, $parameter->{'condition'}, $parameter->{'values'});
                                        }
                                    }
                                    else
									$mysanitizer->add_parameter($parameter->{'id'}, $parameter->{'condition'});
								}
							}
						}

						$mysanitizer->set_has_parameters(true);
					}

					$this->sanitizers[] = $mysanitizer;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_SANITIZERS);
		}
	}

	public function read_sinks()
	{
		if(!is_null($this->sinks_file))
		{
			if(!file_exists($this->sinks_file))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);

			$output_json = file_get_contents($this->sinks_file);
			$parsed_json = json_decode($output_json);

			if(isset($parsed_json->{'sinks'}))
			{
				$sinks = $parsed_json->{'sinks'};
				foreach($sinks as $sink)
				{
					if(!isset($sink->{'name'}) 
							|| !isset($sink->{'language'})
							|| !isset($sink->{'attack'}))
						throw new \Exception(Lang::FORMAT_SINKS);

					$name = $sink->{'name'};
					$language = $sink->{'language'};
					$attack = $sink->{'attack'};

					$mysink = new MySink($name, $language, $attack);

					if(isset($sink->{'instanceof'}))
					{
						$mysink->set_is_instance(true);
						$mysink->set_instanceof_name($sink->{'instanceof'});
					}

					if(isset($sink->{'parameters'}))
					{
						$parameters = $sink->{'parameters'};
						foreach($parameters as $parameter)
						{
							if(is_int($parameter->{'id'}))
								$mysink->add_parameter($parameter->{'id'});
						}

						$mysink->set_has_parameters(true);
					}

					$this->sinks[] = $mysink;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_SINKS);
		}
	}

	public function read_sources()
	{
		if(!is_null($this->sources_file))
		{
			if(!file_exists($this->sources_file))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);

			$output_json = file_get_contents($this->sources_file);
			$parsed_json = json_decode($output_json);

			if(isset($parsed_json->{'sources'}))
			{
				$sources = $parsed_json->{'sources'};
				foreach($sources as $source)
				{
					if(!isset($source->{'name'}) 
							|| !isset($source->{'language'}))
						throw new \Exception(Lang::FORMAT_SOURCES);

					$name = $source->{'name'};
					$language = $source->{'language'};

					$mysource = new MySource($name, $language);

					if(isset($source->{'is_function'}) && $source->{'is_function'})
					{
						$mysource->set_is_function(true);
					}

					if(isset($source->{'is_array'}) && $source->{'is_array'})
					{
						$mysource->set_is_array(true);
					}

					if(isset($source->{'array_index'}))
					{
						$arr = array($source->{'array_index'} => false);
						$mysource->set_array_value($arr);
					}

					if(isset($source->{'instanceof'}))
					{
						$mysource->set_is_instance(true);
						$mysource->set_instanceof_name($source->{'instanceof'});
					}

					if(isset($source->{'return_array_index'}))
					{
						$mysource->set_return_array(true);
						$mysource->set_return_array_value($source->{'return_array_index'});
					}

					if(isset($source->{'parameters'}))
					{
						$parameters = $source->{'parameters'};
						foreach($parameters as $parameter)
						{
							if(is_int($parameter->{'id'}))
							{
								$mysource->add_parameter($parameter->{'id'});

								if(isset($parameter->{'is_array'}) 
										&& $parameter->{'is_array'} 
										&& isset($parameter->{'array_index'}))
								{
									$mysource->add_condition_parameter($parameter->{'id'}, MySource::CONDITION_ARRAY, $parameter->{'array_index'});
								}
							}
						}

						$mysource->set_has_parameters(true);
					}

					$this->sources[] = $mysource;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_SOURCES);
		}
	}

	public function read_validators()
	{
		if(!is_null($this->validators_file))
		{
			if(!file_exists($this->validators_file))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);

			$output_json = file_get_contents($this->validators_file);
			$parsed_json = json_decode($output_json);

			if(isset($parsed_json->{'validators'}))
			{
				$validators = $parsed_json->{'validators'};
				foreach($validators as $validator)
				{
					if(!isset($validator->{'name'}) 
							|| !isset($validator->{'language'}))
						throw new \Exception(Lang::FORMAT_VALIDATORS);

					$name = $validator->{'name'};
					$language = $validator->{'language'};

					$myvalidator = new MyValidator($name, $language);

					if(isset($validator->{'parameters'}))
					{
						$parameters = $validator->{'parameters'};
						foreach($parameters as $parameter)
						{
							if(isset($parameter->{'id'}) && isset($parameter->{'condition'}))
							{
								if(is_int($parameter->{'id'}) 
										&& ($parameter->{'condition'} == "not_tainted"
											|| $parameter->{'condition'} == "array_not_tainted"
											|| $parameter->{'condition'} == "valid"
											|| $parameter->{'condition'} == "equals"))
								{
                                    if($parameter->{'condition'} == "equals")
                                    {
                                        if(isset($parameter->{'values'}))
                                        {
                                            $myvalidator->add_parameter($parameter->{'id'}, $parameter->{'condition'}, $parameter->{'values'});
                                        }
                                    }
                                    else
									$myvalidator->add_parameter($parameter->{'id'}, $parameter->{'condition'});
								}
							}
						}

						$myvalidator->set_has_parameters(true);
					}

					if(isset($validator->{'instanceof'}))
					{
						$myvalidator->set_is_instance(true);
						$myvalidator->set_instanceof_name($validator->{'instanceof'});
					}

					$this->validators[] = $myvalidator;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_VALIDATORS);
		}
	}

	public function read_includes()
	{
		if(!is_null($this->includes_file))
		{
			if(!file_exists($this->includes_file))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);

			$output_json = file_get_contents($this->includes_file);
			$parsed_json = json_decode($output_json);

			if(isset($parsed_json->{'includes'}))
			{
				$includes = $parsed_json->{'includes'};
				foreach($includes as $include)
				{
					if(!isset($include->{'line'}) 
							|| !isset($include->{'column'})
							|| !isset($include->{'source_file'})
							|| !isset($include->{'value'}))
						throw new \Exception(Lang::FORMAT_INCLUDES);

					$line = $include->{'line'};
					$column = $include->{'column'};
					$source_file = $include->{'source_file'};
					$value = $include->{'value'};

					$myinclude = new MyInclude($line, $column, $source_file, $value);
					$this->includes[] = $myinclude;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_INCLUDES);
		}
	}

	public function read_false_positives()
	{
		if(!is_null($this->false_positives_file))
		{
			if(!file_exists($this->false_positives_file))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);

			$output_json = file_get_contents($this->false_positives_file);
			$parsed_json = json_decode($output_json);

			if(isset($parsed_json->{'false_positives'}))
			{
				$false_positives = $parsed_json->{'false_positives'};
				foreach($false_positives as $false_positive)
				{
					if(!isset($false_positive->{'vuln_id'}))
						throw new \Exception(Lang::FORMAT_FALSE_POSITIVES);

					$vuln_id = $false_positive->{'vuln_id'};

					$myvuln = new MyVuln($vuln_id);
					$this->false_positives[] = $myvuln;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_FALSE_POSITIVES);
		}
	}
}

?>
