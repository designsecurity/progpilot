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
use Bartlett\Sarif\SarifLog;

class SarifOutput
{
    private $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    private function createTool(): Tool
    {
        $driver = new ToolComponent();
        $driver->setName('progpilot');
        $driver->setInformationUri('https://github.com/designsecurity/progpilot');

        $tool = new Tool();
        $tool->setDriver($driver);
        return $tool;
    }

    private function createResult(array $progpilotResult): Result
    {
        $result = new Result();

        if ($progpilotResult['vuln_type'] === 'taint-style') {
            $message = new Message();
            $message->setText($progpilotResult['vuln_name']);
            $result->setMessage($message);

            $propertyBag = new PropertyBag();
            $propertyBag->addProperty('vuln_cwe', $progpilotResult['vuln_cwe']);
            $propertyBag->addProperty('vuln_id', $progpilotResult['vuln_id']);
            $propertyBag->addProperty('vuln_type', $progpilotResult['vuln_type']);

            $location = $this->createLocation($progpilotResult['sink_file'], $progpilotResult['sink_line'], $progpilotResult['sink_column'], $progpilotResult['sink_name']);
            $result->setProperties($propertyBag);
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
                $threadFlow = new ThreadFlow();
                $threadFlow->addLocations($taintFlow);
                $codeFlow = new CodeFlow();
                $codeFlow->addThreadFlows([$threadFlow]);
                $result->addCodeFlows([$codeFlow]);
            }
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

    public function transform(): SarifLog
    {
        $run = new Run();
        $run->setTool($this->createTool());

        $results = array_map([$this, 'createResult'], $this->input);
        $run->addResults($results);

        return new SarifLog([$run]);
    }
}
