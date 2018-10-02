<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Dataflow;

class ArrayMulti
{
    public static function arrayMergeMulti($ar1, $ar2)
    {
        $newar1 = $ar1;

        foreach ($ar2 as $key2 => $value2) {
            $present = false;

            foreach ($ar1 as $key1 => $value1) {
                if ($value1 === $value2) {
                    $present = true;
                    break;
                }
            }

            if (!$present) {
                $newar1[] = $value2;
            }
        }

        return $newar1;
    }

    public static function arrayMinusMulti($ar1, $ar2)
    {
        $newar1 = [];

        foreach ($ar1 as $key1 => $value1) {
            $present = false;

            foreach ($ar2 as $key2 => $value2) {
                if ($value1 === $value2) {
                    $present = true;
                    break;
                }
            }

            if (!$present) {
                $newar1[] = $value1;
            }
        }

        return $newar1;
    }
}
