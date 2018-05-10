<?php

function scandir_rec($dir, &$files)
{
    if (is_dir($dir))
    {
        $filesanddirs = scandir($dir);

        if ($filesanddirs !== false)
        {
            foreach ($filesanddirs as $filedir)
            {
                if ($filedir !== '.' && $filedir !== "..")
                {
                    if (is_dir($dir."/".$filedir))
                        scandir_rec($dir."/".$filedir, $files);

                    else
                        $files[] = $dir."/".$filedir;
                }
            }
        }
    }
}

/*
name folder = './IDOR/CWE_862_Fopen/safe' et 31
name folder = './IDOR/CWE_862_Fopen/unsafe' et 31
name folder = './IDOR/CWE_862_SQL/safe' et 287
name folder = './IDOR/CWE_862_SQL/unsafe' et 31
name folder = './IDOR/CWE_862_XPath/safe' et 79
name folder = './IDOR/CWE_862_XPath/unsafe' et 15
name folder = './IDOR' et 0
name folder = './Injection/CWE_78/safe' et 1871
name folder = './Injection/CWE_78/unsafe' et 623
name folder = './Injection/CWE_89/safe' et 8639
name folder = './Injection/CWE_89/unsafe' et 911
name folder = './Injection/CWE_90/safe' et 1728
name folder = './Injection/CWE_90/unsafe' et 2111
name folder = './Injection/CWE_91/safe' et 4783
name folder = './Injection/CWE_91/unsafe' et 1263
name folder = './Injection/CWE_95/safe' et 1295
name folder = './Injection/CWE_95/unsafe' et 335
name folder = './Injection/CWE_98/safe' et 2591
name folder = './Injection/CWE_98/unsafe' et 671
name folder = './Injection' et 0
name folder = '.' et 1
name folder = './SDE/CWE_311/safe' et 1
name folder = './SDE/CWE_311/unsafe' et 1
name folder = './SDE/CWE_327/safe' et 2
name folder = './SDE/CWE_327/unsafe' et 4
name folder = './SDE' et 0
name folder = './SM/CWE_209/safe' et 4
name folder = './SM/CWE_209/unsafe' et 2
name folder = './SM' et 0
name folder = './URF/CWE_601/safe' et 2207
name folder = './URF/CWE_601/unsafe' et 2591
name folder = './URF' et 0
name folder = './XSS/CWE_79/safe' et 5727
name folder = './XSS/CWE_79/unsafe' et 4351
name folder = './XSS' et 0

 */

$folders = [];
$files = [];
scandir_rec(".", $files);

foreach ($files as $file)
{
    $dir = dirname($file);

    if (isset($folders[$dir]))
        $folders[$dir] ++;
    else
        $folders[$dir] = 0;
    /*
    echo "\$framework->add_testbasis(\"$file\");\n";
    echo "\$framework->add_output(\"$file\", array(\"tainted\"));\n";
    echo "\$framework->add_output(\"$file\", array(\"49\"));\n";
    echo "\$framework->add_output(\"$file\", \"file_inclusion\");\n\n";
     */
}



foreach($folders as $name_folder => $nbfile)
{
    echo "name folder = '$name_folder' et $nbfile\n";
}

$nb_files = 0;
foreach ($files as $file)
{
    $dir = dirname($file);

    $ok = false;

    switch ($dir)
    {
    case './Injection/CWE_78/safe': // 1871 => 180
        if (rand() % 10 === 1)
            $ok = true;
        break;
    case './Injection/CWE_78/unsafe': // 623 => 62
        if (rand() % 10 === 1)
            $ok = true;
        break;
    case './Injection/CWE_89/safe': // 8639 => 170
        if (rand() % 50 === 1)
            $ok = true;
        break;
    case './Injection/CWE_89/unsafe': // 911 => 30
        if (rand() % 30 === 1)
            $ok = true;
        break;
    case './Injection/CWE_90/safe': // 1728 => 170
        if (rand() % 10 === 1)
            $ok = true;
        break;
    case './Injection/CWE_90/unsafe': // 2111 => 211
        if (rand() % 10 === 1)
            $ok = true;
        break;
    case './Injection/CWE_91/safe': // 4783 => 119
        if (rand() % 40 === 1)
            $ok = true;
        break;
    case './Injection/CWE_91/unsafe': // 1263 => 50
        if (rand() % 20 === 1)
            $ok = true;
        break;
    case './Injection/CWE_95/safe': // 1295 => 50
        if (rand() % 20 === 1)
            $ok = true;
        break;
    case './Injection/CWE_95/unsafe': // 335 => 30
        if (rand() % 10 === 1)
            $ok = true;
        break;
    case './Injection/CWE_98/safe': // 2591 => 129
        if (rand() % 20 === 1)
            $ok = true;
        break;
    case './Injection/CWE_98/unsafe': // 671 => 67
        if (rand() % 10 === 1)
            $ok = true;
        break;
    case './URF/CWE_601/safe': // 2207 => 100
        if (rand() % 20 === 1)
            $ok = true;
        break;
    case './URF/CWE_601/unsafe': // 2591 => 100
        if (rand() % 20 === 1)
            $ok = true;
        break;
    case './XSS/CWE_79/safe': // 5727 => 190
        if (rand() % 30 === 1)
            $ok = true;
        break;
    case './XSS/CWE_79/unsafe': // 4351 => 145
        if (rand() % 30 === 1)
            $ok = true;
        break;
    default:
        $ok = true;

        break;
    }

    if ($ok)
    {
        $nb_files ++;
        echo "\$framework->add_testbasis(\"$file\");\n";
        echo "\$framework->add_output(\"$file\", array(\"tainted\"));\n";
        echo "\$framework->add_output(\"$file\", array(\"49\"));\n";
        echo "\$framework->add_output(\"$file\", \"file_inclusion\");\n\n";

    }
}

echo "nbfiles '$nb_files'\n";


?>



