<?php

require_once(dirname(__FILE__).'/functions-compat.php');

if ( !function_exists('_') ) {
	function _($string) {
		return $string;
	}
}

function &get_comment(&$comment, $output = OBJECT) {
	global $comment_cache, $wpdb;

	if ( empty($comment) )
		return null;

	if ( is_object($comment) ) {
		if ( !isset($comment_cache[$comment->comment_ID]) )
			$comment_cache[$comment->comment_ID] = &$comment;
		$_comment = & $comment_cache[$comment->comment_ID];
	} else {
		if ( !isset($comment_cache[$comment]) ) {
			$_comment = $wpdb->get_row("SELECT * FROM $wpdb->comments WHERE comment_ID = '$comment' LIMIT 1");
			$comment_cache[$comment->comment_ID] = & $_comment;
		} else {
			$_comment = & $comment_cache[$comment];
		}
	}

	if ( $output == OBJECT ) {
		return $_comment;
	} elseif ( $output == ARRAY_A ) {
		return get_object_vars($_comment);
	} elseif ( $output == ARRAY_N ) {
		return array_values(get_object_vars($_comment));
	} else {
		return $_comment;
	}
}

function merge_filters($tag) {
	global $wp_filter;
	if ( isset($wp_filter['all']) ) {
		foreach ($wp_filter['all'] as $priority => $functions) {
			if ( isset($wp_filter[$tag][$priority]) )
				$wp_filter[$tag][$priority] = array_merge($wp_filter['all'][$priority], $wp_filter[$tag][$priority]);
			else
				$wp_filter[$tag][$priority] = array_merge($wp_filter['all'][$priority], array());
			$wp_filter[$tag][$priority] = array_unique($wp_filter[$tag][$priority]);
		}
	}

	if ( isset($wp_filter[$tag]) )
		ksort( $wp_filter[$tag] );
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

function add_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
	global $wp_filter;

	// check that we don't already have the same filter at the same priority
	if ( isset($wp_filter[$tag]["$priority"]) ) {
		foreach($wp_filter[$tag]["$priority"] as $filter) {
			// uncomment if we want to match function AND accepted_args
			// if ( $filter == array($function, $accepted_args) ) {
			if ( $filter['function'] == $function_to_add ) {
				return true;
			}
		}
	}

	// So the format is wp_filter['tag']['array of priorities']['array of ['array (functions, accepted_args)]']
	$wp_filter[$tag]["$priority"][] = array('function'=>$function_to_add, 'accepted_args'=>$accepted_args);
	return true;
}

function remove_filter($tag, $function_to_remove, $priority = 10, $accepted_args = 1) {
	global $wp_filter;

	// rebuild the list of filters
	if ( isset($wp_filter[$tag]["$priority"]) ) {
		foreach($wp_filter[$tag]["$priority"] as $filter) {
			if ( $filter['function'] != $function_to_remove ) {
				$new_function_list[] = $filter;
			}
		}
		$wp_filter[$tag]["$priority"] = $new_function_list;
	}
	return true;
}

// The *_action functions are just aliases for the *_filter functions, they take special strings instead of generic content

function do_action($tag, $arg = '') {
	global $wp_filter;
	$extra_args = array_slice(func_get_args(), 2);
 	if ( is_array($arg) )
 		$args = array_merge($arg, $extra_args);
	else
		$args = array_merge(array($arg), $extra_args);

	merge_filters($tag);

	if ( !isset($wp_filter[$tag]) ) {
		return;
	}
	foreach ($wp_filter[$tag] as $priority => $functions) {
		if ( !is_null($functions) ) {
			foreach($functions as $function) {

				$function_name = $function['function'];
				$accepted_args = $function['accepted_args'];

				if ( $accepted_args == 1 ) {
					if ( is_array($arg) )
						$the_args = $arg;
					else
						$the_args = array($arg);
				} elseif ( $accepted_args > 1 ) {
					$the_args = array_slice($args, 0, $accepted_args);
				} elseif ( $accepted_args == 0 ) {
					$the_args = NULL;
				} else {
					$the_args = $args;
				}

				$string = call_user_func_array($function_name, $the_args);
			}
		}
	}
}

function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
	add_filter($tag, $function_to_add, $priority, $accepted_args);
}

function remove_action($tag, $function_to_remove, $priority = 10, $accepted_args = 1) {
	remove_filter($tag, $function_to_remove, $priority, $accepted_args);
}

?>
