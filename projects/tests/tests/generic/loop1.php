<?php


        if ($useStaticLoader) {
            $includeFiles = array(); // block 4
        } else {
            $includeFiles = array($_GET["p"]); // block 28
        }
        foreach ($includeFiles as $fileIdentifier => $file) { // block 10
          echo $file;
        }
