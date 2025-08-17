<?php

namespace progpilot\Outputs;

use Bartlett\Sarif\Definition\Message;
use Bartlett\Sarif\Definition\PropertyBag;
use Bartlett\Sarif\Definition\Run;
use Bartlett\Sarif\Definition\ToolComponent;
use Bartlett\Sarif\Definition\Tool;
use Bartlett\Sarif\Definition\Result;
use Bartlett\Sarif\Definition\Location;
use Bartlett\Sarif\Definition\ArtifactLocation;
use Bartlett\Sarif\Definition\PhysicalLocation;
use Bartlett\Sarif\Definition\ThreadFlowLocation;
use Bartlett\Sarif\Definition\Region;
use Bartlett\Sarif\Definition\ThreadFlow;
use Bartlett\Sarif\Definition\CodeFlow;
use Bartlett\Sarif\Definition\ReportingDescriptor;
use Bartlett\Sarif\Definition\MultiformatMessageString;
use Bartlett\Sarif\SarifLog;

class SarifOutput
{
    private $progpilotResults;

    public function __construct($progpilotResults)
    {
        $this->progpilotResults = $progpilotResults;
    }

    private function createRules(): array
    {
        $rules = [
            [
                'id' => 'taint-style',
                'description' => 'https://github.com/designsecurity/progpilot/blob/master/docs/SPECIFY_ANALYSIS.md'
            ],
            [
                'id' => 'custom',
                'description' => 'https://github.com/LioTree/progpilot/blob/master/docs/CUSTOM_ANALYSIS.md'
            ]
        ];

        return array_map(function ($rule) {
            $reportingDescriptor = new ReportingDescriptor();
            $reportingDescriptor->setId($rule['id']);
            $message = new MultiformatMessageString();
            $message->setText($rule['description']);
            $reportingDescriptor->setShortDescription($message);
            return $reportingDescriptor;
        }, $rules);
    }

    private function createTool(): Tool
    {
        $driver = new ToolComponent();
        $driver->setName('progpilot');
        $driver->setInformationUri('https://github.com/designsecurity/progpilot');
        $driver->addRules($this->createRules());

        $tool = new Tool();
        $tool->setDriver($driver);
        return $tool;
    }

    private function createResult(array $progpilotResult): Result
    {
        $result = new Result();
        $result->setRuleId($progpilotResult['vuln_type']);

        if ($progpilotResult['vuln_type'] === 'taint-style') {
            $message = new Message();
            $message->setText(
                "A vulnerability of type {$progpilotResult['vuln_name']} exists at " .
                    "{$progpilotResult['sink_name']} in file {$progpilotResult['sink_file']} " .
                    "at line {$progpilotResult['sink_line']}."
            );
            $result->setMessage($message);

            $propertyBag = new PropertyBag();
            $propertyBag->addProperty('vuln_cwe', $progpilotResult['vuln_cwe']);
            $propertyBag->addProperty('vuln_id', $progpilotResult['vuln_id']);
            $propertyBag->addProperty('vuln_name', $progpilotResult['vuln_name']);
            $result->setProperties($propertyBag);

            $location = $this->createLocation(
                $progpilotResult['sink_file'],
                $progpilotResult['sink_line'],
                $progpilotResult['sink_column'],
                $progpilotResult['sink_name']
            );
            $result->addLocations([$location]);

            $relatedLocations = [];
            foreach ($progpilotResult['source_file'] as $index => $sourceFile) {
                $relatedLocation = $this->createLocation(
                    $sourceFile,
                    $progpilotResult['source_line'][$index],
                    $progpilotResult['source_column'][$index],
                    $progpilotResult['source_name'][$index]
                );
                $relatedLocations[] = $relatedLocation;
            }
            $result->addRelatedLocations($relatedLocations);

            if (isset($progpilotResult['tainted_flow'])) {
                $taintFlow = [];
                foreach ($progpilotResult['tainted_flow'] as $flow) {
                    if (count($flow) > 0) {
                        $flowLocation = $this->createLocation(
                            $flow[0]['flow_file'],
                            $flow[0]['flow_line'],
                            $flow[0]['flow_column'],
                            $flow[0]['flow_name']
                        );
                        $threadFlowLocation = new ThreadFlowLocation();
                        $threadFlowLocation->setLocation($flowLocation);
                        $taintFlow[] = $threadFlowLocation;
                    }
                }
                if (count($taintFlow) > 0) {
                    $threadFlow = new ThreadFlow();
                    $threadFlow->addLocations($taintFlow);
                    $codeFlow = new CodeFlow();
                    $codeFlow->addThreadFlows([$threadFlow]);
                    $result->addCodeFlows([$codeFlow]);
                }
            }
        } elseif ($progpilotResult['vuln_type'] === 'custom') {
            $message = new Message();
            $message->setText($progpilotResult['vuln_description']);
            $result->setMessage($message);

            $propertyBag = new PropertyBag();
            $propertyBag->addProperty('vuln_cwe', $progpilotResult['vuln_cwe']);
            $propertyBag->addProperty('vuln_id', $progpilotResult['vuln_id']);
            $propertyBag->addProperty('vuln_name', $progpilotResult['vuln_name']);
            $propertyBag->addProperty('vuln_rule', $progpilotResult['vuln_rule']);
            $result->setProperties($propertyBag);

            $location = $this->createLocation(
                $progpilotResult['vuln_file'],
                $progpilotResult['vuln_line'],
                $progpilotResult['vuln_column'],
                $progpilotResult['vuln_name']
            );
            $result->addLocations([$location]);
        }

        return $result;
    }

    private function createLocation(string $uri, int $line, int $column, string $name): Location
    {
        $artifactLocation = new ArtifactLocation();
        $artifactLocation->setUri($uri);

        $region = new Region();
        $region->setStartLine($line);
        $region->setStartColumn($column);

        $physicalLocation = new PhysicalLocation();
        $physicalLocation->setArtifactLocation($artifactLocation);
        $physicalLocation->setRegion($region);

        $location = new Location();
        $location->setPhysicalLocation($physicalLocation);

        $message = new Message();
        $message->setText($name);
        $location->setMessage($message);

        return $location;
    }

    public function output(): SarifLog
    {
        $run = new Run();
        $run->setTool($this->createTool());

        $results = array_map([$this, 'createResult'], $this->progpilotResults);
        $run->addResults($results);

        return new SarifLog([$run]);
    }
}
