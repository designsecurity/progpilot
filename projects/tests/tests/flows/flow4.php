<?php

function plugin_basename($file) {
  $file = preg_replace('|\\\\+|', '\\\\', $file);
  $file = preg_replace('/^.*wp-content[\\\\\/]plugins[\\\\\/]/', '', $file);
  return $file;
}


function get_plugin_page_hook($plugin_page, $parent_page) {
	global $wp_filter;

	$hook = get_plugin_page_hookname($plugin_page, $parent_page);
	if (isset ($wp_filter[$hook]))
		return $hook;
	else
		return '';
}

$plugin_page = stripslashes($_GET['page']);

$plugin_page = plugin_basename($plugin_page);

$page_hook = get_plugin_page_hook($plugin_page, $pagenow);

include($plugin_page);

