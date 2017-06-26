<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';

try {

	
			
	$framework = new framework_test;
	
	$framework->add_testbasis("./tests/generic/alias1.php");
	$framework->add_output("./tests/generic/alias1.php", array("var1"));
	$framework->add_output("./tests/generic/alias1.php", array("9"));
	$framework->add_output("./tests/generic/alias1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/alias2.php");
	$framework->add_output("./tests/generic/alias2.php", array("var6"));
	$framework->add_output("./tests/generic/alias2.php", array("4"));
	$framework->add_output("./tests/generic/alias2.php", "xss");
	
	$framework->add_testbasis("./tests/generic/alias3.php");
	$framework->add_output("./tests/generic/alias3.php", array("var5", "var6"));
	$framework->add_output("./tests/generic/alias3.php", array("3", "4"));
	$framework->add_output("./tests/generic/alias3.php", "xss");
	
	$framework->add_testbasis("./tests/generic/alias4.php");
	$framework->add_output("./tests/generic/alias4.php", array("var5"));
	$framework->add_output("./tests/generic/alias4.php", array("3"));
	$framework->add_output("./tests/generic/alias4.php", "xss");
	
	$framework->add_testbasis("./tests/generic/alias5.php");
	$framework->add_output("./tests/generic/alias5.php", array("var5"));
	$framework->add_output("./tests/generic/alias5.php", array("3"));
	$framework->add_output("./tests/generic/alias5.php", "xss");
	
	$framework->add_testbasis("./tests/generic/mix1.php");
	$framework->add_output("./tests/generic/mix1.php", array("var1"));
	$framework->add_output("./tests/generic/mix1.php", array("5"));
	$framework->add_output("./tests/generic/mix1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/mix2.php");
	$framework->add_output("./tests/generic/mix2.php", array("var1"));
	$framework->add_output("./tests/generic/mix2.php", array("9"));
	$framework->add_output("./tests/generic/mix2.php", "xss");
	
	$framework->add_testbasis("./tests/generic/mix3.php");
	$framework->add_output("./tests/generic/mix3.php", array("var2"));
	$framework->add_output("./tests/generic/mix3.php", array("12"));
	$framework->add_output("./tests/generic/mix3.php", "xss");
	
	$framework->add_testbasis("./tests/generic/simple1.php");
	$framework->add_output("./tests/generic/simple1.php", array("myvar1"));
	$framework->add_output("./tests/generic/simple1.php", array("3"));
	$framework->add_output("./tests/generic/simple1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/simple2.php");
	$framework->add_output("./tests/generic/simple2.php", array("myvar2"));
	$framework->add_output("./tests/generic/simple2.php", array("3"));
	$framework->add_output("./tests/generic/simple2.php", "xss");
	
	$framework->add_testbasis("./tests/generic/simple3.php");
	$framework->add_output("./tests/generic/simple3.php", array("var7"));
	$framework->add_output("./tests/generic/simple3.php", array("5"));
	$framework->add_output("./tests/generic/simple3.php", "xss");
	
	$framework->add_testbasis("./tests/generic/simple4.php");
	$framework->add_output("./tests/generic/simple4.php", array("var4"));
	$framework->add_output("./tests/generic/simple4.php", array("5"));
	$framework->add_output("./tests/generic/simple4.php", "xss");
	
	$framework->add_testbasis("./tests/generic/simple5.php");
	$framework->add_output("./tests/generic/simple5.php", array("myvar1"));
	$framework->add_output("./tests/generic/simple5.php", array("3"));
	$framework->add_output("./tests/generic/simple5.php", "xss");
	
	$framework->add_testbasis("./tests/generic/concat1.php");
	$framework->add_output("./tests/generic/concat1.php", array("myvar7"));
	$framework->add_output("./tests/generic/concat1.php", array("7"));
	$framework->add_output("./tests/generic/concat1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays1.php");
	$framework->add_output("./tests/generic/arrays1.php", array("newmyarr"));
	$framework->add_output("./tests/generic/arrays1.php", array("4"));
	$framework->add_output("./tests/generic/arrays1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays2.php");
	$framework->add_output("./tests/generic/arrays2.php", array("newmyarr"));
	$framework->add_output("./tests/generic/arrays2.php", array("3"));
	$framework->add_output("./tests/generic/arrays2.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays3.php");
	$framework->add_output("./tests/generic/arrays3.php", array("newmyarr"));
	$framework->add_output("./tests/generic/arrays3.php", array("4"));
	$framework->add_output("./tests/generic/arrays3.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays4.php");
	$framework->add_output("./tests/generic/arrays4.php", array("newmyarr"));
	$framework->add_output("./tests/generic/arrays4.php", array("4"));
	$framework->add_output("./tests/generic/arrays4.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays5.php");
	$framework->add_output("./tests/generic/arrays5.php", array("var1"));
	$framework->add_output("./tests/generic/arrays5.php", array("3"));
	$framework->add_output("./tests/generic/arrays5.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays6.php");
	$framework->add_output("./tests/generic/arrays6.php", array("_GET"));
	$framework->add_output("./tests/generic/arrays6.php", array("6"));
	$framework->add_output("./tests/generic/arrays6.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays7.php");
	$framework->add_output("./tests/generic/arrays7.php", array("onearr"));
	$framework->add_output("./tests/generic/arrays7.php", array("3"));
	$framework->add_output("./tests/generic/arrays7.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays8.php");
	$framework->add_output("./tests/generic/arrays8.php", array("arr"));
	$framework->add_output("./tests/generic/arrays8.php", array("6"));
	$framework->add_output("./tests/generic/arrays8.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays9.php");
	$framework->add_output("./tests/generic/arrays9.php", array("onearr"));
	$framework->add_output("./tests/generic/arrays9.php", array("4"));
	$framework->add_output("./tests/generic/arrays9.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays10.php");
	$framework->add_output("./tests/generic/arrays10.php", array("arr"));
	$framework->add_output("./tests/generic/arrays10.php", array("3"));
	$framework->add_output("./tests/generic/arrays10.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays11.php");
	$framework->add_output("./tests/generic/arrays11.php", array("arr"));
	$framework->add_output("./tests/generic/arrays11.php", array("3"));
	$framework->add_output("./tests/generic/arrays11.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays12.php");
	$framework->add_output("./tests/generic/arrays12.php", array("var1"));
	$framework->add_output("./tests/generic/arrays12.php", array("9"));
	$framework->add_output("./tests/generic/arrays12.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays13.php");
	$framework->add_output("./tests/generic/arrays13.php", array("_GET"));
	$framework->add_output("./tests/generic/arrays13.php", array("5"));
	$framework->add_output("./tests/generic/arrays13.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays14.php");
	$framework->add_output("./tests/generic/arrays14.php", array("var1"));
	$framework->add_output("./tests/generic/arrays14.php", array("9"));
	$framework->add_output("./tests/generic/arrays14.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arrays15.php");
	$framework->add_output("./tests/generic/arrays15.php", array("var"));
	$framework->add_output("./tests/generic/arrays15.php", array("8"));
	$framework->add_output("./tests/generic/arrays15.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arraysrec1.php");
	$framework->add_output("./tests/generic/arraysrec1.php", array("var1"));
	$framework->add_output("./tests/generic/arraysrec1.php", array("8"));
	$framework->add_output("./tests/generic/arraysrec1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arraysexpr1.php");
	$framework->add_output("./tests/generic/arraysexpr1.php", array("newmyarr"));
	$framework->add_output("./tests/generic/arraysexpr1.php", array("3"));
	$framework->add_output("./tests/generic/arraysexpr1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arraysexpr2.php");
	$framework->add_output("./tests/generic/arraysexpr2.php", array("newmyarr"));
	$framework->add_output("./tests/generic/arraysexpr2.php", array("3"));
	$framework->add_output("./tests/generic/arraysexpr2.php", "xss");
	
	$framework->add_testbasis("./tests/generic/arraysexpr3.php");
	$framework->add_output("./tests/generic/arraysexpr3.php", array("onearr"));
	$framework->add_output("./tests/generic/arraysexpr3.php", array("3"));
	$framework->add_output("./tests/generic/arraysexpr3.php", "xss");
			
	$framework->add_testbasis("./tests/generic/functions1.php");
	$framework->add_output("./tests/generic/functions1.php", array("parama"));
	$framework->add_output("./tests/generic/functions1.php", array("0"));
	$framework->add_output("./tests/generic/functions1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions2.php");
	$framework->add_output("./tests/generic/functions2.php", array("safea"));
	$framework->add_output("./tests/generic/functions2.php", array("8"));
	$framework->add_output("./tests/generic/functions2.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions3.php");
	$framework->add_output("./tests/generic/functions3.php", array("testf_return"));
	$framework->add_output("./tests/generic/functions3.php", array("7"));
	$framework->add_output("./tests/generic/functions3.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions4.php");
	$framework->add_output("./tests/generic/functions4.php", array("testf_return"));
	$framework->add_output("./tests/generic/functions4.php", array("5"));
	$framework->add_output("./tests/generic/functions4.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions5.php");
	$framework->add_output("./tests/generic/functions5.php", array("testf_return"));
	$framework->add_output("./tests/generic/functions5.php", array("5"));
	$framework->add_output("./tests/generic/functions5.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions6.php");
	$framework->add_output("./tests/generic/functions6.php", array("_GET"));
	$framework->add_output("./tests/generic/functions6.php", array("15"));
	$framework->add_output("./tests/generic/functions6.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions7.php");
	$framework->add_output("./tests/generic/functions7.php", array("var1"));
	$framework->add_output("./tests/generic/functions7.php", array("5"));
	$framework->add_output("./tests/generic/functions7.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions8.php");
	$framework->add_output("./tests/generic/functions8.php", array("var1"));
	$framework->add_output("./tests/generic/functions8.php", array("7"));
	$framework->add_output("./tests/generic/functions8.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions9.php");
	$framework->add_output("./tests/generic/functions9.php", array("arr"));
	$framework->add_output("./tests/generic/functions9.php", array("5"));
	$framework->add_output("./tests/generic/functions9.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions10.php");
	$framework->add_output("./tests/generic/functions10.php", array("arr"));
	$framework->add_output("./tests/generic/functions10.php", array("5"));
	$framework->add_output("./tests/generic/functions10.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions11.php");
	$framework->add_output("./tests/generic/functions11.php", array("ret"));
	$framework->add_output("./tests/generic/functions11.php", array("8"));
	$framework->add_output("./tests/generic/functions11.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions12.php");
	$framework->add_output("./tests/generic/functions12.php", array("arr"));
	$framework->add_output("./tests/generic/functions12.php", array("5"));
	$framework->add_output("./tests/generic/functions12.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions13.php");
	$framework->add_output("./tests/generic/functions13.php", array("testf1_return"));
	$framework->add_output("./tests/generic/functions13.php", array("5"));
	$framework->add_output("./tests/generic/functions13.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions14.php");
	$framework->add_output("./tests/generic/functions14.php", array("param"));
	$framework->add_output("./tests/generic/functions14.php", array("0"));
	$framework->add_output("./tests/generic/functions14.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions15.php");
	$framework->add_output("./tests/generic/functions15.php", array("var"));
	$framework->add_output("./tests/generic/functions15.php", array("9"));
	$framework->add_output("./tests/generic/functions15.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functions16.php");
	$framework->add_output("./tests/generic/functions16.php", array("var"));
	$framework->add_output("./tests/generic/functions16.php", array("9"));
	$framework->add_output("./tests/generic/functions16.php", "xss");
	
	$framework->add_testbasis("./tests/generic/functionsrec1.php");
	$framework->add_output("./tests/generic/functionsrec1.php", array("var"));
	$framework->add_output("./tests/generic/functionsrec1.php", array("10"));
	$framework->add_output("./tests/generic/functionsrec1.php", "xss");
	
	$framework->add_testbasis("./tests/generic/condition1.php");
	$framework->add_output("./tests/generic/condition1.php", array("_GET"));
	$framework->add_output("./tests/generic/condition1.php", array("8"));
	$framework->add_output("./tests/generic/condition1.php", "xss");
	/*
	$framework->add_testbasis("./tests/generic/condition2.php");
	$framework->add_output("./tests/generic/condition2.php", array("ret"));
	$framework->add_output("./tests/generic/condition2.php", array("8"));
	$framework->add_output("./tests/generic/condition2.php", "xss");
	
	$framework->add_testbasis("./tests/generic/condition3.php");
	$framework->add_output("./tests/generic/condition3.php", array("ret"));
	$framework->add_output("./tests/generic/condition3.php", array("8"));
	$framework->add_output("./tests/generic/condition3.php", "xss");
	*/
	$framework->add_testbasis("./tests/generic/condition4.php");
	$framework->add_output("./tests/generic/condition4.php", array("blabla"));
	$framework->add_output("./tests/generic/condition4.php", array("3"));
	$framework->add_output("./tests/generic/condition4.php", "xss");

	foreach($framework->get_testbasis() as $file)
	{
		$context = new \progpilot\Context;
		$analyzer = new \progpilot\Analyzer;
		
		$context->inputs->set_sources("./data/sources.json");
		$context->inputs->set_sinks("./data/sinks.json");
		$context->inputs->set_sanitizers("./data/sanitizers.json");
		
		$analyzer->set_file($file);
			
		try 
		{
			$analyzer->run($context);
		}
		catch (Exception $e) 
		{
			echo 'Exception reçue : ',  $e->getMessage(), "\n";
		}
		
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

?>
