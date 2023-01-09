<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot\Objects;

class MyFile extends MyOp
{
    private $includedFromMyFile;
    private $includedToMyFile;
    public $baseDir;
    public $fileName;

    public function __construct($fullPathFileName, $baseDir, $fakeLine, $fakeColumn)
    {
        parent::__construct($fullPathFileName, $fakeLine, $fakeColumn);
        $this->baseDir = $baseDir;
        $this->fileName = substr($fullPathFileName, strlen($baseDir) + 1); 
    }

    public function setIncludedToMyfile($myFileTo)
    {
        $this->includedToMyFile = $myFileTo;
    }

    public function getIncludedToMyfile()
    {
        return $this->includedToMyFile;
    }

    public function setIncludedFromMyfile($myFileFrom)
    {
        $this->includedFromMyFile = $myFileFrom;
    }

    public function getIncludedFromMyfile()
    {
        return $this->includedFromMyFile;
    }

    public function printStdout($context = null)
    {
        echo "file ".$this->getName()."\n";
        $includeFile = $this->getIncludedFromMyfile();
        while (!is_null($includeFile)) {
            echo "included from ".$includeFile->getName()."\n";
            $includeFile = $includeFile->getIncludedFromMyfile();
        }
        $includeFile = $this->getIncludedToMyfile();
        while (!is_null($includeFile)) {
            echo "included to ".$includeFile->getName()."\n";
            $includeFile = $includeFile->getIncludedToMyfile();
        }
    }
}
