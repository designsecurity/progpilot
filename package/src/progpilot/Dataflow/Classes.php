<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

class Classes
{

        private $list_classes;

        public function __construct()
        {

            $this->list_classes = [];
        }

        public function get_list_classes()
        {
            return $this->list_classes;
        }

        public function add_myclass($new_myclass)
        {
            /*
                if (!in_array($myclass, $this->list_classes, true))
                    $this->list_classes[] = $myclass;
            */

            $continue = true;
            foreach ($this->list_classes as $myclass)
            {
                if ($myclass->get_name() === $new_myclass->get_name())
                {
                    $continue = false;
                    break;
                }
            }

            if ($continue)
                $this->list_classes[] = $new_myclass;
        }

        public function get_myclass($name)
        {
            foreach ($this->list_classes as $myclass)
            {
                if ($myclass->get_name() === $name)
                    return $myclass;
            }

            return null;
        }

}

?>
