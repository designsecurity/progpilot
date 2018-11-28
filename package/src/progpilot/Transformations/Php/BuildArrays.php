<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Transformations\Php;

use PHPCfg\Block;
use PHPCfg\Func;
use PHPCfg\Op;
use PHPCfg\Operand;

class BuildArrays
{
    public static function functionStartOps($initops)
    {
        if (isset($initops->ops)) {
            foreach ($initops->ops as $op) {
                if ($op instanceof Op\Expr\ArrayDimFetch) {
                    return BuildArrays::functionStartOps($op->var);
                }
            }
        }
        
        if ($initops instanceof Op\Iterator\Value) {
            return BuildArrays::functionStartOps($initops->var);
        }

        return $initops;
    }

    public static function buildArrayFromArr($start, $end)
    {
        if (is_array($start)) {
            foreach ($start as $ind => $value) {
                $end = array($ind => $end);
                $end = BuildArrays::buildArrayFromArr($value, $end);
            }
        }

        return $end;
    }

    public static function extractArrayFromArr($originalarr, $indarr)
    {
        if ($originalarr === $indarr) {
            return false;
        }

        $arr = $originalarr;

        if (is_array($indarr)) {
            foreach ($indarr as $ind => $value) {
                if (isset($originalarr[$ind])) {
                    if ($originalarr[$ind] === $indarr[$ind]) {
                        return $originalarr[$ind];
                    }

                    $arr = BuildArrays::extractArrayFromArr($originalarr[$ind], $indarr[$ind]);
                } else {
                    $arr = false;
                }
            }
        }

        return $arr;
    }

    public static function buildArrayFromOps($initops, $arr)
    {
        if (isset($initops->ops)) {
            foreach ($initops->ops as $op) {
                if ($op instanceof Op\Expr\ArrayDimFetch) {
                    $ind = 0;
                    if (isset($op->dim->value)) {
                        $ind = $op->dim->value;
                    } elseif (isset($op->dim->ops[0]->name->value)) {
                        $ind = $op->dim->ops[0]->name->value;
                    }

                    $arr = array($ind => $arr);
                    $arr = BuildArrays::buildArrayFromOps($op->var, $arr);
                }
            }
        }

        return $arr;
    }
}
