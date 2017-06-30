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
	private $file;

	public function __construct() 
	{
		$this->file = null;
	}
	
	public function set_file($file)
	{
		$this->file = $file;
	}

	public function parse($context)
	{
		$script = null;

		// parser
		if(!is_null($this->file))
		{
			$asttraverser = new \PhpParser\NodeTraverser;
			$asttraverser->addVisitor(new \PhpParser\NodeVisitor\NameResolver);

			$parser = new \PHPCfg\Parser((new \PhpParser\ParserFactory)->create(\PhpParser\ParserFactory::PREFER_PHP7), $asttraverser);

			if(!file_exists($this->file))
				throw new \Exception(Lang::FILE_DONT_EXIST);

			$code = file_get_contents($this->file);
			$script = $parser->parse($code, "");

			$context->set_path(dirname($this->file));
		}

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
			$context->inputs->read_includes();

			$traverser = new \PHPCfg\Traverser();
			$traverser->addVisitor(new \progpilot\Transformations\Php\Transform());
			$traverser->getVisitor(0)->set_context($context);

			$traverser->traverse($script);
		}
	}

	public function run($context, $firststeps = true)
	{
        if($firststeps)
        {
            $context->set_first_file($this->file);
            $script = $this->parse($context);
            $this->transform($context, $script);
        }
        
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

}


?>
