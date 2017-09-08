<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';
$framework = new framework_test;

require_once './vulnsuitetest.php';

try {

	foreach($framework->get_testbasis() as $file)
	{
        $name_file = "./tests/vulntestsuite/".basename($file);
        copy($file, $name_file);
        
        echo "\$framework->add_testbasis(\"$name_file\");\n";
        
		$outputs = $framework->get_output($file);
		foreach($outputs as $output)
		{
            if(is_array($output))
            {
                if($output[0][0] == '$')
                $output = "array(\"\\".$output[0]."\")";
                else
                $output = "array(\"".$output[0]."\")";
            }
            else
                $output = "\"".$output."\"";
                
                
            echo "\$framework->add_output(\"$name_file\", $output);\n";
		}
		
		echo "\n";
	}

} catch (\RuntimeException $e) {
	$result = $e->getMessage();
}

?>
