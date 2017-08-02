<?php

/*
 * This file is part of ProgPilot, a static analyzer for security
 *
 * @copyright 2017 Eric Therond. All rights reserved
 * @license MIT See LICENSE at the root of the project for more info
 */


namespace progpilot;

use progpilot\Objects\MyOp;

class Utils
{
	public static function encoding_characters($string)
	{
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
	}
	
	public static function print_function($function)
	{
        $function_name = "\$";
        if($function->get_type() == MyOp::TYPE_METHOD)
            $function_name = Utils::encoding_characters($function->get_myclass()->get_name())."->";
        
        $function_name .= Utils::encoding_characters($function->get_name());
        
        return $function_name;
	}
	
	public static function print_array($array, &$print)
	{
        if(is_array($array))
		{
			foreach($array as $index => $value)
			{
				if(isset($array[$index]))
				{
                    if(is_string($index))
                        $print .= "[\"".Utils::encoding_characters($index)."\"]";
                    else
                        $print .= "[".Utils::encoding_characters($index)."]";
                    
                    Utils::print_array($array[$index], $print);
				}
			}
		}
	}
}

?>
