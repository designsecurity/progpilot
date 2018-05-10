<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Representations;

use progpilot\Objects\MyFunction;

class Callgraph
{
        private $nodes;
        private $blocks;

        public function __construct()
        {
            $this->nodes = [];
            $this->blocks = new \SplObjectStorage;
        }

        public function get_nodes()
        {
            return $this->nodes;
        }

        public function new_block($myblock)
        {
            $obj = new \stdClass;
            $obj->calls = [];
            $obj->children = [];

            $this->blocks[$myblock] = $obj;
        }

        public function add_node($myfunc, $myclass)
        {
            $NodeCG = new NodeCG($myfunc->get_name(), $myfunc->getLine(), $myfunc->getColumn(), $myfunc->get_source_myfile()->get_name(), $myclass);

            if (!array_key_exists($NodeCG->get_id(), $this->nodes))
                $this->nodes[$NodeCG->get_id()] = $NodeCG;
        }

        public function add_edge($myfunc_caller, $myclass_caller,  $myfunc_callee, $myclass_callee)
        {
            $NodeCG_caller = new NodeCG($myfunc_caller->get_name(), $myfunc_caller->getLine(), $myfunc_caller->getColumn(), $myfunc_caller->get_source_myfile()->get_name(), $myclass_caller);
            $NodeCG_callee = new NodeCG($myfunc_callee->get_name(), $myfunc_callee->getLine(), $myfunc_callee->getColumn(), $myfunc_callee->get_source_myfile()->get_name(), $myclass_callee);

            if (array_key_exists($NodeCG_caller->get_id(), $this->nodes)
                    && array_key_exists($NodeCG_callee->get_id(), $this->nodes)
                    && $NodeCG_caller->get_id() !== $NodeCG_callee->get_id())
            {
                if (!in_array($NodeCG_callee->get_id(), $this->nodes[$NodeCG_caller->get_id()]->get_children(), true))
                {
                    $storage = $this->nodes[$NodeCG_caller->get_id()]->get_children();
                    $storage[] = $NodeCG_callee->get_id();
                    $this->nodes[$NodeCG_caller->get_id()]->set_children($storage);

                    $this->nodes[$NodeCG_callee->get_id()]->set_nb_parents(
                        $this->nodes[$NodeCG_callee->get_id()]->get_nb_parents() + 1);
                }
            }
        }

        public function add_funccall($myblock, $myfunc, $myclass)
        {
            if (!$this->blocks->contains($myblock))
                $this->new_block($myblock);

            if (!in_array($myfunc, $this->blocks[$myblock]->calls, true))
            {
                $storage = $this->blocks[$myblock]->calls;
                $storage[] = [$myfunc, $myclass];
                $this->blocks[$myblock]->calls = $storage;
            }
        }

        public function add_child($myblock_parent, $myblock_child)
        {
            if ($myblock_parent !== $myblock_child)
            {
                if (!$this->blocks->contains($myblock_parent))
                    $this->new_block($myblock_parent);

                if (!$this->blocks->contains($myblock_child))
                    $this->new_block($myblock_child);

                if (!in_array($myblock_child, $this->blocks[$myblock_parent]->children, true))
                {
                    $storage = $this->blocks[$myblock_parent]->children;
                    $storage[] = $myblock_child;
                    $this->blocks[$myblock_parent]->children = $storage;
                }
            }
        }

        public function get_calls($myblock)
        {
            if ($this->blocks->contains($myblock))
                return $this->blocks[$myblock]->calls;

            return null;
        }

        public function compute_callgraph()
        {
            // transform parents to children
            foreach ($this->blocks as $myblock)
            {
                foreach ($myblock->parents as $parent)
                    $this->add_child($parent, $myblock);
            }

            // handle circular graph like recursive function
            $null_nodes = [];
            // reduce graph
            foreach ($this->blocks as $myblock)
            {
                do
                {
                    $modification = false;
                    $new_children = [];

                    foreach ($this->blocks[$myblock]->children as $child)
                    {
                        if ($myblock !== $child)
                        {
                            $calls_child = $this->get_calls($child);
                            if (is_null($calls_child) || count($calls_child) === 0)
                            {
                                if (!in_array($child, $null_nodes, true))
                                {
                                    $null_nodes[] = $child;
                                    foreach ($this->blocks[$child]->children as $child_far)
                                    {
                                        if (!in_array($child_far, $new_children, true)
                                                && $myblock !== $child_far
                                                                 && $child !== $child_far)
                                        {
                                            $new_children[] = $child_far;
                                            $modification = true;
                                        }
                                    }
                                }
                            }
                            else
                                $new_children[] = $child;
                        }
                    }

                    $this->blocks[$myblock]->children = $new_children;
                }
                while ($modification);
            }

            //calculate nodes
            foreach ($this->blocks as $myblock)
                foreach ($this->blocks[$myblock]->calls as $call)
                    $this->add_node($call[0], $call[1]);

            // calculate edges
            foreach ($this->blocks as $myblock)
            {
                $calls = $this->get_calls($myblock);

                // calculate edges first case : sequential calls
                if (count($calls) > 1)
                {
                    for ($i = 0; $i < count($calls) - 1; $i ++)
                        $this->add_edge($calls[$i][0], $calls[$i][1], $calls[$i + 1][0], $calls[$i + 1][1]);
                }

                // calculate edges second case : calls from parents
                if (count($calls) > 0)
                {
                    $last_call_parent = $calls[count($calls) - 1][0];
                    $last_myclass_parent = $calls[count($calls) - 1][1];
                    foreach ($this->blocks[$myblock]->children as $child)
                    {
                        $calls = $this->get_calls($child);
                        if (!is_null($calls) && count($calls) > 0)
                        {
                            $first_call_child = $calls[0][0];
                            $first_myclass_child = $calls[0][1];
                            $this->add_edge($last_call_parent, $last_myclass_parent, $first_call_child, $first_myclass_child);
                        }
                    }
                }
            }
        }
}

?>
