<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Inputs;

class MyInclude
{

        private $line;
        private $column;
        private $source_file;
        private $value;

        public function __construct($line, $column, $source_file, $value)
        {

            $this->line = $line;
            $this->column = $column;
            $this->source_file = $source_file;
            $this->value = $value;
        }

        public function get_line()
        {
            return $this->line;
        }

        public function get_column()
        {
            return $this->column;
        }

        public function get_source_file()
        {
            return $this->source_file;
        }

        public function get_value()
        {
            return $this->value;
        }
}

?>
