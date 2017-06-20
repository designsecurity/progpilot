<?php

require_once './vendor/autoload.php';

try {

	$files = array(

			"./tests/generic/alias1.php", 
			"./tests/generic/alias2.php",
			"./tests/generic/alias3.php",
			"./tests/generic/alias4.php",
			"./tests/generic/alias5.php",
			"./tests/generic/mix1.php", 
			"./tests/generic/mix2.php",
			"./tests/generic/mix3.php",
			"./tests/generic/simple1.php",
			"./tests/generic/simple2.php",
			"./tests/generic/simple3.php",
			"./tests/generic/simple4.php",
			"./tests/generic/simple5.php",
			"./tests/generic/concat1.php",
			"./tests/generic/arrays1.php",
			"./tests/generic/arrays2.php",
			"./tests/generic/arrays3.php",
			"./tests/generic/arrays4.php", 
			"./tests/generic/arrays5.php",
			"./tests/generic/arrays6.php",
			"./tests/generic/arrays7.php",
			"./tests/generic/arrays8.php",
			"./tests/generic/arrays9.php",
			"./tests/generic/arrays10.php",
			"./tests/generic/arrays11.php",
			"./tests/generic/arrays12.php",
			"./tests/generic/arrays13.php",
			"./tests/generic/arrays14.php",
			"./tests/generic/arrays15.php",
			"./tests/generic/arraysrec1.php",
			"./tests/generic/arraysexpr1.php",
			"./tests/generic/arraysexpr2.php",
			"./tests/generic/arraysexpr3.php",
			"./tests/generic/functions1.php", 
			"./tests/generic/functions2.php",
			"./tests/generic/functions3.php",
			"./tests/generic/functions4.php",
			"./tests/generic/functions5.php",
			"./tests/generic/functions6.php",
			"./tests/generic/functions7.php", 
			"./tests/generic/functions8.php",
			"./tests/generic/functions9.php",
			"./tests/generic/functions10.php",
			"./tests/generic/functions11.php",
			"./tests/generic/functions12.php",
			"./tests/generic/functions13.php",
			"./tests/generic/functions14.php",
			"./tests/generic/functions15.php",
			"./tests/generic/functions16.php",
			"./tests/generic/functionsrec1.php",
			"./tests/generic/condition1.php",
			//"./tests/generic/condition2.php",
			//"./tests/generic/condition3.php",
			"./tests/generic/condition4.php"
				);

	foreach($files as $file)
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

			if($file == "./tests/generic/mix1.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/mix2.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("9");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/mix3.php")
			{
				$tempsource = array("var2");
				$tempsource_line = array("12");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/alias1.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("9");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/alias2.php")
			{
				$tempsource = array("var6");
				$tempsource_line = array("4");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/alias3.php")
			{
				$tempsource = array("var5", "var6");
				$tempsource_line = array("3", "4");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/alias4.php")
			{
				$tempsource = array("var5");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/alias5.php")
			{
				$tempsource = array("var5");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays1.php")
			{
				$tempsource = array("newmyarr");
				$tempsource_line = array("4");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays2.php")
			{
				$tempsource = array("newmyarr");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays3.php")
			{
				$tempsource = array("newmyarr");
				$tempsource_line = array("4");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays4.php")
			{
				$tempsource = array("newmyarr");
				$tempsource_line = array("4");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays5.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays6.php")
			{
				$tempsource = array("_GET");
				$tempsource_line = array("6");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays7.php")
			{
				$tempsource = array("onearr");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays8.php")
			{
				$tempsource = array("arr");
				$tempsource_line = array("6");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays9.php")
			{
				$tempsource = array("onearr");
				$tempsource_line = array("4");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays10.php")
			{
				$tempsource = array("arr");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays11.php")
			{
				$tempsource = array("arr");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays12.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("9");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays13.php")
			{
				$tempsource = array("_GET");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays14.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("9");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arrays15.php")
			{
				$tempsource = array("var");
				$tempsource_line = array("8");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arraysrec1.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("8");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arraysexpr1.php")
			{
				$tempsource = array("newmyarr");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arraysexpr2.php")
			{
				$tempsource = array("newmyarr");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
				{
					echo "[$file] test result ok\n";
				}
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/arraysexpr3.php")
			{
				$tempsource = array("onearr");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/simple1.php")
			{
				$tempsource = array("myvar1");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/simple2.php")
			{
				$tempsource = array("myvar2");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/simple3.php")
			{
				$tempsource = array("var7");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/simple4.php")
			{
				$tempsource = array("var4");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/simple5.php")
			{
				$tempsource = array("myvar1");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/concat1.php")
			{
				$tempsource = array("myvar7");
				$tempsource_line = array("7");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions1.php")
			{
				$tempsource = array("parama");
				$tempsource_line = array("0");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions2.php")
			{
				$tempsource = array("safea");
				$tempsource_line = array("8");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions3.php")
			{
				$tempsource = array("testf_return");
				$tempsource_line = array("7");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions4.php")
			{
				$tempsource = array("testf_return");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions5.php")
			{
				$tempsource = array("testf_return");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions6.php")
			{
				$tempsource = array("_GET");
				$tempsource_line = array("15");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions7.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions8.php")
			{
				$tempsource = array("var1");
				$tempsource_line = array("7");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions9.php")
			{
				$tempsource = array("arr");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions10.php")
			{
				$tempsource = array("arr");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions11.php")
			{
				$tempsource = array("ret");
				$tempsource_line = array("8");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions12.php")
			{
				$tempsource = array("arr");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions13.php")
			{
				$tempsource = array("testf1_return");
				$tempsource_line = array("5");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions14.php")
			{
				$tempsource = array("param");
				$tempsource_line = array("0");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions15.php")
			{
				$tempsource = array("var");
				$tempsource_line = array("9");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functions16.php")
			{
				$tempsource = array("var");
				$tempsource_line = array("9");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/functionsrec1.php")
			{
				$tempsource = array("var");
				$tempsource_line = array("10");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/condition1.php")
			{
				$tempsource = array("_GET");
				$tempsource_line = array("8");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/condition2.php")
			{
				$tempsource = array("ret");
				$tempsource_line = array("8");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/condition3.php")
			{
				$tempsource = array("ret");
				$tempsource_line = array("8");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
			}
			else if($file == "./tests/generic/condition4.php")
			{
				$tempsource = array("blabla");
				$tempsource_line = array("3");
				if($vuln['vuln_name'] == "xss" && $vuln['source'] == $tempsource && $vuln['source_line'] == $tempsource_line)
					echo "[$file] test result ok\n";
				else
				{
					echo "[$file] test result ko\n";
					var_dump($vuln);
				}
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
