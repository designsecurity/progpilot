<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';
$framework = new framework_test;
/*
require_once './datatest.php';
require_once './generictest.php';
require_once './includetest.php';
*/
require_once './ooptest.php';
//require_once './twigtest.php';
//require_once './sardtest.php';

try {

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
		//echo "test $file ";
		
        $result_test = false;
		if(is_object($parsed_json) || is_array($parsed_json))
		{
            foreach($parsed_json as $vuln)
            {
                $result_test = true;
                $basis_outputs = [
                    $vuln['source'],
                    $vuln['source_line'],
                    $vuln['vuln_name']];
                    
                if(!$framework->check_outputs($file, $basis_outputs))
                {
                    $result_test = false;
                    break;
                }
            }
        }
		
		if(!$result_test)
		{
			echo "[$file] test result ko\n";
			var_dump($parsed_json);
		}
	}

} catch (\RuntimeException $e) {
	$result = $e->getMessage();
}

?>
