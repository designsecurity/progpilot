<?php

// For an advanced caching plugin to use, static because you would only want one
/*
if ( defined('WP_CACHE') )
	require (ABSPATH . 'wp-content/advanced-cache.php');
*/
define('WPINC', 'wp-includes');

require_once (ABSPATH . WPINC . '/wp-db.php');


/*
require (ABSPATH . WPINC . '/functions.php');
require (ABSPATH . WPINC . '/default-filters.php');
*/
/*
require (ABSPATH . WPINC . '/functions-formatting.php');
require (ABSPATH . WPINC . '/functions-post.php');
require (ABSPATH . WPINC . '/capabilities.php');
require (ABSPATH . WPINC . '/classes.php');
require (ABSPATH . WPINC . '/template-functions-general.php');
require (ABSPATH . WPINC . '/template-functions-links.php');
require (ABSPATH . WPINC . '/template-functions-author.php');
require (ABSPATH . WPINC . '/template-functions-post.php');
require (ABSPATH . WPINC . '/template-functions-category.php');
*/
//require (ABSPATH . WPINC . '/comment-functions.php');
/*
require (ABSPATH . WPINC . '/feed-functions.php');
require (ABSPATH . WPINC . '/links.php');
require (ABSPATH . WPINC . '/kses.php');
require (ABSPATH . WPINC . '/version.php');
if (!strstr($_SERVER['PHP_SELF'], 'install.php')) :
    // Used to guarantee unique hash cookies
    $cookiehash = md5(get_settings('siteurl')); // Remove in 1.4
	define('COOKIEHASH', $cookiehash); 
endif;
if ( !defined('USER_COOKIE') )
	define('USER_COOKIE', 'wordpressuser_'. COOKIEHASH);
if ( !defined('PASS_COOKIE') )
	define('PASS_COOKIE', 'wordpresspass_'. COOKIEHASH);
if ( !defined('COOKIEPATH') )
	define('COOKIEPATH', preg_replace('|https?://[^/]+|i', '', get_settings('home') . '/' ) );
if ( !defined('SITECOOKIEPATH') )
	define('SITECOOKIEPATH', preg_replace('|https?://[^/]+|i', '', get_settings('siteurl') . '/' ) );
if ( !defined('COOKIE_DOMAIN') )
	define('COOKIE_DOMAIN', false);
require (ABSPATH . WPINC . '/vars.php');
do_action('core_files_loaded');
// Check for hacks file if the option is enabled
if (get_settings('hack_file')) {
	if (file_exists(ABSPATH . '/my-hacks.php'))
		require(ABSPATH . '/my-hacks.php');
}
if ( get_settings('active_plugins') ) {
	$current_plugins = get_settings('active_plugins');
	if ( is_array($current_plugins) ) {
		foreach ($current_plugins as $plugin) {
			if ('' != $plugin && file_exists(ABSPATH . 'wp-content/plugins/' . $plugin))
				include_once(ABSPATH . 'wp-content/plugins/' . $plugin);
		}
	}
}
require (ABSPATH . WPINC . '/pluggable-functions.php');
if ( defined('WP_CACHE') && function_exists('wp_cache_postload') )
	wp_cache_postload();
do_action('plugins_loaded');
// If already slashed, strip.
if ( get_magic_quotes_gpc() ) {
	$_GET    = stripslashes_deep($_GET   );
	$_POST   = stripslashes_deep($_POST  );
	$_COOKIE = stripslashes_deep($_COOKIE);
	$_SERVER = stripslashes_deep($_SERVER);
}
// Escape with wpdb.
$_GET    = add_magic_quotes($_GET   );
$_POST   = add_magic_quotes($_POST  );
$_COOKIE = add_magic_quotes($_COOKIE);
$_SERVER = add_magic_quotes($_SERVER);
$wp_query   = new WP_Query();
$wp_rewrite = new WP_Rewrite();
$wp         = new WP();
$wp_roles   = new WP_Roles();
define('TEMPLATEPATH', get_template_directory());
// Load the default text localization domain.
load_default_textdomain();
// Pull in locale data after loading text domain.
require_once(ABSPATH . WPINC . '/locale.php');
// Load functions for active theme.
if ( file_exists(TEMPLATEPATH . "/functions.php") )
	include(TEMPLATEPATH . "/functions.php");
function shutdown_action_hook() {
	wp_cache_close();
	do_action('shutdown');
}
register_shutdown_function('shutdown_action_hook');
// Everything is loaded and initialized.
do_action('init');
*/
?>
