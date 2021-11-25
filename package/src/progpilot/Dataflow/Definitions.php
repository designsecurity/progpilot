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
    private $currentFunc;
    private $nbDefs;

    public function __construct()
    {
        $this->currentFunc = null;
        $this->nbDefs = 0;
        $this->defs = [];
    }

    public function setNbDefs($nbDefs)
    {
        $this->nbDefs = $nbDefs;
    }

    public function getNbDefs()
    {
        return $this->nbDefs;
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

    public static function printBlock($defsParam)
    {
        if (!is_null($defsParam)) {
            foreach ($defsParam as $def) {
                $def->printStdout();
            }
        }
    }

    public static function printStdout($defsParam)
    {
        if (!is_null($defsParam)) {
            foreach ($defsParam as $blockId => $defs) {
                echo "blockid $blockId\n";

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

    public function getOriginalDef($id)
    {
        if (isset($this->originalDefs[$id])) {
            return $this->originalDefs[$id];
        }

        return null;
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
            $this->nbDefs ++;
            $this->defs[$name][] = $def;
            $this->originalDefs[$def->getId()] = clone $def;
        }
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
        return $this->currentFunc;
    }

    public function setCurrentFunc($currentFunc)
    {
        $this->currentFunc = $currentFunc;
    }

    public function getDefRefByName($name)
    {
        if (isset($this->defs[$name])) {
            return $this->defs[$name];
        }

        return null;
    }

    // def1 = def, def2 = defsearch inside ResolveDefs function
    public static function defEquality($def1, $def2)
    {
        if ($def1->getName() === $def2->getName()) {
            return true;
        }

        return false;
    }

    // $this->data["gen"][$blockId]
    public function computeKill($blockId)
    {
        foreach ($this->gen[$blockId] as $gen) {
            $tmpdefs = $this->getDefRefByName($gen->getName());
            if (!is_null($tmpdefs)) {
                foreach ($tmpdefs as $def) {
                    if ($this->defEquality($def, $gen)) {
                        if ($def !== $gen && !in_array($def, $this->kill[$blockId], true)) {
                            $this->kill[$blockId][] = $def;
                        }
                    }
                }
            }
        }
    }

    public function reachingDefs($myBlocks)
    {
        foreach ($myBlocks as $block) {
            $blockId = $block->getId();
            $this->setOutMinusKill($blockId, $this->getGen($blockId));
            $this->setOut($blockId, $this->getGen($blockId));
        }

        $change = true;

        while ($change) {
            $change = false;

            foreach ($myBlocks as $block) {
                $idcurrent = $block->getId();
                foreach ($block->parents as $idparent => $parent) {
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
