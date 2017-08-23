<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace progpilot;

class Analyzer
{
	private $current_script;

	public function __construct() 
	{
		$this->current_script = null;
	}

	function get_files_ofdir($context, $dir, &$files)
	{
		if(is_dir($dir))
		{
			$filesanddirs = scandir($dir);

			if($filesanddirs != false)
			{
				foreach($filesanddirs as $filedir)
				{
					if($filedir != '.' && $filedir != "..")
					{
                        $folderorfile = $dir."/".$filedir;
						if(is_dir($folderorfile))
						{
                            if(!$context->inputs->is_excluded_folder($folderorfile))
                                $this->get_files_ofdir($context, $folderorfile, $files);
                        }
						else
						{
                            if(!$context->inputs->is_excluded_file($folderorfile))
                            {
                                if(!in_array($folderorfile, $files, true))
                                    $files[] = $folderorfile;
                            }
                        }
					}
				}
			}
		}
	}

	public function get_current_script()
	{
		return $this->current_script;
	}

	public function parse($context)
	{
		$script = null;

		// parser
		if(!is_null($context->inputs->get_file()) || !is_null($context->inputs->get_code()))
		{
			$asttraverser = new \PhpParser\NodeTraverser;
			$asttraverser->addVisitor(new \PhpParser\NodeVisitor\NameResolver);
			$asttraverser->addVisitor($context->outputs->ast);
			$parser = new \PHPCfg\Parser((new \PhpParser\ParserFactory)->create(\PhpParser\ParserFactory::PREFER_PHP7), $asttraverser);

			if(!file_exists($context->inputs->get_file()) && is_null($context->inputs->get_code()))
				throw new \Exception(Lang::FILE_DOESNT_EXIST);

			if(is_null($context->inputs->get_file()) && is_null($context->inputs->get_code()))
				throw new \Exception(Lang::FILE_AND_CODE_ARE_NULL);

			if(is_null($context->inputs->get_code()))
			{
				$code = file_get_contents($context->inputs->get_file());
				$script = $parser->parse($code, "");
				$context->set_path(dirname($context->inputs->get_file()));
			}
			else
				$script = $parser->parse($context->inputs->get_code(), "");
		}

		$this->current_script = $script;

		return $script;
	}

	public function transform($context, $script)
	{
		// transform
		if(!is_null($script))
		{
			$context->inputs->read_sanitizers();
			$context->inputs->read_sinks();
			$context->inputs->read_sources();
			$context->inputs->read_resolved_includes();
			$context->inputs->read_validators();
			$context->inputs->read_false_positives();

			$traverser = new \PHPCfg\Traverser();
			$traverser->addVisitor(new \progpilot\Transformations\Php\Transform());
			$traverser->getVisitor(0)->set_context($context);

			$traverser->traverse($script);
		}
	}

	public function run_internal($context)
	{
		$context->reset_internal_values();

		$script = $this->parse($context);
		$this->transform($context, $script);

		// analyze
		if(!is_null($context))
		{
			$context->get_mycode()->set_start(0);
			$context->get_mycode()->set_end(count($context->get_mycode()->get_codes()));

			$visitordataflow = new \progpilot\Dataflow\VisitorDataflow();
			$visitordataflow->analyze($context);

			$myfunc = $context->get_functions()->get_function("{main}");

			if(!is_null($myfunc))
			{
				$context->get_mycode()->set_start($myfunc->get_start_address_func());
				$context->get_mycode()->set_end($myfunc->get_end_address_func());

				$visitoranalyzer = new \progpilot\Analysis\VisitorAnalysis;
				$visitoranalyzer->set_context($context);
				$visitoranalyzer->analyze($context->get_mycode());
			}
			else
			{
				// throw main function missing
			}
		}
	}

	public function run($context)
	{
		$files = [];
		
        $context->inputs->read_includes_file();
        $context->inputs->read_excludes_file();
        
        $included_files = $context->inputs->get_included_files();
        $included_folders = $context->inputs->get_included_folders();
        
        foreach($included_files as $included_file)
        {
            if(!in_array($included_file, $files, true))
                $files[] = $included_file;
        }
        
        foreach($included_folders as $included_folder)
            $this->get_files_ofdir($context, $included_folder, $files);
        
		if(!is_null($context->inputs->get_folder()))
			$this->get_files_ofdir($context, $context->inputs->get_folder(), $files);
		else
		{
            if(!in_array($context->inputs->get_file(), $files, true))
                $files[] = $context->inputs->get_file();
        }
        
		foreach($files as $file)
		{
            $context->inputs->set_file($file);
            $context->set_first_file($file);
            $this->run_internal($context);
		}

		if(count($files) == 0 && !is_null($context->inputs->get_code()))
			$this->run_internal($context);
	}

}


?>
