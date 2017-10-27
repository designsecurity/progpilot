<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

use progpilot\Utils;
use progpilot\Lang;

use PHPCfg\Block;
use progpilot\Objects\MyOp;

class Definitions
{

    private $in;
    private $out;
    private $outminuskill;
    private $gen;
    private $kill;

    private $defs;
    private $current_func;

    public function __construct()
    {
        $this->current_func = null;
    }

    public function printall()
    {
        echo "print gen : \n";
        Definitions::print_stdout($this->gen);
        echo "\n";

        echo "print kill : \n";
        Definitions::print_stdout($this->kill);
        echo "\n";

        echo "print out : \n";
        Definitions::print_stdout($this->out);
        echo "\n";

        echo "print out-kill : \n";
        Definitions::print_stdout($this->outminuskill);
        echo "\n";

        echo "print in : \n";
        Definitions::print_stdout($this->in);
        echo "\n";
    }

    public static function printblock($defsparam)
    {
        if (!is_null($defsparam))
        {
            foreach ($defsparam as $def)
            {
                $def->print_stdout();
            }
        }
    }

    public static function print_stdout($defsparam)
    {
        if (!is_null($defsparam))
        {
            foreach($defsparam as $blockid => $defs)
            {
                echo "blockid $blockid\n";

                if (!is_null($defs))
                {
                    foreach ($defs as $def)
                    {
                        $def->print_stdout();
                    }
                }
            }
        }
    }

    public function create_block($id)
    {
        $this->in[$id] = [];
        $this->out[$id] = [];
        $this->outminuskill[$id] = [];
        $this->gen[$id] = [];
        $this->kill[$id] = [];
    }

    /* getters and setters */
    public function adddef($name, $def)
    {
        $continue = true;
        if (isset($this->defs[$name]))
        {
            $continue = false;
            if (!in_array($def, $this->defs[$name], true))
                $continue = true;
        }

        if ($continue)
            $this->defs[$name][] = $def;

        return $continue;
    }

    public function addin($block, $def)
    {
        if (isset($this->in[$block]) && !in_array($def, $this->in[$block], true))
        {
            $this->in[$block][] = $def;
            return true;
        }

        return false;
    }

    public function addout($block, $def)
    {
        if (isset($this->out[$block]) && !in_array($def, $this->out[$block], true))
        {
            $this->out[$block][] = $def;
            return true;
        }

        return false;
    }

    public function addgen($block, $def)
    {
        if (isset($this->gen[$block]) && !in_array($def, $this->gen[$block], true))
        {
            $this->gen[$block][] = $def;
            return true;
        }

        return false;
    }

    public function addkill($block, $def)
    {
        if (isset($this->kill[$block]) && !in_array($def, $this->kill[$block], true))
        {
            $this->kill[$block][] = $def;
            return true;
        }

        return false;
    }

    public function getkill($block)
    {
        if (isset($this->kill[$block]))
            return $this->kill[$block];

        return null;
    }

    public function getgen($block)
    {
        if (isset($this->gen[$block]))
            return $this->gen[$block];

        return null;
    }

    public function getout($block)
    {
        if (isset($this->out[$block]))
            return $this->out[$block];

        return null;
    }

    public function getoutminuskill($block)
    {
        if (isset($this->outminuskill[$block]))
            return $this->outminuskill[$block];

        return null;
    }

    public function getin($block)
    {
        if (isset($this->in[$block]))
            return $this->in[$block];

        return null;
    }

    public function setkill($block, $kill)
    {
        $this->kill[$block] = $kill;
    }

    public function setgen($block, $gen)
    {
        $this->gen[$block] = $gen;
    }

    public function setout($block, $out)
    {
        $this->out[$block] = $out;
    }

    public function setoutminuskill($block, $outminuskill)
    {
        $this->outminuskill[$block] = $outminuskill;
    }

    public function setin($block, $in)
    {
        $this->in[$block] = $in;
    }

    public function get_current_func()
    {
        return $this->current_func;
    }

    public function set_current_func($current_func)
    {
        $this->current_func = $current_func;
    }

    public function getdefrefbyname($name)
    {
        if (isset($this->defs[$name]))
            return $this->defs[$name];

        return null;
    }

    // $def1 = all, $def2 = gen
    public function def_equality($def1, $def2)
    {
        if ($def1->get_name() === $def2->get_name())
        {
            if ($def1->property->get_properties() !== $def2->property->get_properties())
                return false;

            if ($def1->get_array_value() !== $def2->get_array_value())
                return false;

            if ($def1->get_is_property() != $def2->get_is_property())
                return false;

            if ($def1->get_is_instance() != $def2->get_is_instance())
                return false;

            if ($def1->get_is_array() != $def2->get_is_array())
                return false;

            if ($def1->get_is_copy_array() != $def2->get_is_copy_array())
                return false;


            return true;
        }

        return false;
    }

    // $this->data["gen"][$blockid]
    public function computekill($context, $blockid)
    {
        if (count($this->gen[$blockid]) > $context->get_limit_defs())
        {
            Utils::print_warning($context, Lang::MAX_DEFS_EXCEEDED);
            return;
        }

        foreach ($this->gen[$blockid] as $gen)
        {
            $tmpdefs = $this->getdefrefbyname($gen->get_name());
            if (!is_null($tmpdefs))
            {
                foreach ($tmpdefs as $def)
                {
                    if ($this->def_equality($def, $gen))
                    {
                        if ($def !== $gen && !in_array($def, $this->kill[$blockid], true))
                            $this->kill[$blockid][] = $def;
                    }
                }
            }
        }
    }

    public function reachingDefs($myblocks)
    {
        foreach ($myblocks as $block)
        {
            $block_id = $block->get_id();
            $this->setoutminuskill($block_id, $this->getgen($block_id));
            $this->setout($block_id, $this->getgen($block_id));
        }

        $change = true;

        while ($change)
        {
            $change = false;

            foreach($myblocks as $id => $block)
            {
                foreach($block->parents as $idparent => $parent)
                {
                    $idcurrent = $block->get_id();
                    $idparent = $parent->get_id();

                    if ($idcurrent != $idparent)
                    {
                        $temp = ArrayMulti::array_merge_multi($this->getin($idcurrent), $this->getout($idparent));
                        $this->setin($idcurrent, $temp);

                        $oldout = $this->getout($idcurrent);

                        $inminus = ArrayMulti::array_minus_multi($this->getin($idcurrent), $this->getkill($idcurrent));
                        $this->setout($idcurrent, ArrayMulti::array_merge_multi($this->getgen($idcurrent), $inminus));

                        $this->setoutminuskill($idcurrent, ArrayMulti::array_merge_multi($this->getgen($idcurrent), $this->getin($idcurrent)));

                        if ($this->getout($idcurrent) != $oldout)
                            $change = true;
                    }
                }
            }
        }
    }
}

?>
