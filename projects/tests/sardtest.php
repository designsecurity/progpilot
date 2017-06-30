<?php

require_once './vendor/autoload.php';
require_once './framework_test.php';

function scandir_rec($dir, &$files)
{
	if(is_dir($dir))
	{
		$filesanddirs = scandir($dir);
		
		if($filesanddirs != false)
		{
			foreach($filesanddirs as $filedir)
			{
				if($filedir != '.' && $filedir != "..")
				{
					if(is_dir($dir."/".$filedir))
						scandir_rec($dir."/".$filedir, $files);
					
					else
						$files[] = $dir."/".$filedir;
				}
			}
		}
	}
}


try {
	
		
	$framework = new framework_test;
			
			
    $framework->add_testbasis("./tests/sard/000/CWE_98__backticks__whitelist_using_array__require_file_name-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/000/CWE_98__backticks__whitelist_using_array__require_file_name-concatenation_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/000/CWE_98__backticks__whitelist_using_array__require_file_name-concatenation_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/000/CWE_98__backticks__whitelist_using_array__require_file_name-concatenation_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/001/CWE_98__backticks__whitelist_using_array__include_file_name-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/001/CWE_98__backticks__whitelist_using_array__include_file_name-interpretation_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/001/CWE_98__backticks__whitelist_using_array__include_file_name-interpretation_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/001/CWE_98__backticks__whitelist_using_array__include_file_name-interpretation_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/002/CWE_98__backticks__whitelist_using_array__require_file_name-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/002/CWE_98__backticks__whitelist_using_array__require_file_name-interpretation_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/002/CWE_98__backticks__whitelist_using_array__require_file_name-interpretation_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/002/CWE_98__backticks__whitelist_using_array__require_file_name-interpretation_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/003/CWE_98__backticks__whitelist_using_array__include_file_name-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/003/CWE_98__backticks__whitelist_using_array__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/003/CWE_98__backticks__whitelist_using_array__include_file_name-sprintf_%s_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/003/CWE_98__backticks__whitelist_using_array__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");
    
    $framework->add_testbasis("./tests/sard/004/CWE_98__backticks__whitelist_using_array__require_file_name-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/004/CWE_98__backticks__whitelist_using_array__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/004/CWE_98__backticks__whitelist_using_array__require_file_name-sprintf_%s_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/004/CWE_98__backticks__whitelist_using_array__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");



    $framework->add_testbasis("./tests/sard/005/CWE_98__backticks__whitelist_using_array__include_file_id-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/005/CWE_98__backticks__whitelist_using_array__include_file_id-concatenation_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/005/CWE_98__backticks__whitelist_using_array__include_file_id-concatenation_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/005/CWE_98__backticks__whitelist_using_array__include_file_id-concatenation_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/006/CWE_98__backticks__whitelist_using_array__require_file_id-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/006/CWE_98__backticks__whitelist_using_array__require_file_id-concatenation_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/006/CWE_98__backticks__whitelist_using_array__require_file_id-concatenation_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/006/CWE_98__backticks__whitelist_using_array__require_file_id-concatenation_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/007/CWE_98__backticks__whitelist_using_array__include_file_id-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/007/CWE_98__backticks__whitelist_using_array__include_file_id-interpretation_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/007/CWE_98__backticks__whitelist_using_array__include_file_id-interpretation_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/007/CWE_98__backticks__whitelist_using_array__include_file_id-interpretation_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/008/CWE_98__backticks__whitelist_using_array__require_file_id-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/008/CWE_98__backticks__whitelist_using_array__require_file_id-interpretation_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/008/CWE_98__backticks__whitelist_using_array__require_file_id-interpretation_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/008/CWE_98__backticks__whitelist_using_array__require_file_id-interpretation_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/009/CWE_98__backticks__whitelist_using_array__include_file_id-sprintf_%d_simple_quote.php");
    $framework->add_output("./tests/sard/009/CWE_98__backticks__whitelist_using_array__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/009/CWE_98__backticks__whitelist_using_array__include_file_id-sprintf_%d_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/009/CWE_98__backticks__whitelist_using_array__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/010/CWE_98__backticks__whitelist_using_array__require_file_id-sprintf_%d_simple_quote.php");
    $framework->add_output("./tests/sard/010/CWE_98__backticks__whitelist_using_array__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
    $framework->add_output("./tests/sard/010/CWE_98__backticks__whitelist_using_array__require_file_id-sprintf_%d_simple_quote.php", array("49"));
    $framework->add_output("./tests/sard/010/CWE_98__backticks__whitelist_using_array__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

    $framework->add_testbasis("./tests/sard/011/CWE_95__backticks__whitelist_using_array__echo-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/011/CWE_95__backticks__whitelist_using_array__echo-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/011/CWE_95__backticks__whitelist_using_array__echo-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/011/CWE_95__backticks__whitelist_using_array__echo-concatenation_simple_quote.php", "code_injection");
    
    $framework->add_testbasis("./tests/sard/012/CWE_95__backticks__whitelist_using_array__echo-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/012/CWE_95__backticks__whitelist_using_array__echo-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/012/CWE_95__backticks__whitelist_using_array__echo-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/012/CWE_95__backticks__whitelist_using_array__echo-interpretation_simple_quote.php", "code_injection");

    $framework->add_testbasis("./tests/sard/013/CWE_95__backticks__whitelist_using_array__echo-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/013/CWE_95__backticks__whitelist_using_array__echo-sprintf_%s_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/013/CWE_95__backticks__whitelist_using_array__echo-sprintf_%s_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/013/CWE_95__backticks__whitelist_using_array__echo-sprintf_%s_simple_quote.php", "code_injection");

    $framework->add_testbasis("./tests/sard/014/CWE_95__backticks__whitelist_using_array__variable-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/014/CWE_95__backticks__whitelist_using_array__variable-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/014/CWE_95__backticks__whitelist_using_array__variable-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/014/CWE_95__backticks__whitelist_using_array__variable-concatenation_simple_quote.php", "code_injection");

    $framework->add_testbasis("./tests/sard/015/CWE_95__backticks__whitelist_using_array__variable-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/015/CWE_95__backticks__whitelist_using_array__variable-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/015/CWE_95__backticks__whitelist_using_array__variable-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/015/CWE_95__backticks__whitelist_using_array__variable-interpretation_simple_quote.php", "code_injection");

    $framework->add_testbasis("./tests/sard/016/CWE_95__backticks__whitelist_using_array__variable-sprintf_%d_simple_quote.php");
    $framework->add_output("./tests/sard/016/CWE_95__backticks__whitelist_using_array__variable-sprintf_%d_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/016/CWE_95__backticks__whitelist_using_array__variable-sprintf_%d_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/016/CWE_95__backticks__whitelist_using_array__variable-sprintf_%d_simple_quote.php", "code_injection");

    $framework->add_testbasis("./tests/sard/017/CWE_78__backticks__whitelist_using_array__ls-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/017/CWE_78__backticks__whitelist_using_array__ls-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/017/CWE_78__backticks__whitelist_using_array__ls-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/017/CWE_78__backticks__whitelist_using_array__ls-concatenation_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/018/CWE_78__backticks__whitelist_using_array__ls-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/018/CWE_78__backticks__whitelist_using_array__ls-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/018/CWE_78__backticks__whitelist_using_array__ls-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/018/CWE_78__backticks__whitelist_using_array__ls-interpretation_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/019/CWE_78__backticks__whitelist_using_array__ls-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/019/CWE_78__backticks__whitelist_using_array__ls-sprintf_%s_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/019/CWE_78__backticks__whitelist_using_array__ls-sprintf_%s_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/019/CWE_78__backticks__whitelist_using_array__ls-sprintf_%s_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/020/CWE_78__backticks__whitelist_using_array__find_size-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/020/CWE_78__backticks__whitelist_using_array__find_size-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/020/CWE_78__backticks__whitelist_using_array__find_size-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/020/CWE_78__backticks__whitelist_using_array__find_size-concatenation_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/021/CWE_78__backticks__whitelist_using_array__find_size-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/021/CWE_78__backticks__whitelist_using_array__find_size-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/021/CWE_78__backticks__whitelist_using_array__find_size-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/021/CWE_78__backticks__whitelist_using_array__find_size-interpretation_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/022/CWE_78__backticks__whitelist_using_array__find_size-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/022/CWE_78__backticks__whitelist_using_array__find_size-sprintf_%s_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/022/CWE_78__backticks__whitelist_using_array__find_size-sprintf_%s_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/022/CWE_78__backticks__whitelist_using_array__find_size-sprintf_%s_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/023/CWE_78__backticks__whitelist_using_array__cat-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/023/CWE_78__backticks__whitelist_using_array__cat-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/023/CWE_78__backticks__whitelist_using_array__cat-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/023/CWE_78__backticks__whitelist_using_array__cat-concatenation_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/024/CWE_78__backticks__whitelist_using_array__cat-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/024/CWE_78__backticks__whitelist_using_array__cat-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/024/CWE_78__backticks__whitelist_using_array__cat-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/024/CWE_78__backticks__whitelist_using_array__cat-interpretation_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/025/CWE_78__backticks__whitelist_using_array__cat-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/025/CWE_78__backticks__whitelist_using_array__cat-sprintf_%s_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/025/CWE_78__backticks__whitelist_using_array__cat-sprintf_%s_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/025/CWE_78__backticks__whitelist_using_array__cat-sprintf_%s_simple_quote.php", "command_injection");

    $framework->add_testbasis("./tests/sard/026/CWE_90__backticks__whitelist_using_array__name-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/026/CWE_90__backticks__whitelist_using_array__name-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/026/CWE_90__backticks__whitelist_using_array__name-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/026/CWE_90__backticks__whitelist_using_array__name-concatenation_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/027/CWE_90__backticks__whitelist_using_array__name-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/027/CWE_90__backticks__whitelist_using_array__name-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/027/CWE_90__backticks__whitelist_using_array__name-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/027/CWE_90__backticks__whitelist_using_array__name-interpretation_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/028/CWE_90__backticks__whitelist_using_array__name-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/028/CWE_90__backticks__whitelist_using_array__name-sprintf_%s_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/028/CWE_90__backticks__whitelist_using_array__name-sprintf_%s_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/028/CWE_90__backticks__whitelist_using_array__name-sprintf_%s_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/029/CWE_90__backticks__whitelist_using_array__not_name-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/029/CWE_90__backticks__whitelist_using_array__not_name-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/029/CWE_90__backticks__whitelist_using_array__not_name-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/029/CWE_90__backticks__whitelist_using_array__not_name-concatenation_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/030/CWE_90__backticks__whitelist_using_array__not_name-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/030/CWE_90__backticks__whitelist_using_array__not_name-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/030/CWE_90__backticks__whitelist_using_array__not_name-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/030/CWE_90__backticks__whitelist_using_array__not_name-interpretation_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/031/CWE_90__backticks__whitelist_using_array__not_name-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/031/CWE_90__backticks__whitelist_using_array__not_name-sprintf_%s_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/031/CWE_90__backticks__whitelist_using_array__not_name-sprintf_%s_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/031/CWE_90__backticks__whitelist_using_array__not_name-sprintf_%s_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/032/CWE_90__backticks__whitelist_using_array__userByCN-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/032/CWE_90__backticks__whitelist_using_array__userByCN-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/032/CWE_90__backticks__whitelist_using_array__userByCN-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/032/CWE_90__backticks__whitelist_using_array__userByCN-concatenation_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/033/CWE_90__backticks__whitelist_using_array__userByCN-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/033/CWE_90__backticks__whitelist_using_array__userByCN-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/033/CWE_90__backticks__whitelist_using_array__userByCN-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/033/CWE_90__backticks__whitelist_using_array__userByCN-interpretation_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/034/CWE_90__backticks__whitelist_using_array__userByCN-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/034/CWE_90__backticks__whitelist_using_array__userByCN-sprintf_%s_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/034/CWE_90__backticks__whitelist_using_array__userByCN-sprintf_%s_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/034/CWE_90__backticks__whitelist_using_array__userByCN-sprintf_%s_simple_quote.php", "ldap_injection");
   
    $framework->add_testbasis("./tests/sard/035/CWE_90__backticks__whitelist_using_array__userByMail-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/035/CWE_90__backticks__whitelist_using_array__userByMail-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/035/CWE_90__backticks__whitelist_using_array__userByMail-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/035/CWE_90__backticks__whitelist_using_array__userByMail-concatenation_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/036/CWE_90__backticks__whitelist_using_array__userByMail-interpretation_simple_quote.php");
    $framework->add_output("./tests/sard/036/CWE_90__backticks__whitelist_using_array__userByMail-interpretation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/036/CWE_90__backticks__whitelist_using_array__userByMail-interpretation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/036/CWE_90__backticks__whitelist_using_array__userByMail-interpretation_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/037/CWE_90__backticks__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php");
    $framework->add_output("./tests/sard/037/CWE_90__backticks__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/037/CWE_90__backticks__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/037/CWE_90__backticks__whitelist_using_array__userByMail-sprintf_%s_simple_quote.php", "ldap_injection");

    $framework->add_testbasis("./tests/sard/038/CWE_89__backticks__whitelist_using_array__select_from-concatenation_simple_quote.php");
    $framework->add_output("./tests/sard/038/CWE_89__backticks__whitelist_using_array__select_from-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/038/CWE_89__backticks__whitelist_using_array__select_from-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/038/CWE_89__backticks__whitelist_using_array__select_from-concatenation_simple_quote.php", "xss");
    
    $framework->add_output("./tests/sard/038/CWE_89__backticks__whitelist_using_array__select_from-concatenation_simple_quote.php", array("query"));
    $framework->add_output("./tests/sard/038/CWE_89__backticks__whitelist_using_array__select_from-concatenation_simple_quote.php", array("54"));
    $framework->add_output("./tests/sard/038/CWE_89__backticks__whitelist_using_array__select_from-concatenation_simple_quote.php", "sql_injection");

    /*
$framework->add_testbasis("./tests/sard/039/CWE_89__backticks__whitelist_using_array__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/039/CWE_89__backticks__whitelist_using_array__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/039/CWE_89__backticks__whitelist_using_array__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/039/CWE_89__backticks__whitelist_using_array__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/040/CWE_89__backticks__whitelist_using_array__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/040/CWE_89__backticks__whitelist_using_array__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/040/CWE_89__backticks__whitelist_using_array__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/040/CWE_89__backticks__whitelist_using_array__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/041/CWE_89__backticks__whitelist_using_array__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/041/CWE_89__backticks__whitelist_using_array__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/041/CWE_89__backticks__whitelist_using_array__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/041/CWE_89__backticks__whitelist_using_array__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/042/CWE_89__backticks__whitelist_using_array__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/042/CWE_89__backticks__whitelist_using_array__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/042/CWE_89__backticks__whitelist_using_array__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/042/CWE_89__backticks__whitelist_using_array__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/043/CWE_89__backticks__whitelist_using_array__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/043/CWE_89__backticks__whitelist_using_array__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/043/CWE_89__backticks__whitelist_using_array__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/043/CWE_89__backticks__whitelist_using_array__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/044/CWE_89__backticks__whitelist_using_array__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/044/CWE_89__backticks__whitelist_using_array__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/044/CWE_89__backticks__whitelist_using_array__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/044/CWE_89__backticks__whitelist_using_array__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/045/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/045/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/045/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/045/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/046/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/046/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/046/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/046/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/047/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/047/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/047/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/047/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/048/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/048/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/048/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/048/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/049/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/049/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/049/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/049/CWE_89__backticks__whitelist_using_array__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/050/CWE_89__backticks__whitelist_using_array__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/050/CWE_89__backticks__whitelist_using_array__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/050/CWE_89__backticks__whitelist_using_array__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/050/CWE_89__backticks__whitelist_using_array__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/051/CWE_89__backticks__whitelist_using_array__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/051/CWE_89__backticks__whitelist_using_array__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/051/CWE_89__backticks__whitelist_using_array__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/051/CWE_89__backticks__whitelist_using_array__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/052/CWE_89__backticks__whitelist_using_array__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/052/CWE_89__backticks__whitelist_using_array__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/052/CWE_89__backticks__whitelist_using_array__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/052/CWE_89__backticks__whitelist_using_array__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/053/CWE_89__backticks__whitelist_using_array__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/053/CWE_89__backticks__whitelist_using_array__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/053/CWE_89__backticks__whitelist_using_array__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/053/CWE_89__backticks__whitelist_using_array__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/054/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/054/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/054/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/054/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/055/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/055/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/055/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/055/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/056/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/056/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/056/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/056/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/057/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/057/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/057/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/057/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/058/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/058/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/058/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/058/CWE_89__backticks__whitelist_using_array__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/059/CWE_89__backticks__whitelist_using_array__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/059/CWE_89__backticks__whitelist_using_array__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/059/CWE_89__backticks__whitelist_using_array__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/059/CWE_89__backticks__whitelist_using_array__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/060/CWE_89__backticks__whitelist_using_array__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/060/CWE_89__backticks__whitelist_using_array__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/060/CWE_89__backticks__whitelist_using_array__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/060/CWE_89__backticks__whitelist_using_array__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/061/CWE_89__backticks__whitelist_using_array__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/061/CWE_89__backticks__whitelist_using_array__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/061/CWE_89__backticks__whitelist_using_array__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/061/CWE_89__backticks__whitelist_using_array__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/062/CWE_89__backticks__whitelist_using_array__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/062/CWE_89__backticks__whitelist_using_array__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/062/CWE_89__backticks__whitelist_using_array__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/062/CWE_89__backticks__whitelist_using_array__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/063/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/063/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/063/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/063/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/064/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/064/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/064/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/064/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/065/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/065/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/065/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/065/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/066/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/066/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/066/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/066/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/067/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/067/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/067/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/067/CWE_89__backticks__whitelist_using_array__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/068/CWE_89__backticks__whitelist_using_array__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/068/CWE_89__backticks__whitelist_using_array__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/068/CWE_89__backticks__whitelist_using_array__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/068/CWE_89__backticks__whitelist_using_array__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/069/CWE_89__backticks__whitelist_using_array__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/069/CWE_89__backticks__whitelist_using_array__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/069/CWE_89__backticks__whitelist_using_array__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/069/CWE_89__backticks__whitelist_using_array__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/070/CWE_89__backticks__whitelist_using_array__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/070/CWE_89__backticks__whitelist_using_array__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/070/CWE_89__backticks__whitelist_using_array__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/070/CWE_89__backticks__whitelist_using_array__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/071/CWE_91__backticks__whitelist_using_array__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/071/CWE_91__backticks__whitelist_using_array__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/071/CWE_91__backticks__whitelist_using_array__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/071/CWE_91__backticks__whitelist_using_array__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/072/CWE_91__backticks__whitelist_using_array__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/072/CWE_91__backticks__whitelist_using_array__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/072/CWE_91__backticks__whitelist_using_array__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/072/CWE_91__backticks__whitelist_using_array__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/073/CWE_91__backticks__whitelist_using_array__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/073/CWE_91__backticks__whitelist_using_array__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/073/CWE_91__backticks__whitelist_using_array__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/073/CWE_91__backticks__whitelist_using_array__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/074/CWE_91__backticks__whitelist_using_array__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/074/CWE_91__backticks__whitelist_using_array__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/074/CWE_91__backticks__whitelist_using_array__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/074/CWE_91__backticks__whitelist_using_array__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/075/CWE_91__backticks__whitelist_using_array__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/075/CWE_91__backticks__whitelist_using_array__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/075/CWE_91__backticks__whitelist_using_array__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/075/CWE_91__backticks__whitelist_using_array__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/076/CWE_91__backticks__whitelist_using_array__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/076/CWE_91__backticks__whitelist_using_array__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/076/CWE_91__backticks__whitelist_using_array__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/076/CWE_91__backticks__whitelist_using_array__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/077/CWE_91__backticks__whitelist_using_array__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/077/CWE_91__backticks__whitelist_using_array__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/077/CWE_91__backticks__whitelist_using_array__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/077/CWE_91__backticks__whitelist_using_array__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/078/CWE_91__backticks__whitelist_using_array__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/078/CWE_91__backticks__whitelist_using_array__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/078/CWE_91__backticks__whitelist_using_array__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/078/CWE_91__backticks__whitelist_using_array__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/079/CWE_91__backticks__whitelist_using_array__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/079/CWE_91__backticks__whitelist_using_array__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/079/CWE_91__backticks__whitelist_using_array__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/079/CWE_91__backticks__whitelist_using_array__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/080/CWE_91__backticks__whitelist_using_array__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/080/CWE_91__backticks__whitelist_using_array__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/080/CWE_91__backticks__whitelist_using_array__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/080/CWE_91__backticks__whitelist_using_array__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/081/CWE_91__backticks__whitelist_using_array__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/081/CWE_91__backticks__whitelist_using_array__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/081/CWE_91__backticks__whitelist_using_array__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/081/CWE_91__backticks__whitelist_using_array__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/082/CWE_91__backticks__whitelist_using_array__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/082/CWE_91__backticks__whitelist_using_array__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/082/CWE_91__backticks__whitelist_using_array__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/082/CWE_91__backticks__whitelist_using_array__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/083/CWE_91__backticks__whitelist_using_array__ID_test-concatenation.php");
$framework->add_output("./tests/sard/083/CWE_91__backticks__whitelist_using_array__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/083/CWE_91__backticks__whitelist_using_array__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/083/CWE_91__backticks__whitelist_using_array__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/084/CWE_91__backticks__whitelist_using_array__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/084/CWE_91__backticks__whitelist_using_array__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/084/CWE_91__backticks__whitelist_using_array__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/084/CWE_91__backticks__whitelist_using_array__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/085/CWE_91__backticks__whitelist_using_array__ID_test-interpretation.php");
$framework->add_output("./tests/sard/085/CWE_91__backticks__whitelist_using_array__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/085/CWE_91__backticks__whitelist_using_array__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/085/CWE_91__backticks__whitelist_using_array__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/086/CWE_91__backticks__whitelist_using_array__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/086/CWE_91__backticks__whitelist_using_array__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/086/CWE_91__backticks__whitelist_using_array__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/086/CWE_91__backticks__whitelist_using_array__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/087/CWE_91__backticks__whitelist_using_array__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/087/CWE_91__backticks__whitelist_using_array__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/087/CWE_91__backticks__whitelist_using_array__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/087/CWE_91__backticks__whitelist_using_array__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/088/CWE_91__backticks__whitelist_using_array__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/088/CWE_91__backticks__whitelist_using_array__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/088/CWE_91__backticks__whitelist_using_array__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/088/CWE_91__backticks__whitelist_using_array__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/089/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/089/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/089/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/089/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/090/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/090/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/090/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/090/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/091/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/091/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/091/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/091/CWE_91__backticks__whitelist_using_array__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/092/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/092/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/092/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/092/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/093/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/093/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/093/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/093/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/094/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/094/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/094/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/094/CWE_90__backticks__func_preg_replace_ldap_char_white_list__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/095/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/095/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/095/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/095/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/096/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/096/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/096/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/096/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/097/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/097/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/097/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/097/CWE_90__backticks__func_preg_replace_ldap_char_white_list__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/098/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/098/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/098/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/098/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/099/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/099/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/099/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/099/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/100/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/100/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/100/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/100/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/101/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/101/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/101/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/101/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/102/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/102/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/102/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/102/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/103/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/103/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/103/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/103/CWE_90__backticks__func_preg_replace_ldap_char_white_list__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/104/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/104/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/104/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/104/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/105/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/105/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/105/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/105/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/106/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/106/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/106/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/106/CWE_90__backticks__func_str_replace_ldap_char_black_list__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/107/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/107/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/107/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/107/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/108/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/108/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/108/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/108/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/109/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/109/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/109/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/109/CWE_90__backticks__func_str_replace_ldap_char_black_list__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/110/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/110/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/110/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/110/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/111/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/111/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/111/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/111/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/112/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/112/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/112/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/112/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/113/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/113/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/113/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/113/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/114/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/114/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/114/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/114/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/115/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/115/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/115/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/115/CWE_90__backticks__func_str_replace_ldap_char_black_list__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/116/CWE_90__backticks__func_pg_escape_literal__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/116/CWE_90__backticks__func_pg_escape_literal__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/116/CWE_90__backticks__func_pg_escape_literal__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/116/CWE_90__backticks__func_pg_escape_literal__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/117/CWE_90__backticks__func_pg_escape_literal__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/117/CWE_90__backticks__func_pg_escape_literal__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/117/CWE_90__backticks__func_pg_escape_literal__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/117/CWE_90__backticks__func_pg_escape_literal__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/118/CWE_90__backticks__func_pg_escape_literal__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/118/CWE_90__backticks__func_pg_escape_literal__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/118/CWE_90__backticks__func_pg_escape_literal__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/118/CWE_90__backticks__func_pg_escape_literal__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/119/CWE_90__backticks__func_pg_escape_literal__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/119/CWE_90__backticks__func_pg_escape_literal__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/119/CWE_90__backticks__func_pg_escape_literal__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/119/CWE_90__backticks__func_pg_escape_literal__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/120/CWE_90__backticks__func_pg_escape_literal__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/120/CWE_90__backticks__func_pg_escape_literal__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/120/CWE_90__backticks__func_pg_escape_literal__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/120/CWE_90__backticks__func_pg_escape_literal__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/121/CWE_90__backticks__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/121/CWE_90__backticks__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/121/CWE_90__backticks__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/121/CWE_90__backticks__func_pg_escape_literal__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/122/CWE_90__backticks__func_pg_escape_literal__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/122/CWE_90__backticks__func_pg_escape_literal__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/122/CWE_90__backticks__func_pg_escape_literal__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/122/CWE_90__backticks__func_pg_escape_literal__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/123/CWE_90__backticks__func_pg_escape_literal__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/123/CWE_90__backticks__func_pg_escape_literal__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/123/CWE_90__backticks__func_pg_escape_literal__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/123/CWE_90__backticks__func_pg_escape_literal__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/124/CWE_90__backticks__func_pg_escape_literal__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/124/CWE_90__backticks__func_pg_escape_literal__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/124/CWE_90__backticks__func_pg_escape_literal__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/124/CWE_90__backticks__func_pg_escape_literal__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/125/CWE_90__backticks__func_pg_escape_literal__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/125/CWE_90__backticks__func_pg_escape_literal__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/125/CWE_90__backticks__func_pg_escape_literal__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/125/CWE_90__backticks__func_pg_escape_literal__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/126/CWE_90__backticks__func_pg_escape_literal__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/126/CWE_90__backticks__func_pg_escape_literal__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/126/CWE_90__backticks__func_pg_escape_literal__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/126/CWE_90__backticks__func_pg_escape_literal__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/127/CWE_90__backticks__func_pg_escape_literal__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/127/CWE_90__backticks__func_pg_escape_literal__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/127/CWE_90__backticks__func_pg_escape_literal__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/127/CWE_90__backticks__func_pg_escape_literal__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/128/CWE_90__backticks__func_pg_escape_string__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/128/CWE_90__backticks__func_pg_escape_string__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/128/CWE_90__backticks__func_pg_escape_string__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/128/CWE_90__backticks__func_pg_escape_string__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/129/CWE_90__backticks__func_pg_escape_string__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/129/CWE_90__backticks__func_pg_escape_string__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/129/CWE_90__backticks__func_pg_escape_string__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/129/CWE_90__backticks__func_pg_escape_string__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/130/CWE_90__backticks__func_pg_escape_string__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/130/CWE_90__backticks__func_pg_escape_string__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/130/CWE_90__backticks__func_pg_escape_string__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/130/CWE_90__backticks__func_pg_escape_string__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/131/CWE_90__backticks__func_pg_escape_string__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/131/CWE_90__backticks__func_pg_escape_string__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/131/CWE_90__backticks__func_pg_escape_string__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/131/CWE_90__backticks__func_pg_escape_string__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/132/CWE_90__backticks__func_pg_escape_string__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/132/CWE_90__backticks__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/132/CWE_90__backticks__func_pg_escape_string__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/132/CWE_90__backticks__func_pg_escape_string__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/133/CWE_90__backticks__func_pg_escape_string__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/133/CWE_90__backticks__func_pg_escape_string__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/133/CWE_90__backticks__func_pg_escape_string__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/133/CWE_90__backticks__func_pg_escape_string__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/134/CWE_90__backticks__func_pg_escape_string__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/134/CWE_90__backticks__func_pg_escape_string__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/134/CWE_90__backticks__func_pg_escape_string__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/134/CWE_90__backticks__func_pg_escape_string__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/135/CWE_90__backticks__func_pg_escape_string__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/135/CWE_90__backticks__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/135/CWE_90__backticks__func_pg_escape_string__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/135/CWE_90__backticks__func_pg_escape_string__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/136/CWE_90__backticks__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/136/CWE_90__backticks__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/136/CWE_90__backticks__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/136/CWE_90__backticks__func_pg_escape_string__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/137/CWE_90__backticks__func_pg_escape_string__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/137/CWE_90__backticks__func_pg_escape_string__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/137/CWE_90__backticks__func_pg_escape_string__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/137/CWE_90__backticks__func_pg_escape_string__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/138/CWE_90__backticks__func_pg_escape_string__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/138/CWE_90__backticks__func_pg_escape_string__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/138/CWE_90__backticks__func_pg_escape_string__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/138/CWE_90__backticks__func_pg_escape_string__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/139/CWE_90__backticks__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/139/CWE_90__backticks__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/139/CWE_90__backticks__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/139/CWE_90__backticks__func_pg_escape_string__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/140/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/140/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/140/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/140/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/141/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/141/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/141/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/141/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/142/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/142/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/142/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/142/CWE_89__backticks__object-func_mysql_real_escape_string__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/143/CWE_89__backticks__object-func_mysql_real_escape_string__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/143/CWE_89__backticks__object-func_mysql_real_escape_string__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/143/CWE_89__backticks__object-func_mysql_real_escape_string__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/143/CWE_89__backticks__object-func_mysql_real_escape_string__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/144/CWE_89__backticks__object-func_mysql_real_escape_string__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/144/CWE_89__backticks__object-func_mysql_real_escape_string__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/144/CWE_89__backticks__object-func_mysql_real_escape_string__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/144/CWE_89__backticks__object-func_mysql_real_escape_string__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/145/CWE_89__backticks__object-func_mysql_real_escape_string__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/145/CWE_89__backticks__object-func_mysql_real_escape_string__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/145/CWE_89__backticks__object-func_mysql_real_escape_string__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/145/CWE_89__backticks__object-func_mysql_real_escape_string__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/146/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/146/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/146/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/146/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/147/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/147/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/147/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/147/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/148/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/148/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/148/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/148/CWE_91__backticks__object-func_mysql_real_escape_string__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/149/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/149/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/149/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/149/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/150/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/150/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/150/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/150/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/151/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/151/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/151/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/151/CWE_91__backticks__object-func_mysql_real_escape_string__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/152/CWE_91__backticks__object-func_mysql_real_escape_string__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/152/CWE_91__backticks__object-func_mysql_real_escape_string__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/152/CWE_91__backticks__object-func_mysql_real_escape_string__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/152/CWE_91__backticks__object-func_mysql_real_escape_string__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/153/CWE_91__backticks__object-func_mysql_real_escape_string__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/153/CWE_91__backticks__object-func_mysql_real_escape_string__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/153/CWE_91__backticks__object-func_mysql_real_escape_string__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/153/CWE_91__backticks__object-func_mysql_real_escape_string__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/154/CWE_91__backticks__object-func_mysql_real_escape_string__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/154/CWE_91__backticks__object-func_mysql_real_escape_string__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/154/CWE_91__backticks__object-func_mysql_real_escape_string__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/154/CWE_91__backticks__object-func_mysql_real_escape_string__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/155/CWE_91__backticks__object-func_mysql_real_escape_string__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/155/CWE_91__backticks__object-func_mysql_real_escape_string__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/155/CWE_91__backticks__object-func_mysql_real_escape_string__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/155/CWE_91__backticks__object-func_mysql_real_escape_string__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/156/CWE_91__backticks__object-func_mysql_real_escape_string__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/156/CWE_91__backticks__object-func_mysql_real_escape_string__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/156/CWE_91__backticks__object-func_mysql_real_escape_string__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/156/CWE_91__backticks__object-func_mysql_real_escape_string__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/157/CWE_91__backticks__object-func_mysql_real_escape_string__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/157/CWE_91__backticks__object-func_mysql_real_escape_string__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/157/CWE_91__backticks__object-func_mysql_real_escape_string__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/157/CWE_91__backticks__object-func_mysql_real_escape_string__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/158/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/158/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/158/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/158/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/159/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/159/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/159/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/159/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/160/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/160/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/160/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/160/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/161/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/161/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/161/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/161/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/162/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/162/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/162/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/162/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/163/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/163/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/163/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/163/CWE_89__backticks__object-func_mysql_real_escape_stringGetter__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/164/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/164/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/164/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/164/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/165/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/165/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/165/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/165/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/166/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/166/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/166/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/166/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/167/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/167/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/167/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/167/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/168/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/168/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/168/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/168/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/169/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/169/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/169/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/169/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/170/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/170/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/170/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/170/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/171/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/171/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/171/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/171/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/172/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/172/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/172/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/172/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/173/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/173/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/173/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/173/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/174/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/174/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/174/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/174/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/175/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/175/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/175/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/175/CWE_91__backticks__object-func_mysql_real_escape_stringGetter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/176/CWE_98__exec__func_preg_match-only_letters__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/176/CWE_98__exec__func_preg_match-only_letters__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/176/CWE_98__exec__func_preg_match-only_letters__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/176/CWE_98__exec__func_preg_match-only_letters__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/177/CWE_98__exec__func_preg_match-only_letters__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/177/CWE_98__exec__func_preg_match-only_letters__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/177/CWE_98__exec__func_preg_match-only_letters__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/177/CWE_98__exec__func_preg_match-only_letters__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/178/CWE_98__exec__func_preg_match-only_letters__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/178/CWE_98__exec__func_preg_match-only_letters__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/178/CWE_98__exec__func_preg_match-only_letters__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/178/CWE_98__exec__func_preg_match-only_letters__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/179/CWE_98__exec__func_preg_match-only_letters__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/179/CWE_98__exec__func_preg_match-only_letters__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/179/CWE_98__exec__func_preg_match-only_letters__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/179/CWE_98__exec__func_preg_match-only_letters__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/180/CWE_98__exec__func_preg_match-only_letters__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/180/CWE_98__exec__func_preg_match-only_letters__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/180/CWE_98__exec__func_preg_match-only_letters__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/180/CWE_98__exec__func_preg_match-only_letters__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/181/CWE_98__exec__func_preg_match-only_letters__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/181/CWE_98__exec__func_preg_match-only_letters__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/181/CWE_98__exec__func_preg_match-only_letters__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/181/CWE_98__exec__func_preg_match-only_letters__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/182/CWE_95__exec__func_preg_match-only_letters__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/182/CWE_95__exec__func_preg_match-only_letters__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/182/CWE_95__exec__func_preg_match-only_letters__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/182/CWE_95__exec__func_preg_match-only_letters__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/183/CWE_95__exec__func_preg_match-only_letters__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/183/CWE_95__exec__func_preg_match-only_letters__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/183/CWE_95__exec__func_preg_match-only_letters__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/183/CWE_95__exec__func_preg_match-only_letters__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/184/CWE_95__exec__func_preg_match-only_letters__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/184/CWE_95__exec__func_preg_match-only_letters__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/184/CWE_95__exec__func_preg_match-only_letters__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/184/CWE_95__exec__func_preg_match-only_letters__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/185/CWE_78__exec__func_preg_match-only_letters__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/185/CWE_78__exec__func_preg_match-only_letters__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/185/CWE_78__exec__func_preg_match-only_letters__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/185/CWE_78__exec__func_preg_match-only_letters__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/186/CWE_78__exec__func_preg_match-only_letters__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/186/CWE_78__exec__func_preg_match-only_letters__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/186/CWE_78__exec__func_preg_match-only_letters__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/186/CWE_78__exec__func_preg_match-only_letters__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/187/CWE_78__exec__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/187/CWE_78__exec__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/187/CWE_78__exec__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/187/CWE_78__exec__func_preg_match-only_letters__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/188/CWE_78__exec__func_preg_match-only_letters__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/188/CWE_78__exec__func_preg_match-only_letters__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/188/CWE_78__exec__func_preg_match-only_letters__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/188/CWE_78__exec__func_preg_match-only_letters__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/189/CWE_78__exec__func_preg_match-only_letters__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/189/CWE_78__exec__func_preg_match-only_letters__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/189/CWE_78__exec__func_preg_match-only_letters__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/189/CWE_78__exec__func_preg_match-only_letters__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/190/CWE_78__exec__func_preg_match-only_letters__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/190/CWE_78__exec__func_preg_match-only_letters__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/190/CWE_78__exec__func_preg_match-only_letters__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/190/CWE_78__exec__func_preg_match-only_letters__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/191/CWE_90__exec__func_preg_match-only_letters__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/191/CWE_90__exec__func_preg_match-only_letters__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/191/CWE_90__exec__func_preg_match-only_letters__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/191/CWE_90__exec__func_preg_match-only_letters__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/192/CWE_90__exec__func_preg_match-only_letters__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/192/CWE_90__exec__func_preg_match-only_letters__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/192/CWE_90__exec__func_preg_match-only_letters__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/192/CWE_90__exec__func_preg_match-only_letters__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/193/CWE_90__exec__func_preg_match-only_letters__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/193/CWE_90__exec__func_preg_match-only_letters__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/193/CWE_90__exec__func_preg_match-only_letters__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/193/CWE_90__exec__func_preg_match-only_letters__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/194/CWE_90__exec__func_preg_match-only_letters__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/194/CWE_90__exec__func_preg_match-only_letters__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/194/CWE_90__exec__func_preg_match-only_letters__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/194/CWE_90__exec__func_preg_match-only_letters__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/195/CWE_90__exec__func_preg_match-only_letters__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/195/CWE_90__exec__func_preg_match-only_letters__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/195/CWE_90__exec__func_preg_match-only_letters__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/195/CWE_90__exec__func_preg_match-only_letters__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/196/CWE_90__exec__func_preg_match-only_letters__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/196/CWE_90__exec__func_preg_match-only_letters__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/196/CWE_90__exec__func_preg_match-only_letters__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/196/CWE_90__exec__func_preg_match-only_letters__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/197/CWE_90__exec__func_preg_match-only_letters__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/197/CWE_90__exec__func_preg_match-only_letters__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/197/CWE_90__exec__func_preg_match-only_letters__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/197/CWE_90__exec__func_preg_match-only_letters__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/198/CWE_90__exec__func_preg_match-only_letters__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/198/CWE_90__exec__func_preg_match-only_letters__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/198/CWE_90__exec__func_preg_match-only_letters__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/198/CWE_90__exec__func_preg_match-only_letters__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/199/CWE_90__exec__func_preg_match-only_letters__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/199/CWE_90__exec__func_preg_match-only_letters__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/199/CWE_90__exec__func_preg_match-only_letters__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/199/CWE_90__exec__func_preg_match-only_letters__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/200/CWE_90__exec__func_preg_match-only_letters__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/200/CWE_90__exec__func_preg_match-only_letters__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/200/CWE_90__exec__func_preg_match-only_letters__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/200/CWE_90__exec__func_preg_match-only_letters__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/201/CWE_90__exec__func_preg_match-only_letters__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/201/CWE_90__exec__func_preg_match-only_letters__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/201/CWE_90__exec__func_preg_match-only_letters__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/201/CWE_90__exec__func_preg_match-only_letters__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/202/CWE_90__exec__func_preg_match-only_letters__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/202/CWE_90__exec__func_preg_match-only_letters__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/202/CWE_90__exec__func_preg_match-only_letters__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/202/CWE_90__exec__func_preg_match-only_letters__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/203/CWE_89__exec__func_preg_match-only_letters__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/203/CWE_89__exec__func_preg_match-only_letters__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/203/CWE_89__exec__func_preg_match-only_letters__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/203/CWE_89__exec__func_preg_match-only_letters__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/204/CWE_89__exec__func_preg_match-only_letters__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/204/CWE_89__exec__func_preg_match-only_letters__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/204/CWE_89__exec__func_preg_match-only_letters__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/204/CWE_89__exec__func_preg_match-only_letters__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/205/CWE_89__exec__func_preg_match-only_letters__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/205/CWE_89__exec__func_preg_match-only_letters__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/205/CWE_89__exec__func_preg_match-only_letters__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/205/CWE_89__exec__func_preg_match-only_letters__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/206/CWE_89__exec__func_preg_match-only_letters__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/206/CWE_89__exec__func_preg_match-only_letters__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/206/CWE_89__exec__func_preg_match-only_letters__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/206/CWE_89__exec__func_preg_match-only_letters__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/207/CWE_89__exec__func_preg_match-only_letters__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/207/CWE_89__exec__func_preg_match-only_letters__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/207/CWE_89__exec__func_preg_match-only_letters__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/207/CWE_89__exec__func_preg_match-only_letters__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/208/CWE_89__exec__func_preg_match-only_letters__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/208/CWE_89__exec__func_preg_match-only_letters__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/208/CWE_89__exec__func_preg_match-only_letters__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/208/CWE_89__exec__func_preg_match-only_letters__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/209/CWE_91__exec__func_preg_match-only_letters__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/209/CWE_91__exec__func_preg_match-only_letters__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/209/CWE_91__exec__func_preg_match-only_letters__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/209/CWE_91__exec__func_preg_match-only_letters__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/210/CWE_91__exec__func_preg_match-only_letters__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/210/CWE_91__exec__func_preg_match-only_letters__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/210/CWE_91__exec__func_preg_match-only_letters__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/210/CWE_91__exec__func_preg_match-only_letters__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/211/CWE_91__exec__func_preg_match-only_letters__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/211/CWE_91__exec__func_preg_match-only_letters__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/211/CWE_91__exec__func_preg_match-only_letters__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/211/CWE_91__exec__func_preg_match-only_letters__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/212/CWE_91__exec__func_preg_match-only_letters__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/212/CWE_91__exec__func_preg_match-only_letters__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/212/CWE_91__exec__func_preg_match-only_letters__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/212/CWE_91__exec__func_preg_match-only_letters__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/213/CWE_91__exec__func_preg_match-only_letters__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/213/CWE_91__exec__func_preg_match-only_letters__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/213/CWE_91__exec__func_preg_match-only_letters__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/213/CWE_91__exec__func_preg_match-only_letters__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/214/CWE_91__exec__func_preg_match-only_letters__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/214/CWE_91__exec__func_preg_match-only_letters__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/214/CWE_91__exec__func_preg_match-only_letters__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/214/CWE_91__exec__func_preg_match-only_letters__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/215/CWE_91__exec__func_preg_match-only_letters__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/215/CWE_91__exec__func_preg_match-only_letters__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/215/CWE_91__exec__func_preg_match-only_letters__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/215/CWE_91__exec__func_preg_match-only_letters__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/216/CWE_91__exec__func_preg_match-only_letters__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/216/CWE_91__exec__func_preg_match-only_letters__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/216/CWE_91__exec__func_preg_match-only_letters__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/216/CWE_91__exec__func_preg_match-only_letters__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/217/CWE_91__exec__func_preg_match-only_letters__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/217/CWE_91__exec__func_preg_match-only_letters__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/217/CWE_91__exec__func_preg_match-only_letters__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/217/CWE_91__exec__func_preg_match-only_letters__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/218/CWE_91__exec__func_preg_match-only_letters__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/218/CWE_91__exec__func_preg_match-only_letters__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/218/CWE_91__exec__func_preg_match-only_letters__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/218/CWE_91__exec__func_preg_match-only_letters__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/219/CWE_91__exec__func_preg_match-only_letters__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/219/CWE_91__exec__func_preg_match-only_letters__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/219/CWE_91__exec__func_preg_match-only_letters__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/219/CWE_91__exec__func_preg_match-only_letters__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/220/CWE_91__exec__func_preg_match-only_letters__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/220/CWE_91__exec__func_preg_match-only_letters__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/220/CWE_91__exec__func_preg_match-only_letters__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/220/CWE_91__exec__func_preg_match-only_letters__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/221/CWE_98__exec__func_preg_match-only_numbers__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/221/CWE_98__exec__func_preg_match-only_numbers__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/221/CWE_98__exec__func_preg_match-only_numbers__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/221/CWE_98__exec__func_preg_match-only_numbers__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/222/CWE_98__exec__func_preg_match-only_numbers__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/222/CWE_98__exec__func_preg_match-only_numbers__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/222/CWE_98__exec__func_preg_match-only_numbers__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/222/CWE_98__exec__func_preg_match-only_numbers__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/223/CWE_98__exec__func_preg_match-only_numbers__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/223/CWE_98__exec__func_preg_match-only_numbers__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/223/CWE_98__exec__func_preg_match-only_numbers__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/223/CWE_98__exec__func_preg_match-only_numbers__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/224/CWE_98__exec__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/224/CWE_98__exec__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/224/CWE_98__exec__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/224/CWE_98__exec__func_preg_match-only_numbers__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/225/CWE_98__exec__func_preg_match-only_numbers__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/225/CWE_98__exec__func_preg_match-only_numbers__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/225/CWE_98__exec__func_preg_match-only_numbers__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/225/CWE_98__exec__func_preg_match-only_numbers__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/226/CWE_98__exec__func_preg_match-only_numbers__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/226/CWE_98__exec__func_preg_match-only_numbers__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/226/CWE_98__exec__func_preg_match-only_numbers__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/226/CWE_98__exec__func_preg_match-only_numbers__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/227/CWE_95__exec__func_preg_match-only_numbers__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/227/CWE_95__exec__func_preg_match-only_numbers__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/227/CWE_95__exec__func_preg_match-only_numbers__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/227/CWE_95__exec__func_preg_match-only_numbers__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/228/CWE_95__exec__func_preg_match-only_numbers__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/228/CWE_95__exec__func_preg_match-only_numbers__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/228/CWE_95__exec__func_preg_match-only_numbers__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/228/CWE_95__exec__func_preg_match-only_numbers__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/229/CWE_95__exec__func_preg_match-only_numbers__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/229/CWE_95__exec__func_preg_match-only_numbers__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/229/CWE_95__exec__func_preg_match-only_numbers__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/229/CWE_95__exec__func_preg_match-only_numbers__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/230/CWE_78__exec__func_preg_match-only_numbers__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/230/CWE_78__exec__func_preg_match-only_numbers__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/230/CWE_78__exec__func_preg_match-only_numbers__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/230/CWE_78__exec__func_preg_match-only_numbers__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/231/CWE_78__exec__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/231/CWE_78__exec__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/231/CWE_78__exec__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/231/CWE_78__exec__func_preg_match-only_numbers__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/232/CWE_78__exec__func_preg_match-only_numbers__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/232/CWE_78__exec__func_preg_match-only_numbers__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/232/CWE_78__exec__func_preg_match-only_numbers__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/232/CWE_78__exec__func_preg_match-only_numbers__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/233/CWE_89__exec__func_preg_match-only_numbers__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/233/CWE_89__exec__func_preg_match-only_numbers__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/233/CWE_89__exec__func_preg_match-only_numbers__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/233/CWE_89__exec__func_preg_match-only_numbers__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/234/CWE_89__exec__func_preg_match-only_numbers__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/234/CWE_89__exec__func_preg_match-only_numbers__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/234/CWE_89__exec__func_preg_match-only_numbers__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/234/CWE_89__exec__func_preg_match-only_numbers__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/235/CWE_89__exec__func_preg_match-only_numbers__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/235/CWE_89__exec__func_preg_match-only_numbers__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/235/CWE_89__exec__func_preg_match-only_numbers__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/235/CWE_89__exec__func_preg_match-only_numbers__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/236/CWE_89__exec__func_preg_match-only_numbers__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/236/CWE_89__exec__func_preg_match-only_numbers__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/236/CWE_89__exec__func_preg_match-only_numbers__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/236/CWE_89__exec__func_preg_match-only_numbers__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/237/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/237/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/237/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/237/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/238/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/238/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/238/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/238/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/239/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/239/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/239/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/239/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/240/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/240/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/240/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/240/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/241/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/241/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/241/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/241/CWE_89__exec__func_preg_match-only_numbers__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/242/CWE_89__exec__func_preg_match-only_numbers__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/242/CWE_89__exec__func_preg_match-only_numbers__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/242/CWE_89__exec__func_preg_match-only_numbers__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/242/CWE_89__exec__func_preg_match-only_numbers__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/243/CWE_89__exec__func_preg_match-only_numbers__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/243/CWE_89__exec__func_preg_match-only_numbers__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/243/CWE_89__exec__func_preg_match-only_numbers__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/243/CWE_89__exec__func_preg_match-only_numbers__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/244/CWE_89__exec__func_preg_match-only_numbers__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/244/CWE_89__exec__func_preg_match-only_numbers__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/244/CWE_89__exec__func_preg_match-only_numbers__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/244/CWE_89__exec__func_preg_match-only_numbers__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/245/CWE_89__exec__func_preg_match-only_numbers__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/245/CWE_89__exec__func_preg_match-only_numbers__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/245/CWE_89__exec__func_preg_match-only_numbers__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/245/CWE_89__exec__func_preg_match-only_numbers__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/246/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/246/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/246/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/246/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/247/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/247/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/247/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/247/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/248/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/248/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/248/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/248/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/249/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/249/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/249/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/249/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/250/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/250/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/250/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/250/CWE_89__exec__func_preg_match-only_numbers__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/251/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/251/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/251/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/251/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/252/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/252/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/252/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/252/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/253/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/253/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/253/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/253/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/254/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/254/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/254/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/254/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/255/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/255/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/255/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/255/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/256/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/256/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/256/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/256/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/257/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/257/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/257/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/257/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/258/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/258/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/258/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/258/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/259/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/259/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/259/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/259/CWE_89__exec__func_preg_match-only_numbers__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/260/CWE_91__exec__func_preg_match-only_numbers__ID_test-concatenation.php");
$framework->add_output("./tests/sard/260/CWE_91__exec__func_preg_match-only_numbers__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/260/CWE_91__exec__func_preg_match-only_numbers__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/260/CWE_91__exec__func_preg_match-only_numbers__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/261/CWE_91__exec__func_preg_match-only_numbers__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/261/CWE_91__exec__func_preg_match-only_numbers__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/261/CWE_91__exec__func_preg_match-only_numbers__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/261/CWE_91__exec__func_preg_match-only_numbers__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/262/CWE_91__exec__func_preg_match-only_numbers__ID_test-interpretation.php");
$framework->add_output("./tests/sard/262/CWE_91__exec__func_preg_match-only_numbers__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/262/CWE_91__exec__func_preg_match-only_numbers__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/262/CWE_91__exec__func_preg_match-only_numbers__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/263/CWE_91__exec__func_preg_match-only_numbers__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/263/CWE_91__exec__func_preg_match-only_numbers__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/263/CWE_91__exec__func_preg_match-only_numbers__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/263/CWE_91__exec__func_preg_match-only_numbers__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/264/CWE_91__exec__func_preg_match-only_numbers__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/264/CWE_91__exec__func_preg_match-only_numbers__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/264/CWE_91__exec__func_preg_match-only_numbers__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/264/CWE_91__exec__func_preg_match-only_numbers__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/265/CWE_91__exec__func_preg_match-only_numbers__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/265/CWE_91__exec__func_preg_match-only_numbers__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/265/CWE_91__exec__func_preg_match-only_numbers__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/265/CWE_91__exec__func_preg_match-only_numbers__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/266/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/266/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/266/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/266/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/267/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/267/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/267/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/267/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/268/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/268/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/268/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/268/CWE_91__exec__func_preg_match-only_numbers__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/269/CWE_78__exec__func_escapeshellarg__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/269/CWE_78__exec__func_escapeshellarg__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/269/CWE_78__exec__func_escapeshellarg__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/269/CWE_78__exec__func_escapeshellarg__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/270/CWE_78__exec__func_escapeshellarg__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/270/CWE_78__exec__func_escapeshellarg__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/270/CWE_78__exec__func_escapeshellarg__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/270/CWE_78__exec__func_escapeshellarg__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/271/CWE_78__exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/271/CWE_78__exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/271/CWE_78__exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/271/CWE_78__exec__func_escapeshellarg__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/272/CWE_78__exec__func_escapeshellarg__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/272/CWE_78__exec__func_escapeshellarg__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/272/CWE_78__exec__func_escapeshellarg__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/272/CWE_78__exec__func_escapeshellarg__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/273/CWE_78__exec__func_escapeshellarg__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/273/CWE_78__exec__func_escapeshellarg__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/273/CWE_78__exec__func_escapeshellarg__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/273/CWE_78__exec__func_escapeshellarg__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/274/CWE_78__exec__func_escapeshellarg__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/274/CWE_78__exec__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/274/CWE_78__exec__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/274/CWE_78__exec__func_escapeshellarg__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/275/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/275/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/275/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/275/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/276/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/276/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/276/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/276/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/277/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/277/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/277/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/277/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/278/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/278/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/278/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/278/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/279/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/279/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/279/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/279/CWE_98__exec__func_preg_match-letters_numbers__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/280/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/280/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/280/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/280/CWE_98__exec__func_preg_match-letters_numbers__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/281/CWE_95__exec__func_preg_match-letters_numbers__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/281/CWE_95__exec__func_preg_match-letters_numbers__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/281/CWE_95__exec__func_preg_match-letters_numbers__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/281/CWE_95__exec__func_preg_match-letters_numbers__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/282/CWE_95__exec__func_preg_match-letters_numbers__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/282/CWE_95__exec__func_preg_match-letters_numbers__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/282/CWE_95__exec__func_preg_match-letters_numbers__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/282/CWE_95__exec__func_preg_match-letters_numbers__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/283/CWE_95__exec__func_preg_match-letters_numbers__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/283/CWE_95__exec__func_preg_match-letters_numbers__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/283/CWE_95__exec__func_preg_match-letters_numbers__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/283/CWE_95__exec__func_preg_match-letters_numbers__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/284/CWE_78__exec__func_preg_match-letters_numbers__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/284/CWE_78__exec__func_preg_match-letters_numbers__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/284/CWE_78__exec__func_preg_match-letters_numbers__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/284/CWE_78__exec__func_preg_match-letters_numbers__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/285/CWE_78__exec__func_preg_match-letters_numbers__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/285/CWE_78__exec__func_preg_match-letters_numbers__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/285/CWE_78__exec__func_preg_match-letters_numbers__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/285/CWE_78__exec__func_preg_match-letters_numbers__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/286/CWE_78__exec__func_preg_match-letters_numbers__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/286/CWE_78__exec__func_preg_match-letters_numbers__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/286/CWE_78__exec__func_preg_match-letters_numbers__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/286/CWE_78__exec__func_preg_match-letters_numbers__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/287/CWE_78__exec__func_preg_match-letters_numbers__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/287/CWE_78__exec__func_preg_match-letters_numbers__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/287/CWE_78__exec__func_preg_match-letters_numbers__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/287/CWE_78__exec__func_preg_match-letters_numbers__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/288/CWE_78__exec__func_preg_match-letters_numbers__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/288/CWE_78__exec__func_preg_match-letters_numbers__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/288/CWE_78__exec__func_preg_match-letters_numbers__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/288/CWE_78__exec__func_preg_match-letters_numbers__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/289/CWE_78__exec__func_preg_match-letters_numbers__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/289/CWE_78__exec__func_preg_match-letters_numbers__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/289/CWE_78__exec__func_preg_match-letters_numbers__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/289/CWE_78__exec__func_preg_match-letters_numbers__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/290/CWE_90__exec__func_preg_match-letters_numbers__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/290/CWE_90__exec__func_preg_match-letters_numbers__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/290/CWE_90__exec__func_preg_match-letters_numbers__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/290/CWE_90__exec__func_preg_match-letters_numbers__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/291/CWE_90__exec__func_preg_match-letters_numbers__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/291/CWE_90__exec__func_preg_match-letters_numbers__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/291/CWE_90__exec__func_preg_match-letters_numbers__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/291/CWE_90__exec__func_preg_match-letters_numbers__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/292/CWE_90__exec__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/292/CWE_90__exec__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/292/CWE_90__exec__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/292/CWE_90__exec__func_preg_match-letters_numbers__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/293/CWE_90__exec__func_preg_match-letters_numbers__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/293/CWE_90__exec__func_preg_match-letters_numbers__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/293/CWE_90__exec__func_preg_match-letters_numbers__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/293/CWE_90__exec__func_preg_match-letters_numbers__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/294/CWE_90__exec__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/294/CWE_90__exec__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/294/CWE_90__exec__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/294/CWE_90__exec__func_preg_match-letters_numbers__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/295/CWE_90__exec__func_preg_match-letters_numbers__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/295/CWE_90__exec__func_preg_match-letters_numbers__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/295/CWE_90__exec__func_preg_match-letters_numbers__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/295/CWE_90__exec__func_preg_match-letters_numbers__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/296/CWE_90__exec__func_preg_match-letters_numbers__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/296/CWE_90__exec__func_preg_match-letters_numbers__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/296/CWE_90__exec__func_preg_match-letters_numbers__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/296/CWE_90__exec__func_preg_match-letters_numbers__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/297/CWE_90__exec__func_preg_match-letters_numbers__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/297/CWE_90__exec__func_preg_match-letters_numbers__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/297/CWE_90__exec__func_preg_match-letters_numbers__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/297/CWE_90__exec__func_preg_match-letters_numbers__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/298/CWE_90__exec__func_preg_match-letters_numbers__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/298/CWE_90__exec__func_preg_match-letters_numbers__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/298/CWE_90__exec__func_preg_match-letters_numbers__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/298/CWE_90__exec__func_preg_match-letters_numbers__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/299/CWE_90__exec__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/299/CWE_90__exec__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/299/CWE_90__exec__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/299/CWE_90__exec__func_preg_match-letters_numbers__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/300/CWE_90__exec__func_preg_match-letters_numbers__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/300/CWE_90__exec__func_preg_match-letters_numbers__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/300/CWE_90__exec__func_preg_match-letters_numbers__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/300/CWE_90__exec__func_preg_match-letters_numbers__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/301/CWE_90__exec__func_preg_match-letters_numbers__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/301/CWE_90__exec__func_preg_match-letters_numbers__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/301/CWE_90__exec__func_preg_match-letters_numbers__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/301/CWE_90__exec__func_preg_match-letters_numbers__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/302/CWE_89__exec__func_preg_match-letters_numbers__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/302/CWE_89__exec__func_preg_match-letters_numbers__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/302/CWE_89__exec__func_preg_match-letters_numbers__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/302/CWE_89__exec__func_preg_match-letters_numbers__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/303/CWE_89__exec__func_preg_match-letters_numbers__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/303/CWE_89__exec__func_preg_match-letters_numbers__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/303/CWE_89__exec__func_preg_match-letters_numbers__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/303/CWE_89__exec__func_preg_match-letters_numbers__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/304/CWE_89__exec__func_preg_match-letters_numbers__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/304/CWE_89__exec__func_preg_match-letters_numbers__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/304/CWE_89__exec__func_preg_match-letters_numbers__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/304/CWE_89__exec__func_preg_match-letters_numbers__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/305/CWE_89__exec__func_preg_match-letters_numbers__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/305/CWE_89__exec__func_preg_match-letters_numbers__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/305/CWE_89__exec__func_preg_match-letters_numbers__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/305/CWE_89__exec__func_preg_match-letters_numbers__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/306/CWE_89__exec__func_preg_match-letters_numbers__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/306/CWE_89__exec__func_preg_match-letters_numbers__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/306/CWE_89__exec__func_preg_match-letters_numbers__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/306/CWE_89__exec__func_preg_match-letters_numbers__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/307/CWE_89__exec__func_preg_match-letters_numbers__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/307/CWE_89__exec__func_preg_match-letters_numbers__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/307/CWE_89__exec__func_preg_match-letters_numbers__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/307/CWE_89__exec__func_preg_match-letters_numbers__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/308/CWE_91__exec__func_preg_match-letters_numbers__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/308/CWE_91__exec__func_preg_match-letters_numbers__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/308/CWE_91__exec__func_preg_match-letters_numbers__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/308/CWE_91__exec__func_preg_match-letters_numbers__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/309/CWE_91__exec__func_preg_match-letters_numbers__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/309/CWE_91__exec__func_preg_match-letters_numbers__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/309/CWE_91__exec__func_preg_match-letters_numbers__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/309/CWE_91__exec__func_preg_match-letters_numbers__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/310/CWE_91__exec__func_preg_match-letters_numbers__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/310/CWE_91__exec__func_preg_match-letters_numbers__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/310/CWE_91__exec__func_preg_match-letters_numbers__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/310/CWE_91__exec__func_preg_match-letters_numbers__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/311/CWE_91__exec__func_preg_match-letters_numbers__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/311/CWE_91__exec__func_preg_match-letters_numbers__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/311/CWE_91__exec__func_preg_match-letters_numbers__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/311/CWE_91__exec__func_preg_match-letters_numbers__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/312/CWE_91__exec__func_preg_match-letters_numbers__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/312/CWE_91__exec__func_preg_match-letters_numbers__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/312/CWE_91__exec__func_preg_match-letters_numbers__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/312/CWE_91__exec__func_preg_match-letters_numbers__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/313/CWE_91__exec__func_preg_match-letters_numbers__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/313/CWE_91__exec__func_preg_match-letters_numbers__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/313/CWE_91__exec__func_preg_match-letters_numbers__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/313/CWE_91__exec__func_preg_match-letters_numbers__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/314/CWE_91__exec__func_preg_match-letters_numbers__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/314/CWE_91__exec__func_preg_match-letters_numbers__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/314/CWE_91__exec__func_preg_match-letters_numbers__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/314/CWE_91__exec__func_preg_match-letters_numbers__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/315/CWE_91__exec__func_preg_match-letters_numbers__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/315/CWE_91__exec__func_preg_match-letters_numbers__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/315/CWE_91__exec__func_preg_match-letters_numbers__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/315/CWE_91__exec__func_preg_match-letters_numbers__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/316/CWE_91__exec__func_preg_match-letters_numbers__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/316/CWE_91__exec__func_preg_match-letters_numbers__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/316/CWE_91__exec__func_preg_match-letters_numbers__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/316/CWE_91__exec__func_preg_match-letters_numbers__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/317/CWE_91__exec__func_preg_match-letters_numbers__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/317/CWE_91__exec__func_preg_match-letters_numbers__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/317/CWE_91__exec__func_preg_match-letters_numbers__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/317/CWE_91__exec__func_preg_match-letters_numbers__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/318/CWE_91__exec__func_preg_match-letters_numbers__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/318/CWE_91__exec__func_preg_match-letters_numbers__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/318/CWE_91__exec__func_preg_match-letters_numbers__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/318/CWE_91__exec__func_preg_match-letters_numbers__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/319/CWE_91__exec__func_preg_match-letters_numbers__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/319/CWE_91__exec__func_preg_match-letters_numbers__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/319/CWE_91__exec__func_preg_match-letters_numbers__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/319/CWE_91__exec__func_preg_match-letters_numbers__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/320/CWE_98__exec__func_preg_match-no_filtering__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/320/CWE_98__exec__func_preg_match-no_filtering__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/320/CWE_98__exec__func_preg_match-no_filtering__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/320/CWE_98__exec__func_preg_match-no_filtering__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/321/CWE_98__exec__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/321/CWE_98__exec__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/321/CWE_98__exec__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/321/CWE_98__exec__func_preg_match-no_filtering__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/322/CWE_98__exec__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/322/CWE_98__exec__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/322/CWE_98__exec__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/322/CWE_98__exec__func_preg_match-no_filtering__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/323/CWE_98__exec__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/323/CWE_98__exec__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/323/CWE_98__exec__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/323/CWE_98__exec__func_preg_match-no_filtering__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/324/CWE_98__exec__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/324/CWE_98__exec__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/324/CWE_98__exec__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/324/CWE_98__exec__func_preg_match-no_filtering__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/325/CWE_98__exec__func_preg_match-no_filtering__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/325/CWE_98__exec__func_preg_match-no_filtering__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/325/CWE_98__exec__func_preg_match-no_filtering__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/325/CWE_98__exec__func_preg_match-no_filtering__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/326/CWE_95__exec__func_preg_match-no_filtering__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/326/CWE_95__exec__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/326/CWE_95__exec__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/326/CWE_95__exec__func_preg_match-no_filtering__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/327/CWE_95__exec__func_preg_match-no_filtering__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/327/CWE_95__exec__func_preg_match-no_filtering__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/327/CWE_95__exec__func_preg_match-no_filtering__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/327/CWE_95__exec__func_preg_match-no_filtering__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/328/CWE_95__exec__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/328/CWE_95__exec__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/328/CWE_95__exec__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/328/CWE_95__exec__func_preg_match-no_filtering__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/329/CWE_78__exec__func_preg_match-no_filtering__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/329/CWE_78__exec__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/329/CWE_78__exec__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/329/CWE_78__exec__func_preg_match-no_filtering__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/330/CWE_78__exec__func_preg_match-no_filtering__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/330/CWE_78__exec__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/330/CWE_78__exec__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/330/CWE_78__exec__func_preg_match-no_filtering__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/331/CWE_78__exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/331/CWE_78__exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/331/CWE_78__exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/331/CWE_78__exec__func_preg_match-no_filtering__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/332/CWE_78__exec__func_preg_match-no_filtering__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/332/CWE_78__exec__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/332/CWE_78__exec__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/332/CWE_78__exec__func_preg_match-no_filtering__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/333/CWE_78__exec__func_preg_match-no_filtering__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/333/CWE_78__exec__func_preg_match-no_filtering__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/333/CWE_78__exec__func_preg_match-no_filtering__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/333/CWE_78__exec__func_preg_match-no_filtering__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/334/CWE_78__exec__func_preg_match-no_filtering__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/334/CWE_78__exec__func_preg_match-no_filtering__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/334/CWE_78__exec__func_preg_match-no_filtering__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/334/CWE_78__exec__func_preg_match-no_filtering__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/335/CWE_90__exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/335/CWE_90__exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/335/CWE_90__exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/335/CWE_90__exec__func_preg_match-no_filtering__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/336/CWE_90__exec__func_preg_match-no_filtering__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/336/CWE_90__exec__func_preg_match-no_filtering__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/336/CWE_90__exec__func_preg_match-no_filtering__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/336/CWE_90__exec__func_preg_match-no_filtering__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/337/CWE_90__exec__func_preg_match-no_filtering__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/337/CWE_90__exec__func_preg_match-no_filtering__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/337/CWE_90__exec__func_preg_match-no_filtering__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/337/CWE_90__exec__func_preg_match-no_filtering__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/338/CWE_90__exec__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/338/CWE_90__exec__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/338/CWE_90__exec__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/338/CWE_90__exec__func_preg_match-no_filtering__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/339/CWE_90__exec__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/339/CWE_90__exec__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/339/CWE_90__exec__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/339/CWE_90__exec__func_preg_match-no_filtering__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/340/CWE_90__exec__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/340/CWE_90__exec__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/340/CWE_90__exec__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/340/CWE_90__exec__func_preg_match-no_filtering__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/341/CWE_90__exec__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/341/CWE_90__exec__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/341/CWE_90__exec__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/341/CWE_90__exec__func_preg_match-no_filtering__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/342/CWE_90__exec__func_preg_match-no_filtering__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/342/CWE_90__exec__func_preg_match-no_filtering__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/342/CWE_90__exec__func_preg_match-no_filtering__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/342/CWE_90__exec__func_preg_match-no_filtering__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/343/CWE_90__exec__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/343/CWE_90__exec__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/343/CWE_90__exec__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/343/CWE_90__exec__func_preg_match-no_filtering__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/344/CWE_90__exec__func_preg_match-no_filtering__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/344/CWE_90__exec__func_preg_match-no_filtering__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/344/CWE_90__exec__func_preg_match-no_filtering__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/344/CWE_90__exec__func_preg_match-no_filtering__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/345/CWE_90__exec__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/345/CWE_90__exec__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/345/CWE_90__exec__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/345/CWE_90__exec__func_preg_match-no_filtering__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/346/CWE_90__exec__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/346/CWE_90__exec__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/346/CWE_90__exec__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/346/CWE_90__exec__func_preg_match-no_filtering__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/347/CWE_89__exec__func_preg_match-no_filtering__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/347/CWE_89__exec__func_preg_match-no_filtering__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/347/CWE_89__exec__func_preg_match-no_filtering__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/347/CWE_89__exec__func_preg_match-no_filtering__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/348/CWE_89__exec__func_preg_match-no_filtering__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/348/CWE_89__exec__func_preg_match-no_filtering__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/348/CWE_89__exec__func_preg_match-no_filtering__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/348/CWE_89__exec__func_preg_match-no_filtering__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/349/CWE_89__exec__func_preg_match-no_filtering__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/349/CWE_89__exec__func_preg_match-no_filtering__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/349/CWE_89__exec__func_preg_match-no_filtering__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/349/CWE_89__exec__func_preg_match-no_filtering__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/350/CWE_89__exec__func_preg_match-no_filtering__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/350/CWE_89__exec__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/350/CWE_89__exec__func_preg_match-no_filtering__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/350/CWE_89__exec__func_preg_match-no_filtering__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/351/CWE_89__exec__func_preg_match-no_filtering__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/351/CWE_89__exec__func_preg_match-no_filtering__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/351/CWE_89__exec__func_preg_match-no_filtering__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/351/CWE_89__exec__func_preg_match-no_filtering__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/352/CWE_89__exec__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/352/CWE_89__exec__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/352/CWE_89__exec__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/352/CWE_89__exec__func_preg_match-no_filtering__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/353/CWE_91__exec__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/353/CWE_91__exec__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/353/CWE_91__exec__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/353/CWE_91__exec__func_preg_match-no_filtering__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/354/CWE_91__exec__func_preg_match-no_filtering__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/354/CWE_91__exec__func_preg_match-no_filtering__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/354/CWE_91__exec__func_preg_match-no_filtering__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/354/CWE_91__exec__func_preg_match-no_filtering__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/355/CWE_91__exec__func_preg_match-no_filtering__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/355/CWE_91__exec__func_preg_match-no_filtering__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/355/CWE_91__exec__func_preg_match-no_filtering__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/355/CWE_91__exec__func_preg_match-no_filtering__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/356/CWE_91__exec__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/356/CWE_91__exec__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/356/CWE_91__exec__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/356/CWE_91__exec__func_preg_match-no_filtering__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/357/CWE_91__exec__func_preg_match-no_filtering__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/357/CWE_91__exec__func_preg_match-no_filtering__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/357/CWE_91__exec__func_preg_match-no_filtering__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/357/CWE_91__exec__func_preg_match-no_filtering__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/358/CWE_91__exec__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/358/CWE_91__exec__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/358/CWE_91__exec__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/358/CWE_91__exec__func_preg_match-no_filtering__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/359/CWE_91__exec__func_preg_match-no_filtering__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/359/CWE_91__exec__func_preg_match-no_filtering__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/359/CWE_91__exec__func_preg_match-no_filtering__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/359/CWE_91__exec__func_preg_match-no_filtering__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/360/CWE_91__exec__func_preg_match-no_filtering__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/360/CWE_91__exec__func_preg_match-no_filtering__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/360/CWE_91__exec__func_preg_match-no_filtering__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/360/CWE_91__exec__func_preg_match-no_filtering__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/361/CWE_91__exec__func_preg_match-no_filtering__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/361/CWE_91__exec__func_preg_match-no_filtering__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/361/CWE_91__exec__func_preg_match-no_filtering__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/361/CWE_91__exec__func_preg_match-no_filtering__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/362/CWE_91__exec__func_preg_match-no_filtering__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/362/CWE_91__exec__func_preg_match-no_filtering__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/362/CWE_91__exec__func_preg_match-no_filtering__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/362/CWE_91__exec__func_preg_match-no_filtering__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/363/CWE_91__exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/363/CWE_91__exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/363/CWE_91__exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/363/CWE_91__exec__func_preg_match-no_filtering__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/364/CWE_91__exec__func_preg_match-no_filtering__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/364/CWE_91__exec__func_preg_match-no_filtering__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/364/CWE_91__exec__func_preg_match-no_filtering__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/364/CWE_91__exec__func_preg_match-no_filtering__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/365/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/365/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/365/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/365/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/366/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/366/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/366/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/366/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/367/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/367/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/367/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/367/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/368/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/368/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/368/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/368/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/369/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/369/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/369/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/369/CWE_98__exec__func_FILTER-CLEANING-email_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/370/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/370/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/370/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/370/CWE_98__exec__func_FILTER-CLEANING-email_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/371/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/371/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/371/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/371/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/372/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/372/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/372/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/372/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/373/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/373/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/373/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/373/CWE_95__exec__func_FILTER-CLEANING-email_filter__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/374/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/374/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/374/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/374/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/375/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/375/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/375/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/375/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/376/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/376/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/376/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/376/CWE_78__exec__func_FILTER-CLEANING-email_filter__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/377/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/377/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/377/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/377/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/378/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/378/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/378/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/378/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/379/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/379/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/379/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/379/CWE_78__exec__func_FILTER-CLEANING-email_filter__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/380/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/380/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/380/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/380/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/381/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/381/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/381/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/381/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/382/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/382/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/382/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/382/CWE_90__exec__func_FILTER-CLEANING-email_filter__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/383/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/383/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/383/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/383/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/384/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/384/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/384/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/384/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/385/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/385/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/385/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/385/CWE_90__exec__func_FILTER-CLEANING-email_filter__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/386/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/386/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/386/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/386/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/387/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/387/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/387/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/387/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/388/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/388/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/388/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/388/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/389/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/389/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/389/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/389/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/390/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/390/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/390/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/390/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/391/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/391/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/391/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/391/CWE_90__exec__func_FILTER-CLEANING-email_filter__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/392/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/392/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/392/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/392/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/393/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/393/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/393/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/393/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/394/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/394/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/394/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/394/CWE_89__exec__func_FILTER-CLEANING-email_filter__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/395/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/395/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/395/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/395/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/396/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/396/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/396/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/396/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/397/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/397/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/397/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/397/CWE_89__exec__func_FILTER-CLEANING-email_filter__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/398/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/398/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/398/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/398/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/399/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/399/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/399/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/399/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/400/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/400/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/400/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/400/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/401/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/401/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/401/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/401/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/402/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/402/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/402/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/402/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/403/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/403/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/403/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/403/CWE_91__exec__func_FILTER-CLEANING-email_filter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/404/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/404/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/404/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/404/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/405/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/405/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/405/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/405/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/406/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/406/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/406/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/406/CWE_91__exec__func_FILTER-CLEANING-email_filter__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/407/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/407/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/407/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/407/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/408/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/408/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/408/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/408/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/409/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/409/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/409/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/409/CWE_91__exec__func_FILTER-CLEANING-email_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/410/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/410/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/410/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/410/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/411/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/411/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/411/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/411/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/412/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/412/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/412/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/412/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/413/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/413/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/413/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/413/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/414/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/414/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/414/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/414/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/415/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/415/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/415/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/415/CWE_98__exec__func_FILTER-CLEANING-full_special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/416/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/416/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/416/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/416/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/417/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/417/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/417/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/417/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/418/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/418/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/418/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/418/CWE_95__exec__func_FILTER-CLEANING-full_special_chars_filter__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/419/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/419/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/419/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/419/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/420/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/420/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/420/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/420/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/421/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/421/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/421/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/421/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/422/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/422/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/422/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/422/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/423/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/423/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/423/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/423/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/424/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/424/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/424/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/424/CWE_78__exec__func_FILTER-CLEANING-full_special_chars_filter__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/425/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/425/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/425/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/425/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/426/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/426/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/426/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/426/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/427/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/427/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/427/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/427/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/428/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/428/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/428/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/428/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/429/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/429/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/429/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/429/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/430/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/430/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/430/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/430/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/431/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/431/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/431/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/431/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/432/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/432/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/432/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/432/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/433/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/433/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/433/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/433/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/434/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/434/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/434/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/434/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/435/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/435/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/435/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/435/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/436/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/436/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/436/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/436/CWE_90__exec__func_FILTER-CLEANING-full_special_chars_filter__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/437/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/437/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/437/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/437/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/438/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/438/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/438/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/438/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/439/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/439/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/439/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/439/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/440/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/440/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/440/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/440/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/441/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/441/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/441/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/441/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/442/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/442/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/442/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/442/CWE_89__exec__func_FILTER-CLEANING-full_special_chars_filter__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/443/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/443/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/443/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/443/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/444/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/444/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/444/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/444/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/445/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/445/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/445/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/445/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/446/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/446/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/446/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/446/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/447/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/447/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/447/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/447/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/448/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/448/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/448/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/448/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/449/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/449/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/449/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/449/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/450/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/450/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/450/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/450/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/451/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/451/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/451/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/451/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/452/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/452/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/452/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/452/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/453/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/453/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/453/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/453/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/454/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/454/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/454/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/454/CWE_91__exec__func_FILTER-CLEANING-full_special_chars_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/455/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/455/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/455/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/455/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/456/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/456/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/456/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/456/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/457/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/457/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/457/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/457/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/458/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/458/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/458/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/458/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/459/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/459/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/459/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/459/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/460/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/460/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/460/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/460/CWE_98__exec__func_FILTER-CLEANING-magic_quotes_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/461/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/461/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/461/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/461/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/462/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/462/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/462/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/462/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/463/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/463/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/463/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/463/CWE_95__exec__func_FILTER-CLEANING-magic_quotes_filter__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/464/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/464/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/464/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/464/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/465/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/465/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/465/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/465/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/466/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/466/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/466/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/466/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/467/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/467/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/467/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/467/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/468/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/468/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/468/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/468/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/469/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/469/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/469/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/469/CWE_78__exec__func_FILTER-CLEANING-magic_quotes_filter__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/470/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/470/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/470/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/470/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/471/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/471/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/471/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/471/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/472/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/472/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/472/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/472/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/473/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/473/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/473/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/473/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/474/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/474/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/474/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/474/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/475/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/475/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/475/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/475/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/476/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/476/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/476/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/476/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/477/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/477/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/477/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/477/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/478/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/478/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/478/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/478/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/479/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/479/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/479/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/479/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/480/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/480/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/480/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/480/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/481/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/481/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/481/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/481/CWE_90__exec__func_FILTER-CLEANING-magic_quotes_filter__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/482/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/482/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/482/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/482/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/483/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/483/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/483/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/483/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/484/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/484/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/484/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/484/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/485/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/485/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/485/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/485/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/486/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/486/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/486/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/486/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/487/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/487/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/487/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/487/CWE_89__exec__func_FILTER-CLEANING-magic_quotes_filter__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/488/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/488/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/488/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/488/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/489/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/489/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/489/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/489/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/490/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/490/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/490/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/490/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/491/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/491/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/491/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/491/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/492/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/492/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/492/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/492/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/493/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/493/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/493/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/493/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/494/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/494/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/494/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/494/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/495/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/495/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/495/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/495/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/496/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/496/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/496/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/496/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/497/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/497/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/497/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/497/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/498/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/498/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/498/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/498/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/499/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/499/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/499/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/499/CWE_91__exec__func_FILTER-CLEANING-magic_quotes_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/500/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/500/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/500/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/500/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/501/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/501/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/501/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/501/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/502/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/502/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/502/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/502/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/503/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/503/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/503/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/503/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/504/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/504/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/504/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/504/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/505/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/505/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/505/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/505/CWE_98__exec__func_FILTER-CLEANING-number_float_filter__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/506/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/506/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/506/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/506/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/507/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/507/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/507/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/507/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/508/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/508/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/508/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/508/CWE_95__exec__func_FILTER-CLEANING-number_float_filter__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/509/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/509/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/509/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/509/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/510/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/510/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/510/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/510/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/511/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/511/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/511/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/511/CWE_78__exec__func_FILTER-CLEANING-number_float_filter__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/512/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/512/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/512/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/512/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/513/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/513/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/513/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/513/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/514/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/514/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/514/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/514/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/515/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/515/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/515/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/515/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/516/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/516/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/516/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/516/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/517/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/517/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/517/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/517/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/518/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/518/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/518/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/518/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/519/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/519/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/519/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/519/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/520/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/520/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/520/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/520/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/521/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/521/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/521/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/521/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/522/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/522/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/522/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/522/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/523/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/523/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/523/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/523/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/524/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/524/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/524/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/524/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/525/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/525/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/525/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/525/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/526/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/526/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/526/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/526/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/527/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/527/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/527/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/527/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/528/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/528/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/528/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/528/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/529/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/529/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/529/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/529/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/530/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/530/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/530/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/530/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/531/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/531/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/531/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/531/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/532/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/532/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/532/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/532/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/533/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/533/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/533/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/533/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/534/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/534/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/534/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/534/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/535/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/535/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/535/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/535/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/536/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/536/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/536/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/536/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/537/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/537/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/537/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/537/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/538/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/538/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/538/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/538/CWE_89__exec__func_FILTER-CLEANING-number_float_filter__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/539/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation.php");
$framework->add_output("./tests/sard/539/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/539/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/539/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/540/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/540/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/540/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/540/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/541/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation.php");
$framework->add_output("./tests/sard/541/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/541/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/541/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/542/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/542/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/542/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/542/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/543/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/543/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/543/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/543/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/544/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/544/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/544/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/544/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/545/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/545/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/545/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/545/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/546/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/546/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/546/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/546/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/547/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/547/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/547/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/547/CWE_91__exec__func_FILTER-CLEANING-number_float_filter__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/548/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/548/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/548/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/548/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/549/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/549/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/549/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/549/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/550/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/550/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/550/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/550/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/551/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/551/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/551/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/551/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/552/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/552/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/552/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/552/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/553/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/553/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/553/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/553/CWE_98__exec__func_FILTER-CLEANING-number_int_filter__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/554/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/554/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/554/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/554/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/555/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/555/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/555/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/555/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/556/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/556/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/556/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/556/CWE_95__exec__func_FILTER-CLEANING-number_int_filter__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/557/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/557/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/557/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/557/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/558/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/558/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/558/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/558/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/559/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/559/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/559/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/559/CWE_78__exec__func_FILTER-CLEANING-number_int_filter__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/560/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/560/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/560/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/560/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/561/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/561/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/561/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/561/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/562/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/562/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/562/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/562/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/563/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/563/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/563/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/563/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/564/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/564/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/564/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/564/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/565/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/565/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/565/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/565/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/566/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/566/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/566/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/566/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/567/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/567/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/567/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/567/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/568/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/568/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/568/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/568/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/569/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/569/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/569/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/569/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/570/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/570/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/570/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/570/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/571/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/571/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/571/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/571/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/572/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/572/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/572/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/572/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/573/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/573/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/573/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/573/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/574/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/574/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/574/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/574/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/575/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/575/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/575/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/575/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/576/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/576/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/576/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/576/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/577/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/577/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/577/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/577/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/578/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/578/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/578/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/578/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/579/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/579/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/579/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/579/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/580/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/580/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/580/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/580/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/581/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/581/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/581/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/581/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/582/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/582/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/582/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/582/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/583/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/583/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/583/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/583/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/584/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/584/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/584/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/584/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/585/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/585/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/585/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/585/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/586/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/586/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/586/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/586/CWE_89__exec__func_FILTER-CLEANING-number_int_filter__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/587/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation.php");
$framework->add_output("./tests/sard/587/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/587/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/587/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/588/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/588/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/588/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/588/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/589/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation.php");
$framework->add_output("./tests/sard/589/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/589/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/589/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/590/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/590/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/590/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/590/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/591/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/591/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/591/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/591/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/592/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/592/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/592/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/592/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/593/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/593/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/593/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/593/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/594/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/594/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/594/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/594/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/595/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/595/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/595/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/595/CWE_91__exec__func_FILTER-CLEANING-number_int_filter__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/596/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/596/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/596/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/596/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/597/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/597/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/597/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/597/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/598/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/598/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/598/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/598/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/599/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/599/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/599/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/599/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/600/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/600/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/600/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/600/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/601/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/601/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/601/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/601/CWE_98__exec__func_FILTER-CLEANING-special_chars_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/602/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/602/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/602/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/602/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/603/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/603/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/603/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/603/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/604/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/604/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/604/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/604/CWE_95__exec__func_FILTER-CLEANING-special_chars_filter__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/605/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/605/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/605/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/605/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/606/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/606/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/606/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/606/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/607/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/607/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/607/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/607/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/608/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/608/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/608/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/608/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/609/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/609/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/609/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/609/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/610/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/610/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/610/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/610/CWE_78__exec__func_FILTER-CLEANING-special_chars_filter__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/611/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/611/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/611/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/611/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/612/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/612/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/612/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/612/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/613/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/613/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/613/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/613/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/614/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/614/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/614/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/614/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/615/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/615/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/615/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/615/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/616/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/616/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/616/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/616/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/617/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/617/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/617/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/617/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/618/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/618/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/618/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/618/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/619/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/619/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/619/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/619/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/620/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/620/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/620/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/620/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/621/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/621/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/621/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/621/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/622/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/622/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/622/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/622/CWE_90__exec__func_FILTER-CLEANING-special_chars_filter__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/623/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/623/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/623/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/623/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/624/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/624/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/624/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/624/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/625/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/625/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/625/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/625/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/626/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/626/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/626/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/626/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/627/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/627/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/627/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/627/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/628/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/628/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/628/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/628/CWE_89__exec__func_FILTER-CLEANING-special_chars_filter__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/629/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/629/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/629/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/629/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/630/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/630/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/630/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/630/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/631/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/631/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/631/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/631/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/632/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/632/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/632/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/632/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/633/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/633/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/633/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/633/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/634/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/634/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/634/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/634/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/635/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/635/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/635/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/635/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/636/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/636/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/636/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/636/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/637/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/637/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/637/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/637/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/638/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/638/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/638/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/638/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/639/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/639/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/639/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/639/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/640/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/640/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/640/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/640/CWE_91__exec__func_FILTER-CLEANING-special_chars_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/641/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/641/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/641/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/641/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/642/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/642/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/642/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/642/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/643/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/643/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/643/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/643/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/644/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/644/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/644/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/644/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/645/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/645/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/645/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/645/CWE_98__exec__func_FILTER-VALIDATION-email_filter__include_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/646/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/646/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/646/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/646/CWE_98__exec__func_FILTER-VALIDATION-email_filter__require_file_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/647/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/647/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/647/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/647/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/648/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/648/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/648/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/648/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/649/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/649/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/649/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/649/CWE_95__exec__func_FILTER-VALIDATION-email_filter__echo-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/650/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/650/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/650/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/650/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/651/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/651/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/651/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/651/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/652/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/652/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/652/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/652/CWE_78__exec__func_FILTER-VALIDATION-email_filter__ls-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/653/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/653/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/653/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/653/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/654/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/654/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/654/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/654/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/655/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/655/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/655/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/655/CWE_78__exec__func_FILTER-VALIDATION-email_filter__cat-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/656/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/656/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/656/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/656/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/657/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/657/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/657/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/657/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/658/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/658/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/658/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/658/CWE_90__exec__func_FILTER-VALIDATION-email_filter__name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/659/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/659/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/659/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/659/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/660/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/660/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/660/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/660/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/661/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/661/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/661/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/661/CWE_90__exec__func_FILTER-VALIDATION-email_filter__not_name-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/662/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/662/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/662/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/662/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/663/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/663/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/663/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/663/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/664/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/664/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/664/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/664/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByCN-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/665/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/665/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/665/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/665/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/666/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/666/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/666/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/666/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/667/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/667/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/667/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/667/CWE_90__exec__func_FILTER-VALIDATION-email_filter__userByMail-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/668/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/668/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/668/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/668/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/669/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/669/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/669/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/669/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/670/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/670/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/670/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/670/CWE_89__exec__func_FILTER-VALIDATION-email_filter__select_from-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/671/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/671/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/671/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/671/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/672/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/672/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/672/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/672/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/673/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/673/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/673/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/673/CWE_89__exec__func_FILTER-VALIDATION-email_filter__join-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/674/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/674/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/674/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/674/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/675/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/675/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/675/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/675/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/676/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/676/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/676/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/676/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_text-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/677/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/677/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/677/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/677/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/678/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/678/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/678/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/678/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/679/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/679/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/679/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/679/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/680/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/680/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/680/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/680/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/681/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/681/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/681/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/681/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/682/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/682/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/682/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/682/CWE_91__exec__func_FILTER-VALIDATION-email_filter__data-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/683/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/683/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/683/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/683/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/684/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/684/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/684/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/684/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/685/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/685/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/685/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/685/CWE_91__exec__func_FILTER-VALIDATION-email_filter__username-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/686/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/686/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/686/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/686/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/687/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/687/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/687/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/687/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/688/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/688/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/688/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/688/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/689/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/689/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/689/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/689/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/690/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/690/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/690/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/690/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/691/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/691/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/691/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/691/CWE_98__exec__func_FILTER-VALIDATION-number_float_filter__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/692/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/692/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/692/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/692/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/693/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/693/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/693/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/693/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/694/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/694/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/694/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/694/CWE_95__exec__func_FILTER-VALIDATION-number_float_filter__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/695/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/695/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/695/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/695/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/696/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/696/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/696/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/696/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/697/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/697/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/697/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/697/CWE_78__exec__func_FILTER-VALIDATION-number_float_filter__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/698/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/698/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/698/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/698/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/699/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/699/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/699/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/699/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/700/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/700/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/700/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/700/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/701/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/701/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/701/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/701/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/702/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/702/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/702/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/702/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/703/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/703/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/703/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/703/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/704/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/704/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/704/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/704/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/705/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/705/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/705/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/705/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/706/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/706/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/706/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/706/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/707/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/707/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/707/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/707/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/708/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/708/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/708/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/708/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/709/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/709/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/709/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/709/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/710/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/710/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/710/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/710/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/711/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/711/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/711/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/711/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/712/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/712/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/712/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/712/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/713/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/713/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/713/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/713/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/714/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/714/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/714/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/714/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/715/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/715/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/715/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/715/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/716/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/716/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/716/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/716/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/717/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/717/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/717/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/717/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/718/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/718/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/718/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/718/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/719/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/719/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/719/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/719/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/720/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/720/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/720/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/720/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/721/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/721/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/721/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/721/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/722/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/722/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/722/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/722/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/723/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/723/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/723/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/723/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/724/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/724/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/724/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/724/CWE_89__exec__func_FILTER-VALIDATION-number_float_filter__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/725/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation.php");
$framework->add_output("./tests/sard/725/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/725/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/725/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/726/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/726/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/726/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/726/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/727/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-interpretation.php");
$framework->add_output("./tests/sard/727/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/727/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/727/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/728/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/728/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/728/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/728/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/729/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/729/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/729/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/729/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/730/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/730/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/730/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/730/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/731/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/731/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/731/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/731/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/732/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/732/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/732/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/732/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/733/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/733/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/733/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/733/CWE_91__exec__func_FILTER-VALIDATION-number_float_filter__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/734/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/734/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/734/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/734/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/735/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/735/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/735/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/735/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/736/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/736/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/736/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/736/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/737/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/737/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/737/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/737/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/738/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/738/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/738/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/738/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/739/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/739/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/739/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/739/CWE_98__exec__func_FILTER-VALIDATION-number_int_filter__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/740/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/740/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/740/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/740/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/741/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/741/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/741/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/741/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/742/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/742/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/742/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/742/CWE_95__exec__func_FILTER-VALIDATION-number_int_filter__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/743/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/743/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/743/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/743/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/744/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/744/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/744/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/744/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/745/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/745/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/745/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/745/CWE_78__exec__func_FILTER-VALIDATION-number_int_filter__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/746/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/746/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/746/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/746/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/747/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/747/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/747/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/747/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/748/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/748/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/748/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/748/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/749/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/749/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/749/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/749/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/750/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/750/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/750/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/750/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/751/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/751/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/751/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/751/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/752/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/752/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/752/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/752/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/753/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/753/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/753/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/753/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/754/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/754/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/754/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/754/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/755/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/755/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/755/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/755/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/756/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/756/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/756/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/756/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/757/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/757/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/757/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/757/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/758/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/758/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/758/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/758/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/759/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/759/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/759/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/759/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/760/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/760/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/760/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/760/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/761/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/761/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/761/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/761/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/762/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/762/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/762/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/762/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/763/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/763/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/763/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/763/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/764/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/764/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/764/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/764/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/765/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/765/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/765/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/765/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/766/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/766/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/766/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/766/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/767/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/767/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/767/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/767/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/768/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/768/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/768/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/768/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/769/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/769/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/769/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/769/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/770/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/770/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/770/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/770/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/771/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/771/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/771/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/771/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/772/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/772/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/772/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/772/CWE_89__exec__func_FILTER-VALIDATION-number_int_filter__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/773/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation.php");
$framework->add_output("./tests/sard/773/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/773/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/773/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/774/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/774/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/774/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/774/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/775/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation.php");
$framework->add_output("./tests/sard/775/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/775/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/775/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/776/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/776/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/776/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/776/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/777/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/777/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/777/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/777/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/778/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/778/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/778/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/778/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/779/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/779/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/779/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/779/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/780/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/780/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/780/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/780/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/781/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/781/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/781/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/781/CWE_91__exec__func_FILTER-VALIDATION-number_int_filter__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/782/CWE_98__exec__CAST-cast_float__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/782/CWE_98__exec__CAST-cast_float__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/782/CWE_98__exec__CAST-cast_float__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/782/CWE_98__exec__CAST-cast_float__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/783/CWE_98__exec__CAST-cast_float__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/783/CWE_98__exec__CAST-cast_float__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/783/CWE_98__exec__CAST-cast_float__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/783/CWE_98__exec__CAST-cast_float__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/784/CWE_98__exec__CAST-cast_float__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/784/CWE_98__exec__CAST-cast_float__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/784/CWE_98__exec__CAST-cast_float__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/784/CWE_98__exec__CAST-cast_float__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/785/CWE_98__exec__CAST-cast_float__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/785/CWE_98__exec__CAST-cast_float__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/785/CWE_98__exec__CAST-cast_float__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/785/CWE_98__exec__CAST-cast_float__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/786/CWE_98__exec__CAST-cast_float__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/786/CWE_98__exec__CAST-cast_float__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/786/CWE_98__exec__CAST-cast_float__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/786/CWE_98__exec__CAST-cast_float__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/787/CWE_98__exec__CAST-cast_float__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/787/CWE_98__exec__CAST-cast_float__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/787/CWE_98__exec__CAST-cast_float__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/787/CWE_98__exec__CAST-cast_float__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/788/CWE_95__exec__CAST-cast_float__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/788/CWE_95__exec__CAST-cast_float__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/788/CWE_95__exec__CAST-cast_float__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/788/CWE_95__exec__CAST-cast_float__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/789/CWE_95__exec__CAST-cast_float__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/789/CWE_95__exec__CAST-cast_float__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/789/CWE_95__exec__CAST-cast_float__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/789/CWE_95__exec__CAST-cast_float__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/790/CWE_95__exec__CAST-cast_float__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/790/CWE_95__exec__CAST-cast_float__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/790/CWE_95__exec__CAST-cast_float__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/790/CWE_95__exec__CAST-cast_float__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/791/CWE_78__exec__CAST-cast_float__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/791/CWE_78__exec__CAST-cast_float__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/791/CWE_78__exec__CAST-cast_float__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/791/CWE_78__exec__CAST-cast_float__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/792/CWE_78__exec__CAST-cast_float__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/792/CWE_78__exec__CAST-cast_float__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/792/CWE_78__exec__CAST-cast_float__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/792/CWE_78__exec__CAST-cast_float__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/793/CWE_78__exec__CAST-cast_float__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/793/CWE_78__exec__CAST-cast_float__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/793/CWE_78__exec__CAST-cast_float__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/793/CWE_78__exec__CAST-cast_float__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/794/CWE_89__exec__CAST-cast_float__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/794/CWE_89__exec__CAST-cast_float__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/794/CWE_89__exec__CAST-cast_float__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/794/CWE_89__exec__CAST-cast_float__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/795/CWE_89__exec__CAST-cast_float__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/795/CWE_89__exec__CAST-cast_float__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/795/CWE_89__exec__CAST-cast_float__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/795/CWE_89__exec__CAST-cast_float__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/796/CWE_89__exec__CAST-cast_float__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/796/CWE_89__exec__CAST-cast_float__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/796/CWE_89__exec__CAST-cast_float__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/796/CWE_89__exec__CAST-cast_float__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/797/CWE_89__exec__CAST-cast_float__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/797/CWE_89__exec__CAST-cast_float__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/797/CWE_89__exec__CAST-cast_float__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/797/CWE_89__exec__CAST-cast_float__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/798/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/798/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/798/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/798/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/799/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/799/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/799/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/799/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/800/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/800/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/800/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/800/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/801/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/801/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/801/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/801/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/802/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/802/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/802/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/802/CWE_89__exec__CAST-cast_float__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/803/CWE_89__exec__CAST-cast_float__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/803/CWE_89__exec__CAST-cast_float__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/803/CWE_89__exec__CAST-cast_float__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/803/CWE_89__exec__CAST-cast_float__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/804/CWE_89__exec__CAST-cast_float__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/804/CWE_89__exec__CAST-cast_float__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/804/CWE_89__exec__CAST-cast_float__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/804/CWE_89__exec__CAST-cast_float__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/805/CWE_89__exec__CAST-cast_float__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/805/CWE_89__exec__CAST-cast_float__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/805/CWE_89__exec__CAST-cast_float__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/805/CWE_89__exec__CAST-cast_float__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/806/CWE_89__exec__CAST-cast_float__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/806/CWE_89__exec__CAST-cast_float__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/806/CWE_89__exec__CAST-cast_float__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/806/CWE_89__exec__CAST-cast_float__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/807/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/807/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/807/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/807/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/808/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/808/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/808/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/808/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/809/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/809/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/809/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/809/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/810/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/810/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/810/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/810/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/811/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/811/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/811/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/811/CWE_89__exec__CAST-cast_float__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/812/CWE_89__exec__CAST-cast_float__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/812/CWE_89__exec__CAST-cast_float__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/812/CWE_89__exec__CAST-cast_float__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/812/CWE_89__exec__CAST-cast_float__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/813/CWE_89__exec__CAST-cast_float__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/813/CWE_89__exec__CAST-cast_float__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/813/CWE_89__exec__CAST-cast_float__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/813/CWE_89__exec__CAST-cast_float__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/814/CWE_89__exec__CAST-cast_float__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/814/CWE_89__exec__CAST-cast_float__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/814/CWE_89__exec__CAST-cast_float__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/814/CWE_89__exec__CAST-cast_float__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/815/CWE_89__exec__CAST-cast_float__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/815/CWE_89__exec__CAST-cast_float__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/815/CWE_89__exec__CAST-cast_float__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/815/CWE_89__exec__CAST-cast_float__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/816/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/816/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/816/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/816/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/817/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/817/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/817/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/817/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/818/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/818/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/818/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/818/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/819/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/819/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/819/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/819/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/820/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/820/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/820/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/820/CWE_89__exec__CAST-cast_float__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/821/CWE_91__exec__CAST-cast_float__ID_test-concatenation.php");
$framework->add_output("./tests/sard/821/CWE_91__exec__CAST-cast_float__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/821/CWE_91__exec__CAST-cast_float__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/821/CWE_91__exec__CAST-cast_float__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/822/CWE_91__exec__CAST-cast_float__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/822/CWE_91__exec__CAST-cast_float__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/822/CWE_91__exec__CAST-cast_float__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/822/CWE_91__exec__CAST-cast_float__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/823/CWE_91__exec__CAST-cast_float__ID_test-interpretation.php");
$framework->add_output("./tests/sard/823/CWE_91__exec__CAST-cast_float__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/823/CWE_91__exec__CAST-cast_float__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/823/CWE_91__exec__CAST-cast_float__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/824/CWE_91__exec__CAST-cast_float__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/824/CWE_91__exec__CAST-cast_float__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/824/CWE_91__exec__CAST-cast_float__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/824/CWE_91__exec__CAST-cast_float__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/825/CWE_91__exec__CAST-cast_float__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/825/CWE_91__exec__CAST-cast_float__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/825/CWE_91__exec__CAST-cast_float__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/825/CWE_91__exec__CAST-cast_float__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/826/CWE_91__exec__CAST-cast_float__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/826/CWE_91__exec__CAST-cast_float__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/826/CWE_91__exec__CAST-cast_float__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/826/CWE_91__exec__CAST-cast_float__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/827/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/827/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/827/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/827/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/828/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/828/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/828/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/828/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/829/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/829/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/829/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/829/CWE_91__exec__CAST-cast_float__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/830/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/830/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/830/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/830/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/831/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/831/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/831/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/831/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/832/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/832/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/832/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/832/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/833/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/833/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/833/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/833/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/834/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/834/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/834/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/834/CWE_98__exec__CAST-cast_float_sort_of__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/835/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/835/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/835/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/835/CWE_98__exec__CAST-cast_float_sort_of__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/836/CWE_95__exec__CAST-cast_float_sort_of__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/836/CWE_95__exec__CAST-cast_float_sort_of__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/836/CWE_95__exec__CAST-cast_float_sort_of__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/836/CWE_95__exec__CAST-cast_float_sort_of__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/837/CWE_95__exec__CAST-cast_float_sort_of__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/837/CWE_95__exec__CAST-cast_float_sort_of__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/837/CWE_95__exec__CAST-cast_float_sort_of__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/837/CWE_95__exec__CAST-cast_float_sort_of__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/838/CWE_95__exec__CAST-cast_float_sort_of__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/838/CWE_95__exec__CAST-cast_float_sort_of__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/838/CWE_95__exec__CAST-cast_float_sort_of__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/838/CWE_95__exec__CAST-cast_float_sort_of__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/839/CWE_78__exec__CAST-cast_float_sort_of__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/839/CWE_78__exec__CAST-cast_float_sort_of__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/839/CWE_78__exec__CAST-cast_float_sort_of__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/839/CWE_78__exec__CAST-cast_float_sort_of__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/840/CWE_78__exec__CAST-cast_float_sort_of__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/840/CWE_78__exec__CAST-cast_float_sort_of__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/840/CWE_78__exec__CAST-cast_float_sort_of__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/840/CWE_78__exec__CAST-cast_float_sort_of__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/841/CWE_78__exec__CAST-cast_float_sort_of__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/841/CWE_78__exec__CAST-cast_float_sort_of__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/841/CWE_78__exec__CAST-cast_float_sort_of__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/841/CWE_78__exec__CAST-cast_float_sort_of__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/842/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/842/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/842/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/842/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/843/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/843/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/843/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/843/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/844/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/844/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/844/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/844/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/845/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/845/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/845/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/845/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/846/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/846/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/846/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/846/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/847/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/847/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/847/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/847/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/848/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/848/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/848/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/848/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/849/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/849/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/849/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/849/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/850/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/850/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/850/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/850/CWE_89__exec__CAST-cast_float_sort_of__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/851/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/851/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/851/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/851/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/852/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/852/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/852/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/852/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/853/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/853/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/853/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/853/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/854/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/854/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/854/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/854/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/855/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/855/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/855/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/855/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/856/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/856/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/856/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/856/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/857/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/857/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/857/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/857/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/858/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/858/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/858/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/858/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/859/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/859/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/859/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/859/CWE_89__exec__CAST-cast_float_sort_of__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/860/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/860/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/860/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/860/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/861/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/861/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/861/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/861/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/862/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/862/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/862/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/862/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/863/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/863/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/863/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/863/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/864/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/864/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/864/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/864/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/865/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/865/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/865/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/865/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/866/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/866/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/866/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/866/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/867/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/867/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/867/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/867/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/868/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/868/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/868/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/868/CWE_89__exec__CAST-cast_float_sort_of__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/869/CWE_91__exec__CAST-cast_float_sort_of__ID_test-concatenation.php");
$framework->add_output("./tests/sard/869/CWE_91__exec__CAST-cast_float_sort_of__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/869/CWE_91__exec__CAST-cast_float_sort_of__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/869/CWE_91__exec__CAST-cast_float_sort_of__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/870/CWE_91__exec__CAST-cast_float_sort_of__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/870/CWE_91__exec__CAST-cast_float_sort_of__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/870/CWE_91__exec__CAST-cast_float_sort_of__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/870/CWE_91__exec__CAST-cast_float_sort_of__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/871/CWE_91__exec__CAST-cast_float_sort_of__ID_test-interpretation.php");
$framework->add_output("./tests/sard/871/CWE_91__exec__CAST-cast_float_sort_of__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/871/CWE_91__exec__CAST-cast_float_sort_of__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/871/CWE_91__exec__CAST-cast_float_sort_of__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/872/CWE_91__exec__CAST-cast_float_sort_of__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/872/CWE_91__exec__CAST-cast_float_sort_of__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/872/CWE_91__exec__CAST-cast_float_sort_of__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/872/CWE_91__exec__CAST-cast_float_sort_of__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/873/CWE_91__exec__CAST-cast_float_sort_of__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/873/CWE_91__exec__CAST-cast_float_sort_of__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/873/CWE_91__exec__CAST-cast_float_sort_of__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/873/CWE_91__exec__CAST-cast_float_sort_of__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/874/CWE_91__exec__CAST-cast_float_sort_of__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/874/CWE_91__exec__CAST-cast_float_sort_of__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/874/CWE_91__exec__CAST-cast_float_sort_of__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/874/CWE_91__exec__CAST-cast_float_sort_of__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/875/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/875/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/875/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/875/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/876/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/876/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/876/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/876/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/877/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/877/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/877/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/877/CWE_91__exec__CAST-cast_float_sort_of__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/878/CWE_98__exec__CAST-cast_int__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/878/CWE_98__exec__CAST-cast_int__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/878/CWE_98__exec__CAST-cast_int__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/878/CWE_98__exec__CAST-cast_int__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/879/CWE_98__exec__CAST-cast_int__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/879/CWE_98__exec__CAST-cast_int__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/879/CWE_98__exec__CAST-cast_int__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/879/CWE_98__exec__CAST-cast_int__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/880/CWE_98__exec__CAST-cast_int__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/880/CWE_98__exec__CAST-cast_int__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/880/CWE_98__exec__CAST-cast_int__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/880/CWE_98__exec__CAST-cast_int__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/881/CWE_98__exec__CAST-cast_int__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/881/CWE_98__exec__CAST-cast_int__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/881/CWE_98__exec__CAST-cast_int__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/881/CWE_98__exec__CAST-cast_int__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/882/CWE_98__exec__CAST-cast_int__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/882/CWE_98__exec__CAST-cast_int__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/882/CWE_98__exec__CAST-cast_int__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/882/CWE_98__exec__CAST-cast_int__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/883/CWE_98__exec__CAST-cast_int__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/883/CWE_98__exec__CAST-cast_int__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/883/CWE_98__exec__CAST-cast_int__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/883/CWE_98__exec__CAST-cast_int__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/884/CWE_95__exec__CAST-cast_int__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/884/CWE_95__exec__CAST-cast_int__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/884/CWE_95__exec__CAST-cast_int__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/884/CWE_95__exec__CAST-cast_int__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/885/CWE_95__exec__CAST-cast_int__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/885/CWE_95__exec__CAST-cast_int__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/885/CWE_95__exec__CAST-cast_int__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/885/CWE_95__exec__CAST-cast_int__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/886/CWE_95__exec__CAST-cast_int__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/886/CWE_95__exec__CAST-cast_int__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/886/CWE_95__exec__CAST-cast_int__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/886/CWE_95__exec__CAST-cast_int__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/887/CWE_78__exec__CAST-cast_int__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/887/CWE_78__exec__CAST-cast_int__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/887/CWE_78__exec__CAST-cast_int__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/887/CWE_78__exec__CAST-cast_int__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/888/CWE_78__exec__CAST-cast_int__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/888/CWE_78__exec__CAST-cast_int__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/888/CWE_78__exec__CAST-cast_int__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/888/CWE_78__exec__CAST-cast_int__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/889/CWE_78__exec__CAST-cast_int__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/889/CWE_78__exec__CAST-cast_int__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/889/CWE_78__exec__CAST-cast_int__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/889/CWE_78__exec__CAST-cast_int__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/890/CWE_89__exec__CAST-cast_int__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/890/CWE_89__exec__CAST-cast_int__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/890/CWE_89__exec__CAST-cast_int__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/890/CWE_89__exec__CAST-cast_int__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/891/CWE_89__exec__CAST-cast_int__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/891/CWE_89__exec__CAST-cast_int__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/891/CWE_89__exec__CAST-cast_int__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/891/CWE_89__exec__CAST-cast_int__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/892/CWE_89__exec__CAST-cast_int__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/892/CWE_89__exec__CAST-cast_int__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/892/CWE_89__exec__CAST-cast_int__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/892/CWE_89__exec__CAST-cast_int__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/893/CWE_89__exec__CAST-cast_int__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/893/CWE_89__exec__CAST-cast_int__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/893/CWE_89__exec__CAST-cast_int__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/893/CWE_89__exec__CAST-cast_int__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/894/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/894/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/894/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/894/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/895/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/895/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/895/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/895/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/896/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/896/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/896/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/896/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/897/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/897/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/897/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/897/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/898/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/898/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/898/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/898/CWE_89__exec__CAST-cast_int__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/899/CWE_89__exec__CAST-cast_int__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/899/CWE_89__exec__CAST-cast_int__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/899/CWE_89__exec__CAST-cast_int__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/899/CWE_89__exec__CAST-cast_int__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/900/CWE_89__exec__CAST-cast_int__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/900/CWE_89__exec__CAST-cast_int__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/900/CWE_89__exec__CAST-cast_int__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/900/CWE_89__exec__CAST-cast_int__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/901/CWE_89__exec__CAST-cast_int__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/901/CWE_89__exec__CAST-cast_int__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/901/CWE_89__exec__CAST-cast_int__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/901/CWE_89__exec__CAST-cast_int__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/902/CWE_89__exec__CAST-cast_int__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/902/CWE_89__exec__CAST-cast_int__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/902/CWE_89__exec__CAST-cast_int__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/902/CWE_89__exec__CAST-cast_int__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/903/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/903/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/903/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/903/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/904/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/904/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/904/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/904/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/905/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/905/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/905/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/905/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/906/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/906/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/906/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/906/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/907/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/907/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/907/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/907/CWE_89__exec__CAST-cast_int__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/908/CWE_89__exec__CAST-cast_int__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/908/CWE_89__exec__CAST-cast_int__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/908/CWE_89__exec__CAST-cast_int__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/908/CWE_89__exec__CAST-cast_int__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/909/CWE_89__exec__CAST-cast_int__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/909/CWE_89__exec__CAST-cast_int__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/909/CWE_89__exec__CAST-cast_int__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/909/CWE_89__exec__CAST-cast_int__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/910/CWE_89__exec__CAST-cast_int__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/910/CWE_89__exec__CAST-cast_int__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/910/CWE_89__exec__CAST-cast_int__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/910/CWE_89__exec__CAST-cast_int__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/911/CWE_89__exec__CAST-cast_int__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/911/CWE_89__exec__CAST-cast_int__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/911/CWE_89__exec__CAST-cast_int__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/911/CWE_89__exec__CAST-cast_int__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/912/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/912/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/912/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/912/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/913/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/913/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/913/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/913/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/914/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/914/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/914/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/914/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/915/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/915/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/915/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/915/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/916/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/916/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/916/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/916/CWE_89__exec__CAST-cast_int__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/917/CWE_91__exec__CAST-cast_int__ID_test-concatenation.php");
$framework->add_output("./tests/sard/917/CWE_91__exec__CAST-cast_int__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/917/CWE_91__exec__CAST-cast_int__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/917/CWE_91__exec__CAST-cast_int__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/918/CWE_91__exec__CAST-cast_int__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/918/CWE_91__exec__CAST-cast_int__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/918/CWE_91__exec__CAST-cast_int__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/918/CWE_91__exec__CAST-cast_int__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/919/CWE_91__exec__CAST-cast_int__ID_test-interpretation.php");
$framework->add_output("./tests/sard/919/CWE_91__exec__CAST-cast_int__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/919/CWE_91__exec__CAST-cast_int__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/919/CWE_91__exec__CAST-cast_int__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/920/CWE_91__exec__CAST-cast_int__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/920/CWE_91__exec__CAST-cast_int__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/920/CWE_91__exec__CAST-cast_int__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/920/CWE_91__exec__CAST-cast_int__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/921/CWE_91__exec__CAST-cast_int__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/921/CWE_91__exec__CAST-cast_int__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/921/CWE_91__exec__CAST-cast_int__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/921/CWE_91__exec__CAST-cast_int__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/922/CWE_91__exec__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/922/CWE_91__exec__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/922/CWE_91__exec__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/922/CWE_91__exec__CAST-cast_int__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/923/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/923/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/923/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/923/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/924/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/924/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/924/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/924/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/925/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/925/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/925/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/925/CWE_91__exec__CAST-cast_int__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/926/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/926/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/926/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/926/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/927/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/927/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/927/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/927/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/928/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/928/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/928/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/928/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/929/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/929/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/929/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/929/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/930/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/930/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/930/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/930/CWE_98__exec__CAST-cast_int_sort_of__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/931/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/931/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/931/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/931/CWE_98__exec__CAST-cast_int_sort_of__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/932/CWE_95__exec__CAST-cast_int_sort_of__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/932/CWE_95__exec__CAST-cast_int_sort_of__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/932/CWE_95__exec__CAST-cast_int_sort_of__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/932/CWE_95__exec__CAST-cast_int_sort_of__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/933/CWE_95__exec__CAST-cast_int_sort_of__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/933/CWE_95__exec__CAST-cast_int_sort_of__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/933/CWE_95__exec__CAST-cast_int_sort_of__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/933/CWE_95__exec__CAST-cast_int_sort_of__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/934/CWE_95__exec__CAST-cast_int_sort_of__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/934/CWE_95__exec__CAST-cast_int_sort_of__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/934/CWE_95__exec__CAST-cast_int_sort_of__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/934/CWE_95__exec__CAST-cast_int_sort_of__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/935/CWE_78__exec__CAST-cast_int_sort_of__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/935/CWE_78__exec__CAST-cast_int_sort_of__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/935/CWE_78__exec__CAST-cast_int_sort_of__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/935/CWE_78__exec__CAST-cast_int_sort_of__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/936/CWE_78__exec__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/936/CWE_78__exec__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/936/CWE_78__exec__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/936/CWE_78__exec__CAST-cast_int_sort_of__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/937/CWE_78__exec__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/937/CWE_78__exec__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/937/CWE_78__exec__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/937/CWE_78__exec__CAST-cast_int_sort_of__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/938/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/938/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/938/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/938/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/939/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/939/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/939/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/939/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/940/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/940/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/940/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/940/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/941/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/941/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/941/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/941/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/942/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/942/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/942/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/942/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/943/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/943/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/943/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/943/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/944/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/944/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/944/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/944/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/945/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/945/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/945/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/945/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/946/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/946/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/946/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/946/CWE_89__exec__CAST-cast_int_sort_of__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/947/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/947/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/947/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/947/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/948/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/948/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/948/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/948/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/949/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/949/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/949/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/949/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/950/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/950/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/950/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/950/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/951/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/951/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/951/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/951/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/952/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/952/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/952/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/952/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/953/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/953/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/953/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/953/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/954/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%u.php");
$framework->add_output("./tests/sard/954/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/954/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/954/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/955/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/955/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/955/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/955/CWE_89__exec__CAST-cast_int_sort_of__multiple_select-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/956/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-concatenation.php");
$framework->add_output("./tests/sard/956/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/956/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-concatenation.php", array("49"));
$framework->add_output("./tests/sard/956/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/957/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/957/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/957/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/957/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/958/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-interpretation.php");
$framework->add_output("./tests/sard/958/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/958/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-interpretation.php", array("49"));
$framework->add_output("./tests/sard/958/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/959/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/959/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/959/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/959/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/960/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%d.php");
$framework->add_output("./tests/sard/960/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/960/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/960/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/961/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/961/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/961/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/961/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/962/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/962/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/962/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/962/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/963/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%u.php");
$framework->add_output("./tests/sard/963/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/963/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/963/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/964/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/964/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/964/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/964/CWE_89__exec__CAST-cast_int_sort_of__multiple_AS-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/965/CWE_91__exec__CAST-cast_int_sort_of__ID_test-concatenation.php");
$framework->add_output("./tests/sard/965/CWE_91__exec__CAST-cast_int_sort_of__ID_test-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/965/CWE_91__exec__CAST-cast_int_sort_of__ID_test-concatenation.php", array("49"));
$framework->add_output("./tests/sard/965/CWE_91__exec__CAST-cast_int_sort_of__ID_test-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/966/CWE_91__exec__CAST-cast_int_sort_of__ID_test-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/966/CWE_91__exec__CAST-cast_int_sort_of__ID_test-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/966/CWE_91__exec__CAST-cast_int_sort_of__ID_test-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/966/CWE_91__exec__CAST-cast_int_sort_of__ID_test-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/967/CWE_91__exec__CAST-cast_int_sort_of__ID_test-interpretation.php");
$framework->add_output("./tests/sard/967/CWE_91__exec__CAST-cast_int_sort_of__ID_test-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/967/CWE_91__exec__CAST-cast_int_sort_of__ID_test-interpretation.php", array("49"));
$framework->add_output("./tests/sard/967/CWE_91__exec__CAST-cast_int_sort_of__ID_test-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/968/CWE_91__exec__CAST-cast_int_sort_of__ID_test-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/968/CWE_91__exec__CAST-cast_int_sort_of__ID_test-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/968/CWE_91__exec__CAST-cast_int_sort_of__ID_test-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/968/CWE_91__exec__CAST-cast_int_sort_of__ID_test-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/969/CWE_91__exec__CAST-cast_int_sort_of__ID_test-sprintf_%d.php");
$framework->add_output("./tests/sard/969/CWE_91__exec__CAST-cast_int_sort_of__ID_test-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/969/CWE_91__exec__CAST-cast_int_sort_of__ID_test-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/969/CWE_91__exec__CAST-cast_int_sort_of__ID_test-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/970/CWE_91__exec__CAST-cast_int_sort_of__ID_test-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/970/CWE_91__exec__CAST-cast_int_sort_of__ID_test-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/970/CWE_91__exec__CAST-cast_int_sort_of__ID_test-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/970/CWE_91__exec__CAST-cast_int_sort_of__ID_test-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/971/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/971/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/971/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/971/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/972/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%u.php");
$framework->add_output("./tests/sard/972/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/972/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/972/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/973/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/973/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/973/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/973/CWE_91__exec__CAST-cast_int_sort_of__ID_at-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/974/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/974/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/974/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/974/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/975/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/975/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/975/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/975/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/976/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/976/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/976/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/976/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/977/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/977/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/977/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/977/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/978/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/978/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/978/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/978/CWE_98__exec__CAST-cast_int_sort_of2__include_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/979/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/979/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/979/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/979/CWE_98__exec__CAST-cast_int_sort_of2__require_file_id-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/980/CWE_95__exec__CAST-cast_int_sort_of2__variable-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/980/CWE_95__exec__CAST-cast_int_sort_of2__variable-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/980/CWE_95__exec__CAST-cast_int_sort_of2__variable-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/980/CWE_95__exec__CAST-cast_int_sort_of2__variable-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/981/CWE_95__exec__CAST-cast_int_sort_of2__variable-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/981/CWE_95__exec__CAST-cast_int_sort_of2__variable-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/981/CWE_95__exec__CAST-cast_int_sort_of2__variable-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/981/CWE_95__exec__CAST-cast_int_sort_of2__variable-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/982/CWE_95__exec__CAST-cast_int_sort_of2__variable-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/982/CWE_95__exec__CAST-cast_int_sort_of2__variable-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/982/CWE_95__exec__CAST-cast_int_sort_of2__variable-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/982/CWE_95__exec__CAST-cast_int_sort_of2__variable-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/983/CWE_78__exec__CAST-cast_int_sort_of2__find_size-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/983/CWE_78__exec__CAST-cast_int_sort_of2__find_size-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/983/CWE_78__exec__CAST-cast_int_sort_of2__find_size-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/983/CWE_78__exec__CAST-cast_int_sort_of2__find_size-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/984/CWE_78__exec__CAST-cast_int_sort_of2__find_size-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/984/CWE_78__exec__CAST-cast_int_sort_of2__find_size-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/984/CWE_78__exec__CAST-cast_int_sort_of2__find_size-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/984/CWE_78__exec__CAST-cast_int_sort_of2__find_size-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/985/CWE_78__exec__CAST-cast_int_sort_of2__find_size-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/985/CWE_78__exec__CAST-cast_int_sort_of2__find_size-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/985/CWE_78__exec__CAST-cast_int_sort_of2__find_size-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/985/CWE_78__exec__CAST-cast_int_sort_of2__find_size-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/986/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-concatenation.php");
$framework->add_output("./tests/sard/986/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/986/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-concatenation.php", array("49"));
$framework->add_output("./tests/sard/986/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/987/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/987/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/987/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/987/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/988/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-interpretation.php");
$framework->add_output("./tests/sard/988/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/988/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-interpretation.php", array("49"));
$framework->add_output("./tests/sard/988/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/989/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/989/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/989/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/989/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/990/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%d.php");
$framework->add_output("./tests/sard/990/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/990/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/990/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%d.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/991/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%d_simple_quote.php");
$framework->add_output("./tests/sard/991/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%d_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/991/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%d_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/991/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%d_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/992/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%s_simple_quote.php");
$framework->add_output("./tests/sard/992/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%s_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/992/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%s_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/992/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%s_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/993/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%u.php");
$framework->add_output("./tests/sard/993/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%u.php", array("tainted"));
$framework->add_output("./tests/sard/993/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%u.php", array("49"));
$framework->add_output("./tests/sard/993/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%u.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/994/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%u_simple_quote.php");
$framework->add_output("./tests/sard/994/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%u_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/994/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%u_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/994/CWE_89__exec__CAST-cast_int_sort_of2__select_from_where-sprintf_%u_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/995/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-concatenation.php");
$framework->add_output("./tests/sard/995/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-concatenation.php", array("tainted"));
$framework->add_output("./tests/sard/995/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-concatenation.php", array("49"));
$framework->add_output("./tests/sard/995/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-concatenation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/996/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-concatenation_simple_quote.php");
$framework->add_output("./tests/sard/996/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-concatenation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/996/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-concatenation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/996/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-concatenation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/997/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-interpretation.php");
$framework->add_output("./tests/sard/997/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-interpretation.php", array("tainted"));
$framework->add_output("./tests/sard/997/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-interpretation.php", array("49"));
$framework->add_output("./tests/sard/997/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-interpretation.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/998/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-interpretation_simple_quote.php");
$framework->add_output("./tests/sard/998/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-interpretation_simple_quote.php", array("tainted"));
$framework->add_output("./tests/sard/998/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-interpretation_simple_quote.php", array("49"));
$framework->add_output("./tests/sard/998/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-interpretation_simple_quote.php", "file_inclusion");

$framework->add_testbasis("./tests/sard/999/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-sprintf_%d.php");
$framework->add_output("./tests/sard/999/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-sprintf_%d.php", array("tainted"));
$framework->add_output("./tests/sard/999/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-sprintf_%d.php", array("49"));
$framework->add_output("./tests/sard/999/CWE_89__exec__CAST-cast_int_sort_of2__multiple_select-sprintf_%d.php", "file_inclusion");
*/

	foreach($framework->get_testbasis() as $file)
	{
		$context = new \progpilot\Context;
		$analyzer = new \progpilot\Analyzer;
		
		$context->inputs->set_sources("./data/sources.json");
		$context->inputs->set_sinks("./data/sinks.json");
		$context->inputs->set_sanitizers("./data/sanitizers.json");
		
		$analyzer->set_file($file);
		$analyzer->run($context);
		
		$results = $context->get_results();
		$outputjson = array('results' => $results); 

		$parsed_json = $outputjson["results"];
		echo "test $file ";
		
		foreach($parsed_json as $vuln)
		{
            $result_test = true;
			$basis_outputs = [
				$vuln['source'],
				$vuln['source_line'],
				$vuln['vuln_name']];
				
			if(!$framework->check_outputs($file, $basis_outputs))
			{
                $result_test = false;
                break;
            }
		}
		
		if($result_test)
		{
            echo "[$file] test result ok\n";
		}
		else
		{
			echo "[$file] test result ko\n";
			var_dump($parsed_json);
		}

	}

} catch (\RuntimeException $e) {
	$result = $e->getMessage();
}


	/*
	$files = [];
	scandir_rec("./tests/sard", $files);

	foreach($files as $file)
	{
		echo "\$framework->add_testbasis(\"$file\");\n";
		echo "\$framework->add_output(\"$file\", array(\"tainted\"));\n";
		echo "\$framework->add_output(\"$file\", array(\"49\"));\n";
		echo "\$framework->add_output(\"$file\", \"file_inclusion\");\n\n";
	}
	*/

?>
