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

            if (!is_null($input->getOption('configuration')))
                $context->set_configuration($input->getOption('configuration'));

            $cmd_files = $this->input->getArgument('files');
            try
            {
                $analyzer->run($context, $cmd_files);

                if ($context->get_pretty_print())
                    echo json_encode($context->outputs->get_results(), JSON_PRETTY_PRINT);
                else
                    echo json_encode($context->outputs->get_results());
                    
                if(count($context->outputs->get_results()) > 0)
                    return 1;

            }
            catch (Exception $e)
            {
                echo Lang::GLOBAL_ERROR.$e->getMessage()." file : ".$e->getFile()." line : ".$e->getLine()."\n";
            }

        }
}


?>
