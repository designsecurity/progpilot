<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';

try {
	
	$framework = new framework_test;
	$framework->add_testbasis("./tests/oop/simple1.php");
	$framework->add_output("./tests/oop/simple1.php", array("boum2"));
	$framework->add_output("./tests/oop/simple1.php", array("6"));
	$framework->add_output("./tests/oop/simple1.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple2.php");
	$framework->add_output("./tests/oop/simple2.php", array("boum2"));
	$framework->add_output("./tests/oop/simple2.php", array("6"));
	$framework->add_output("./tests/oop/simple2.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple3.php");
	$framework->add_output("./tests/oop/simple3.php", array("_GET"));
	$framework->add_output("./tests/oop/simple3.php", array("9"));
	$framework->add_output("./tests/oop/simple3.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple4.php");
	$framework->add_output("./tests/oop/simple4.php", array("_GET"));
	$framework->add_output("./tests/oop/simple4.php", array("10"));
	$framework->add_output("./tests/oop/simple4.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple5.php");
	$framework->add_output("./tests/oop/simple5.php", array("boum1"));
	$framework->add_output("./tests/oop/simple5.php", array("15"));
	$framework->add_output("./tests/oop/simple5.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple6.php");
	$framework->add_output("./tests/oop/simple6.php", array("boum1"));
	$framework->add_output("./tests/oop/simple6.php", array("15"));
	$framework->add_output("./tests/oop/simple6.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple7.php");
	$framework->add_output("./tests/oop/simple7.php", array("boum1"));
	$framework->add_output("./tests/oop/simple7.php", array("5"));
	$framework->add_output("./tests/oop/simple7.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple8.php");
	$framework->add_output("./tests/oop/simple8.php", array("boum2"));
	$framework->add_output("./tests/oop/simple8.php", array("6"));
	$framework->add_output("./tests/oop/simple8.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple9.php");
	$framework->add_output("./tests/oop/simple9.php", array("boum1"));
	$framework->add_output("./tests/oop/simple9.php", array("0"));
	$framework->add_output("./tests/oop/simple9.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple10.php");
	$framework->add_output("./tests/oop/simple10.php", array("boum1"));
	$framework->add_output("./tests/oop/simple10.php", array("5"));
	$framework->add_output("./tests/oop/simple10.php", "xss");
	
	$framework->add_testbasis("./tests/oop/simple11.php");
	$framework->add_output("./tests/oop/simple11.php", array("boum1"));
	$framework->add_output("./tests/oop/simple11.php", array("5"));
	$framework->add_output("./tests/oop/simple11.php", "xss");

	
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
		
		if($result_test)
		{
            echo "[$file] test result ok\n";
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
