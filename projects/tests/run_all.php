<?php

require_once './vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class RunAllTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testSecurity($file, $expectedVulns)
    {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;

        $context->setAnalyzeHardrules(true);
        $context->setAnalyzeFunctions(false);
        $context->outputs->taintedFlow(true);
        
        $nbVulns = 0;
        $context->inputs->setDev(true);
        $context->inputs->setLanguages(["php", "js"]);
        $context->inputs->setFile($file);
        
        try {
            $analyzer->run($context);
        } catch (Exception $e) {
            echo 'Exception : ',  $e->getMessage(), "\n";
        }

        $results = $context->outputs->getResults();

        foreach ($results as $vuln) {
            if (isset($expectedVulns[$nbVulns])) {
                $expectedSourceName = $expectedVulns[$nbVulns][0];
                $expectedSourceLine = $expectedVulns[$nbVulns][1];
                $expectedVulnName = $expectedVulns[$nbVulns][2];
                
                // taint-style
                if (isset($vuln['source_name']) && isset($vuln['source_line'])) {
                    if (is_array($expectedSourceName) && is_array($expectedSourceLine)) {
                        foreach ($expectedSourceName as $oneSourceName) {
                            $this->assertContains($oneSourceName, $vuln["source_name"]);
                        }
                            
                        foreach ($expectedSourceLine as $oneSourceLine) {
                            $this->assertContains($oneSourceLine, $vuln["source_line"]);
                        }
                    } else {
                        $this->assertContains($expectedSourceName, $vuln["source_name"]);
                        $this->assertContains($expectedSourceLine, $vuln["source_line"]);
                        $this->assertEquals($expectedVulnName, $vuln["vuln_name"]);
                    }
                } // custom
                else {
                    $this->assertEquals($expectedSourceName, $vuln["vuln_line"]);
                    $this->assertEquals($expectedSourceLine, $vuln["vuln_column"]);
                    $this->assertEquals($expectedVulnName, $vuln["vuln_name"]);
                }
            } else {
                $this->assertTrue(false);
            }
            
            $nbVulns ++;
        }
        
        $this->assertCount(count($expectedVulns), $results);
    }

    public function dataProvider()
    {
        $taboop = include("ooptest.php");
        $tabreal = include("realtest.php");
        $tabgen = include("generictest.php");
        $tabinc = include("includetest.php");
        $tabdata = include("datatest.php");
        $tabcond = include("conditionstest.php");
        $tabneg = include("negativetest.php");
        $tabcus = include("customtest.php");
        $tabvulntest = include("testvulntestsuite.php");
        $tabwander = include("phpwandertest.php");
        $tabframeworks = include("frameworkstest.php");
        
        if(extension_loaded("v8js")) {
            $tabtwig = include("twigtest.php");
            $tabjavascript = include("javascripttest.php");
        }
        else {
            $tabtwig = [];
            $tabjavascript = [];
        }
        
        $tab = array_merge(
            $taboop,
            $tabreal,
            $tabgen,
            $tabinc,
            $tabdata,
            $tabcond,
            $tabneg,
            $tabcus,
            $tabvulntest,
            $tabwander,
            $tabframeworks,
            $tabtwig,
            $tabjavascript
        );
        
        return $tab;
    }
}
