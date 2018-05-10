<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';
$framework = new framework_test;

require_once './folderexcludedtest.php';

try
{

    foreach ($framework->get_testbasis() as $folder)
    {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;

        $context->inputs->set_sources("../../package/src/uptodate_data/sources.json");
        $context->inputs->set_sinks("../../package/src/uptodate_data/sinks.json");
        $context->inputs->set_sanitizers("../../package/src/uptodate_data/sanitizers.json");
        $context->inputs->set_validators("../../package/src/uptodate_data/validators.json");
        $context->inputs->set_exclude_files("exclude_files.json");
        $context->inputs->set_folder($folder);

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
            foreach ($parsed_json as $vuln)
            {
                $result_test = true;
                
                if(isset($vuln['source_name']) && isset($vuln['source_line']))
                {
                    $basis_outputs = [
                        $vuln['source_name'],
                        $vuln['source_line'],
                        $vuln['vuln_name']];
                }
                else
                {
                    $basis_outputs = [
                        $vuln['vuln_name'],
                        $vuln['vuln_line'],
                        $vuln['vuln_column']];
                }

                if (!$framework->check_outputs($folder, $basis_outputs, $parsed_json))
                {
                    $result_test = false;
                    break;
                }
            }
        }
        else
        {
            if (count($framework->get_output($folder)) == 0)
                $result_test = true;
        }

        if (!$result_test)
        {
            echo "[$folder] test result ko\n";
            var_dump($parsed_json);
        }
    }

}
catch (\RuntimeException $e)
{
    $result = $e->getMessage();
}

?>
