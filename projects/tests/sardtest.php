<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';

function scandir_rec($dir, &$files)
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
					if(is_dir($dir."/".$filedir))
						scandir_rec($dir."/".$filedir, $files);
					
					else
						$files[] = $dir."/".$filedir;
				}
			}
		}
	}
}


try {
	
		
	$framework = new framework_test;
			
	$framework->add_testbasis("./tests/sard/000/CWE_98__backticks__whitelist_using_array__require_file_name-concatenation_simple_quote.php");
	$framework->add_output("./tests/sard/000/CWE_98__backticks__whitelist_using_array__require_file_name-concatenation_simple_quote.php", array("var7"));
	$framework->add_output("./tests/sard/000/CWE_98__backticks__whitelist_using_array__require_file_name-concatenation_simple_quote.php", array("3"));
	$framework->add_output("./tests/sard/000/CWE_98__backticks__whitelist_using_array__require_file_name-concatenation_simple_quote.php", "file_inclusion");

	$framework->add_testbasis("./tests/sard/001/CWE_98__backticks__whitelist_using_array__include_file_name-interpretation_simple_quote.php");
	$framework->add_output("./tests/sard/001/CWE_98__backticks__whitelist_using_array__include_file_name-interpretation_simple_quote.php", array("var7"));
	$framework->add_output("./tests/sard/001/CWE_98__backticks__whitelist_using_array__include_file_name-interpretation_simple_quote.php", array("3"));
	$framework->add_output("./tests/sard/001/CWE_98__backticks__whitelist_using_array__include_file_name-interpretation_simple_quote.php", "file_inclusion");

	foreach($framework->get_testbasis() as $file)
	{
		$context = new \progpilot\Context;
		$analyzer = new \progpilot\Analyzer;
		
		$context->inputs->set_sources("./data/sources.json");
		$context->inputs->set_sinks("./data/sinks.json");
		$context->inputs->set_sanitizers("./data/sanitizers.json");
		
		$analyzer->set_file($file);
		$analyzer->run($context);
		
		$results = $context->get_results();
		$outputjson = array('results' => $results); 

		$parsed_json = $outputjson["results"];
		echo "test $file ";

		if(isset($parsed_json[0]) && count($parsed_json) == 1)
		{
			$vuln = $parsed_json[0];
			
			$basis_outputs = [
				$vuln['source'],
				$vuln['source_line'],
				$vuln['vuln_name']];
				
			if($framework->check_outputs($file, $basis_outputs))
			{
				echo "[$file] test result ok\n";
			}
			else
			{
				echo "[$file] test result ko\n";
				var_dump($vuln);
			}
		}
		else
		{
			echo "[$file] test result ko\n";
			var_dump($parsed_json);
		}

	}

} catch (\RuntimeException $e) {
	$result = $e->getMessage();
}


	/*
	$files = [];
	scandir_rec("./tests/sard", $files);

	foreach($files as $file)
	{
		echo "\$framework->add_testbasis(\"$file\");\n";
		echo "\$framework->add_output(\"$file\", array(\"var7\"));\n";
		echo "\$framework->add_output(\"$file\", array(\"3\"));\n";
		echo "\$framework->add_output(\"$file\", \"file_inclusion\");\n\n";
	}
	*/

?>
