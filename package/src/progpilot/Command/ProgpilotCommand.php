<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace progpilot\Command;

use progpilot\Context;
use progpilot\Analyzer;
use progpilot\Lang;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProgpilotCommand extends Command
{
    protected $input;
    protected $output;

    protected function configure()
    {
        $this
            ->setName('progpilot')
            ->setDescription(Lang::PROGPILOT_ARG_DESC)
            ->addArgument(
                'files',
                InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
                Lang::FILES_ARG_DESC
            )
            ->addOption(
                'configuration',
                null,
                InputOption::VALUE_REQUIRED,
                Lang::CONFIG_ARG_DESC
            );
    }

    public function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $context = new \progpilot\Context;
        $analyzer = new \progpilot\Analyzer;

        try {
            if (!is_null($input->getOption('configuration'))) {
                $context->setConfiguration($input->getOption('configuration'));
            }

            $cmdFiles = $this->input->getArgument('files');
        
            $analyzer->run($context, $cmdFiles);

            if ($context->getPrettyPrint()) {
                echo json_encode($context->outputs->getResults(), JSON_PRETTY_PRINT);
            } else {
                echo json_encode($context->outputs->getResults());
            }

            if (count($context->outputs->getResults()) > 0) {
                return 1;
            }
        } catch (\Exception $e) {
            echo $e->getMessage()."\n";
            
            if ($context->isDebugMode()) {
                echo "Exception raised on file : ".$e->getFile()." line : ".$e->getLine()."\n";
            }
        }
        
        return 0;
    }
}
