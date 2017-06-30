<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Outputs;

use progpilot\Lang;

class MyOutputs {

    private $resolve_includes;
    private $resolve_includes_file;
    
    public $current_includes_file;

	public function __construct() {

		$this->resolve_includes = false;
		$this->resolve_includes_file = null;
		$this->current_includes_file = "";
	}

	public function get_resolve_includes()
	{
		return $this->resolve_includes;
	}

	public function resolve_includes($option)
	{
		$this->resolve_includes = $option;
	}

	public function resolve_includes_file($file)
	{
		$this->resolve_includes_file = $file;
	}

	public function get_resolve_includes_file()
	{
        return $this->resolve_includes_file;
	}
	
	public function write_includes_file()
	{
        if($this->resolve_includes)
        {
			if(!file_exists($this->resolve_includes_file))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);
				
            $fp = fopen($this->resolve_includes_file, "w");
            if($fp)
            {
                $outputjson = array('includes_not_resolved' => $this->current_includes_file); 
                fwrite($fp, json_encode($outputjson, JSON_UNESCAPED_SLASHES));
                fclose($fp);
            }
        }
	}

}

?>
