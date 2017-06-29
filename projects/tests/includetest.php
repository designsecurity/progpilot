<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';

try {
	
	$framework = new framework_test;
	$framework->add_testbasis("./tests/includes/simple1.php");
	$framework->add_output("./tests/includes/simple1.php", array("var1"));
	$framework->add_output("./tests/includes/simple1.php", array("3"));
	$framework->add_output("./tests/includes/simple1.php", "xss");
	
	$framework->add_testbasis("./tests/includes/simple2.php");
	$framework->add_output("./tests/includes/simple2.php", array("var1"));
	$framework->add_output("./tests/includes/simple2.php", array("3"));
	$framework->add_output("./tests/includes/simple2.php", "xss");
	
	$framework->add_testbasis("./tests/includes/simple3.php");
	$framework->add_output("./tests/includes/simple3.php", array("var1"));
	$framework->add_output("./tests/includes/simple3.php", array("3"));
	$framework->add_output("./tests/includes/simple3.php", "xss");
	
	$framework->add_testbasis("./tests/includes/simple4.php");
	$framework->add_output("./tests/includes/simple4.php", array("var1"));
	$framework->add_output("./tests/includes/simple4.php", array("3"));
	$framework->add_output("./tests/includes/simple4.php", "xss");
	
	$framework->add_testbasis("./tests/includes/simple5.php");
	$framework->add_output("./tests/includes/simple5.php", array("var1"));
	$framework->add_output("./tests/includes/simple5.php", array("3"));
	$framework->add_output("./tests/includes/simple5.php", "xss");
	
	
	foreach($framework->get_testbasis() as $file)
	{
		$context = new \progpilot\Context;
		$analyzer = new \progpilot\Analyzer;
		
		$context->inputs->set_sources("./data/sources.json");
		$context->inputs->set_sinks("./data/sinks.json");
		$context->inputs->set_sanitizers("./data/sanitizers.json");
		
		
		//$context->set_analyze_includes(false);
		
        $analyzer->set_file($file);
        
		if($file == "./tests/includes/simple5.php")
		{
            //$context->outputs->resolve_includes_file("./tests/includes/includes_simple5.txt");
            //$context->outputs->resolve_includes(true);
            
            $context->inputs->set_includes("./tests/includes/resolved_includes_simple5.txt");      
        }
            
        try 
        {
            $analyzer->run($context);
        }
        catch (Exception $e) 
        {
            echo 'Exception : ',  $e->getMessage(), "\n";
        }
		
		$results = $context->get_results();
		$outputjson = array('results' => $results); 

		$parsed_json = $outputjson["results"];
		
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

?>
