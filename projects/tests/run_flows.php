<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';
$framework = new framework_test;

require_once './flowstest.php';

try
{

    foreach ($framework->get_testbasis() as $file)
    {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;

        $context->inputs->set_file($file);

        $context->set_analyze_functions(false);
        $context->outputs->tainted_flow(true);

        try
        {
            $analyzer->run($context);
        }
        catch (Exception $e)
        {
            echo 'Exception : ',  $e->getMessage(), "\n";
        }

        $results = $context->outputs->get_results();
        $outputjson = array('results' => $results);
        $parsed_json = $outputjson["results"];

        $result_test = false;

        if (is_array($parsed_json) && count($parsed_json) > 0)
        {
            $output_testbasis = $framework->get_output($file);
            
            foreach ($parsed_json as $vuln)
            {
              $result_test = true;
              foreach ($vuln["tainted_flow"] as $one_tainted_flow)
              {
                foreach ($one_tainted_flow as $one_tainted_flow_value)
                {
                  if (!in_array($one_tainted_flow_value["flow_name"], $output_testbasis, true)
                    || !in_array($one_tainted_flow_value["flow_line"], $output_testbasis, true))
                  {
                      $result_test = false;
                      break;
                  }
                }
              }
            }
        }
        else
        {
            if (count($framework->get_output($file)) == 0)
                $result_test = true;
        }

        if (!$result_test)
        {
            echo "[$file] test result ko\n";
            var_dump($parsed_json);
        }
    }

}
catch (\RuntimeException $e)
{
    $result = $e->getMessage();
}

?>
