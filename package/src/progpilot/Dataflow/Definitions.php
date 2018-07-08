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
use progpilot\Objects\MyDefinition;
use progpilot\Transformations\Php\BuildArrays;

class Definitions
{
    private $in;
    private $out;
    private $outminuskill;
    private $gen;
    private $kill;

    private $defs;
    private $current_func;
    private $nb_defs;

    public function __construct()
    {
        $this->current_func = null;
        $this->nb_defs = 0;
    }

    public function setNbDefs($nb_defs)
    {
        $this->nb_defs = $nb_defs;
    }

    public function getNbDefs()
    {
        return $this->nb_defs;
    }

    public function printAll()
    {
        echo "print gen : \n";
        Definitions::printStdout($this->gen);
        echo "\n";

        echo "print kill : \n";
        Definitions::printStdout($this->kill);
        echo "\n";

        echo "print out : \n";
        Definitions::printStdout($this->out);
        echo "\n";

        echo "print out-kill : \n";
        Definitions::printStdout($this->outminuskill);
        echo "\n";

        echo "print in : \n";
        Definitions::printStdout($this->in);
        echo "\n";
    }

    public static function printBlock($defsparam)
    {
        if (!is_null($defsparam)) {
            foreach ($defsparam as $def) {
                $def->printStdout();
            }
        }
    }

    public static function printStdout($defsparam)
    {
        if (!is_null($defsparam)) {
            foreach ($defsparam as $blockid => $defs) {
                echo "blockid $blockid\n";

                if (!is_null($defs)) {
                    foreach ($defs as $def) {
                        $def->printStdout();
                    }
                }
            }
        }
    }

    public function createBlock($id)
    {
        $this->in[$id] = [];
        $this->out[$id] = [];
        $this->outminuskill[$id] = [];
        $this->gen[$id] = [];
        $this->kill[$id] = [];
    }

    /* getters and setters */
    public function getDefs()
    {
        return $this->defs;
    }

    public function addDef($name, $def)
    {
        $continue = true;
        if (isset($this->defs[$name])) {
            $continue = false;
            if (!in_array($def, $this->defs[$name], true)) {
                $continue = true;
            }
        }

        if ($continue) {
            $this->nb_defs ++;
            $this->defs[$name][] = $def;
        }

        return $continue;
    }

    public function addIn($block, $def)
    {
        if (isset($this->in[$block]) && !in_array($def, $this->in[$block], true)) {
            $this->in[$block][] = $def;
            return true;
        }

        return false;
    }

    public function addOut($block, $def)
    {
        if (isset($this->out[$block]) && !in_array($def, $this->out[$block], true)) {
            $this->out[$block][] = $def;
            return true;
        }

        return false;
    }

    public function addGen($block, $def)
    {
        if (isset($this->gen[$block]) && !in_array($def, $this->gen[$block], true)) {
            $this->gen[$block][] = $def;
            return true;
        }

        return false;
    }

    public function addKill($block, $def)
    {
        if (isset($this->kill[$block]) && !in_array($def, $this->kill[$block], true)) {
            $this->kill[$block][] = $def;
            return true;
        }

        return false;
    }

    public function getKill($block)
    {
        if (isset($this->kill[$block])) {
            return $this->kill[$block];
        }

        return null;
    }

    public function getGen($block)
    {
        if (isset($this->gen[$block])) {
            return $this->gen[$block];
        }

        return null;
    }

    public function getOut($block)
    {
        if (isset($this->out[$block])) {
            return $this->out[$block];
        }

        return null;
    }

    public function getOutMinusKill($block)
    {
        if (isset($this->outminuskill[$block])) {
            return $this->outminuskill[$block];
        }

        return null;
    }

    public function getIn($block)
    {
        if (isset($this->in[$block])) {
            return $this->in[$block];
        }

        return null;
    }

    public function setKill($block, $kill)
    {
        $this->kill[$block] = $kill;
    }

    public function setGen($block, $gen)
    {
        $this->gen[$block] = $gen;
    }

    public function setOut($block, $out)
    {
        $this->out[$block] = $out;
    }

    public function setOutMinusKill($block, $outminuskill)
    {
        $this->outminuskill[$block] = $outminuskill;
    }

    public function setIn($block, $in)
    {
        $this->in[$block] = $in;
    }

    public function getCurrentFunc()
    {
        return $this->current_func;
    }

    public function setCurrentFunc($current_func)
    {
        $this->current_func = $current_func;
    }

    public function getDefRefByName($name)
    {
        if (isset($this->defs[$name])) {
            return $this->defs[$name];
        }

        return null;
    }

    // def1 = def, def2 = defsearch inside resolvedefs function
    public static function defEquality($def1, $def2, $bypass_array = false)
    {
        if ($def1->getName() === $def2->getName()) {
            if ($def1->property->getProperties() !== $def2->property->getProperties()) {
                return false;
            }

            if (($def1->getArrayValue() !== $def2->getArrayValue()) && !$bypass_array) {
                if (($def1->isType(MyDefinition::TYPE_ARRAY) && $def2->isType(MyDefinition::TYPE_ARRAY))) {
                    $extract = BuildArrays::extractArrayFromArr($def1->getArrayValue(), $def2->getArrayValue());

                    if ($extract === false) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }

    // $this->data["gen"][$blockid]
    public function computeKill($context, $blockid)
    {
        foreach ($this->gen[$blockid] as $gen) {
            $tmpdefs = $this->getDefRefByName($gen->getName());
            if (!is_null($tmpdefs)) {
                foreach ($tmpdefs as $def) {
                    if ($this->defEquality($def, $gen)) {
                        if ($def !== $gen && !in_array($def, $this->kill[$blockid], true)) {
                            $this->kill[$blockid][] = $def;
                        }
                    }
                }
            }
        }
    }

    public function reachingDefs($myblocks)
    {
        foreach ($myblocks as $block) {
            $block_id = $block->getId();
            $this->setOutMinusKill($block_id, $this->getGen($block_id));
            $this->setOut($block_id, $this->getGen($block_id));
        }

        $change = true;

        while ($change) {
            $change = false;

            foreach ($myblocks as $id => $block) {
                foreach ($block->parents as $idparent => $parent) {
                    $idcurrent = $block->getId();
                    $idparent = $parent->getId();

                    if ($idcurrent !== $idparent) {
                        $temp = ArrayMulti::arrayMergeMulti($this->getIn($idcurrent), $this->getOut($idparent));
                        $this->setIn($idcurrent, $temp);

                        $oldout = $this->getOut($idcurrent);

                        $inminus = ArrayMulti::arrayMinusMulti($this->getIn($idcurrent), $this->getKill($idcurrent));
                        $this->setOut($idcurrent, ArrayMulti::arrayMergeMulti($this->getGen($idcurrent), $inminus));

                        $this->setOutMinusKill(
                            $idcurrent,
                            ArrayMulti::arrayMergeMulti($this->getGen($idcurrent), $this->getIn($idcurrent))
                        );

                        if ($this->getOut($idcurrent) !== $oldout) {
                            $change = true;
                        }
                    }
                }
            }
        }
    }
}
