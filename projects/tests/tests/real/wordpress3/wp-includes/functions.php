<?php
/*
function maybe_unserialize($original) {
		return $original;
}

function get_settings($setting) {
	return apply_filters( 'option_' . $setting, maybe_unserialize($value) );
}

function get_option($option) {
	return get_settings($option);
}

function get_post_meta($post_id, $key, $single = false) {

	$values = array();
	
  $values[] = "eee";

	$b = maybe_unserialize($values);
	
	return $b;
}

function apply_filters($tag, $string) {
	global $wp_filter;

	$args = array_slice(func_get_args(), 2);

	merge_filters($tag);

	if ( !isset($wp_filter[$tag]) ) {
		return $string;
	}
	foreach ($wp_filter[$tag] as $priority => $functions) {
		if ( !is_null($functions) ) {
			foreach($functions as $function) {

				$all_args = array_merge(array($string), $args);
				$function_name = $function['function'];
				$accepted_args = $function['accepted_args'];

				if ( $accepted_args == 1 )
					$the_args = array($string);
				elseif ( $accepted_args > 1 )
					$the_args = array_slice($all_args, 0, $accepted_args);
				elseif ( $accepted_args == 0 )
					$the_args = NULL;
				else
					$the_args = $all_args;

				$string = call_user_func_array($function_name, $the_args);
			}
		}
	}
	return $string;
}
*/

?>
