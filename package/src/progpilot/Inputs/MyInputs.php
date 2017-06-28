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

	private $sanitizers;
	private $sinks;
	private $sources;

	private $sources_file;
	private $sinks_file;
	private $sanitizers_file;

	public function __construct() {

		$this->sanitizers = [];
		$this->sinks = [];
		$this->sources = [];

		$this->sanitizers_file = null;
		$this->sinks_file = null;
		$this->sources_file = null;
	}

	public function get_sanitizer_byname($name)
	{
		foreach($this->sanitizers as $mysanitizer)
		{
			if($mysanitizer->get_name() == $name)
				return $mysanitizer;
		}

		return null;
	}

	public function get_sink_byname($name, $instance_name)
	{
		foreach($this->sinks as $mysink)
		{
			if($mysink->get_name() == $name)
			{
                if(!$mysink->is_instance() 
                    || ($mysink->is_instance() && $mysink->get_instanceof_name() == $instance_name))
				return $mysink;
            }
		}

		return null;
	}

	public function get_source_byname($name)
	{
		foreach($this->sources as $mysource)
		{
			if($mysource->get_name() == $name)
				return $mysource;
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

	public function read_sanitizers()
	{
		if($this->sanitizers_file != null)
		{
			if(!file_exists($this->sanitizers_file))
				throw new \Exception(Lang::FILE_DONT_EXIST);

			$output_json = file_get_contents($this->sanitizers_file);

			$parsed_json = json_decode($output_json);

			if(isset($parsed_json->{'sanitizers'}))
			{
				$sanitizers = $parsed_json->{'sanitizers'};
				foreach($sanitizers as $sanitizer)
				{
					if(!isset($sanitizer->{'name'}) 
							|| !isset($sanitizer->{'language'})
							|| !isset($sanitizer->{'type'})
							|| !isset($sanitizer->{'prevent'}))
						throw new \Exception(Lang::FORMAT_SANITIZERS);


					$name = $sanitizer->{'name'};
					$language = $sanitizer->{'language'};
					$type = $sanitizer->{'type'};
					$prevent = $sanitizer->{'prevent'};

					$mysanitizer = new MySanitizer($name, $language, $type, $prevent);
					$this->sanitizers[] = $mysanitizer;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_SANITIZERS);
		}
	}

	public function read_sinks()
	{
		if($this->sinks_file != null)
		{
			if(!file_exists($this->sinks_file))
				throw new \Exception(Lang::FILE_DONT_EXIST);

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
					
					$this->sinks[] = $mysink;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_SINKS);
		}
	}

	public function read_sources()
	{
		if($this->sources_file != null)
		{
			if(!file_exists($this->sources_file))
				throw new \Exception(Lang::FILE_DONT_EXIST);

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
					$this->sources[] = $mysource;
				}
			}
			else
				throw new \Exception(Lang::FORMAT_SOURCES);
		}
	}
}

?>
