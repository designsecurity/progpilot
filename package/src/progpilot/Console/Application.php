<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */

namespace progpilot\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use progpilot\Lang;

class Application extends BaseApplication
{
    const NAME = 'progpilot';
    const VERSION = '1.0.1';

    public function __construct()
    {
        parent::__construct(self::NAME, self::VERSION);
    }

    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        parent::run($input, $output);
    }

    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        // clear out the normal first argument, which is the command name
        $inputDefinition->setArguments();

        return $inputDefinition;
    }

    protected function getCommandName(InputInterface $input)
    {
        return 'progpilot';
    }
}
