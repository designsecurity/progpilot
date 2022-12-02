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

        $context->outputs->taintedFlow(true);
        
        $nbVulns = 0;
        $context->inputs->setDev(true);
        $context->inputs->setFile($file);
        $analyzer->run($context);

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
