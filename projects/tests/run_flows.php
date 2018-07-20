<?php

require_once './vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class RunFlowsTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testSecurity($file, $expectedVulns)
    {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;

        $context->inputs->setSources("../../package/src/uptodate_data/sources.json");
        $context->inputs->setSinks("../../package/src/uptodate_data/sinks.json");
        $context->inputs->setSanitizers("../../package/src/uptodate_data/sanitizers.json");
        $context->inputs->setValidators("../../package/src/uptodate_data/validators.json");
        $context->inputs->setCustomRules("../../package/src/uptodate_data/rules.json");

        $context->setAnalyzeHardrules(true);
        $context->setAnalyzeFunctions(false);
        $context->outputs->taintedFlow(true);
        
        $nbVulns = 0;
        $context->inputs->setFile($file);
        
        try {
            $analyzer->run($context);
        } catch (Exception $e) {
            echo 'Exception : ',  $e->getMessage(), "\n";
        }

        $results = $context->outputs->getResults();

        foreach ($results as $vuln) {
            foreach ($vuln["tainted_flow"][0] as $taintedFlow) {
                if (isset($expectedVulns[$nbVulns])) {
                    $expectedSourceName = $expectedVulns[$nbVulns][0];
                    $expectedSourceLine = $expectedVulns[$nbVulns][1];
                        
                    $this->assertEquals($expectedSourceName, $taintedFlow["flow_name"]);
                    $this->assertEquals($expectedSourceLine, $taintedFlow["flow_line"]);
                }
            
                $nbVulns ++;
            }
        }
    }

    public function dataProvider()
    {
        $tab = include("flowstest.php");
        
        return $tab;
    }
}
