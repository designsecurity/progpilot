<?php

require_once './vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class RunAllConfigurationTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testSecurity($configfile, $expectedVulns)
    {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;

        $nbVulns = 0;
        $context->setConfiguration($configfile);
        
        $analyzer->run($context);

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
                            $this->assertContains((int)$oneSourceLine, $vuln["source_line"]);
                        }
                    } else {
                        $this->assertContains($expectedSourceName, $vuln["source_name"]);
                        $this->assertContains((int)$expectedSourceLine, $vuln["source_line"]);
                        $this->assertEquals($expectedVulnName, $vuln["vuln_name"]);
                    }
                } // custom
                else {
                    $this->assertEquals((int)$expectedSourceName, $vuln["vuln_line"]);
                    $this->assertEquals((int)$expectedSourceLine, $vuln["vuln_column"]);
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
        $tabconfig = include("configtest.php");
        
        return array_merge($tabconfig);
    }
}
