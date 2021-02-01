<?php
/*
Plugin Name: Akismet
Plugin URI: http://akismet.com/
Description: Akismet checks your comments against the Akismet web serivce to see if they look like spam or not. You need a <a href="http://wordpress.com/api-keys/">WordPress.com API key</a> to use this service. You can review the spam it catches under "Manage" and it automatically deletes old spam after 15 days. Hat tip: <a href="http://ioerror.us/">Michael Hampton</a> and <a href="http://chrisjdavis.org/">Chris J. Davis</a> for help with the plugin.
Author: Matt Mullenweg
Version: 1.12
Author URI: http://photomatt.net/
*/

add_action('admin_menu', 'ksd_config_page');

function ksd_config_page() {
	global $wpdb;
	if ( function_exists('add_submenu_page') )
		add_submenu_page('plugins.php', __('Akismet Configuration'), __('Akismet Configuration'), 1, __FILE__, 'akismet_conf');
}

function akismet_conf() {
	if ( isset($_POST['submit']) ) {
		check_admin_referer();
		$key = preg_replace('/[^a-h0-9]/i', '', $_POST['key']);
		if ( akismet_verify_key( $key ) )
			update_option('wordpress_api_key', $key);
		else
			$invalid_key = true;
	}
	if ( !akismet_verify_key( get_option('wordpress_api_key') ) )
		$invalid_key = true;
?>

<div class="wrap">
<h2><?php _e('Akismet Configuration'); ?></h2>
	<p><?php printf(__('For many people, <a href="%1$s">Akismet</a> will greatly reduce or even completely eliminate the comment and trackback spam you get on your site. If one does happen to get through, simply mark it as "spam" on the moderation screen and Akismet will learn from the mistakes. If you don\'t have a WordPress.com account yet, you can get one at <a href="%2$s">WordPress.com</a>.'), 'http://akismet.com/', 'http://wordpress.com/api-keys/'); ?></p>

<form action="" method="post" id="akismet-conf" style="margin: auto; width: 25em; ">
<h3><label for="key"><?php _e('WordPress.com API Key'); ?></label></h3>
<?php if ( $invalid_key ) { ?>
	<p style="padding: .5em; background-color: #f33; color: #fff; font-weight: bold;"><?php _e('Your key appears invalid. Double-check it.'); ?></p>
<?php } ?>
<p><input id="key" name="key" type="text" size="15" maxlength="12" value="<?php echo get_option('wordpress_api_key'); ?>" style="font-family: 'Courier New', Courier, mono; font-size: 1.5em;" /> (<?php _e('<a href="http://faq.wordpress.com/2005/10/19/api-key/">What is this?</a>'); ?>)</p>
	<p class="submit"><input type="submit" name="submit" value="<?php _e('Update API Key &raquo;'); ?>" /></p>
</form>
</div>
<?php
}

function akismet_verify_key( $key ) {
	global $auto_comment_approved, $ksd_api_host, $ksd_api_port;
	$blog = urlencode( get_option('home') );
	$response = ksd_http_post("key=$key&blog=$blog", 'rest.akismet.com', '/1.1/verify-key', $ksd_api_port);
	if ( 'valid' == $response[1] )
		return true;
	else
		return false;
}

if ( !get_option('wordpress_api_key') && !isset($_POST['submit']) ) {
	function akismet_warning() {
	$path = plugin_basename(__FILE__);
		echo "
		<div id='akismet-warning' class='updated fade-ff0000'><p><strong>".__('Akismet is not active.')."</strong> ".sprintf(__('You must <a href="%1$s">enter your WordPress.com API key</a> for it to work.'), "plugins.php?page=$path")."</p></div>
		<style type='text/css'>
		#adminmenu { margin-bottom: 5em; }
		#akismet-warning { position: absolute; top: 7em; }
		</style>
		";
	}
	add_action('admin_footer', 'akismet_warning');
	return;
}

$ksd_api_host = get_option('wordpress_api_key') . '.rest.akismet.com';
$ksd_api_port = 80;
$ksd_user_agent = "WordPress/$wp_version | Akismet/1.12";

// Returns array with headers in $response[0] and entity in $response[1]
function ksd_http_post($request, $host, $path, $port = 80) {
	global $ksd_user_agent;

	$http_request  = "POST $path HTTP/1.0\r\n";
	$http_request .= "Host: $host\r\n";
	$http_request .= "Content-Type: application/x-www-form-urlencoded; charset=" . get_settings('blog_charset') . "\r\n";
	$http_request .= "Content-Length: " . strlen($request) . "\r\n";
	$http_request .= "User-Agent: $ksd_user_agent\r\n";
	$http_request .= "\r\n";
	$http_request .= $request;

	$response = '';
	if( false !== ( $fs = @fsockopen($host, $port, $errno, $errstr, 3) ) ) {
		fwrite($fs, $http_request);

		while ( !feof($fs) )
			$response .= fgets($fs, 1160); // One TCP-IP packet
		fclose($fs);
		$response = explode("\r\n\r\n", $response, 2);
	}
	return $response;
}

function ksd_auto_check_comment( $comment ) {
	global $auto_comment_approved, $ksd_api_host, $ksd_api_port;
	$comment['user_ip']    = $_SERVER['REMOTE_ADDR'];
	$comment['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$comment['referrer']   = $_SERVER['HTTP_REFERER'];
	$comment['blog']       = get_option('home');

	$ignore = array( 'HTTP_COOKIE' );

	foreach ( $_SERVER as $key => $value )
		if ( !in_array( $key, $ignore ) )
			$comment["$key"] = $value;

	$query_string = '';
	foreach ( $comment as $key => $data )
		$query_string .= $key . '=' . urlencode( stripslashes($data) ) . '&';

	$response = ksd_http_post($query_string, $ksd_api_host, '/1.1/comment-check', $ksd_api_port);
	if ( 'true' == $response[1] ) {
		$auto_comment_approved = 'spam';
		update_option( 'akismet_spam_count', get_option('akismet_spam_count') + 1 );
	}
	akismet_delete_old();
	return $comment;
}

function akismet_delete_old() {
	global $wpdb;
	$now_gmt = current_time('mysql', 1);
	$wpdb->query("DELETE FROM $wpdb->comments WHERE DATE_SUB('$now_gmt', INTERVAL 15 DAY) > comment_date_gmt AND comment_approved = 'spam'");
	$n = mt_rand(1, 5);
	if ( $n % 5 )
		$wpdb->query("OPTIMIZE TABLE $wpdb->comments");
}

function ksd_auto_approved( $approved ) {
	global $auto_comment_approved;
	if ( 'spam' == $auto_comment_approved )
		$approved = $auto_comment_approved;
	return $approved;
}

function ksd_submit_nonspam_comment ( $comment_id ) {
	global $wpdb, $ksd_api_host, $ksd_api_port;

	$comment = $wpdb->get_row("SELECT * FROM $wpdb->comments WHERE comment_ID = '$comment_id'");
	if ( !$comment ) // it was deleted
		return;
	$comment->blog = get_option('home');
	$query_string = '';
	foreach ( $comment as $key => $data )
		$query_string .= $key . '=' . urlencode( stripslashes($data) ) . '&';
	$response = ksd_http_post($query_string, $ksd_api_host, "/1.1/submit-ham", $ksd_api_port);
}

function ksd_submit_spam_comment ( $comment_id ) {
	global $wpdb, $ksd_api_host, $ksd_api_port;

	$comment = $wpdb->get_row("SELECT * FROM $wpdb->comments WHERE comment_ID = '$comment_id'");
	if ( !$comment ) // it was deleted
		return;
	if ( 'spam' != $comment->comment_approved )
		return;
	$comment->blog = get_option('home');
	$query_string = '';
	foreach ( $comment as $key => $data )
		$query_string .= $key . '=' . urlencode( stripslashes($data) ) . '&';

	$response = ksd_http_post($query_string, $ksd_api_host, "/1.1/submit-spam", $ksd_api_port);
}

add_action('wp_set_comment_status', 'ksd_submit_spam_comment');
add_action('edit_comment', 'ksd_submit_spam_comment');
add_action('preprocess_comment', 'ksd_auto_check_comment', 1);
add_filter('pre_comment_approved', 'ksd_auto_approved');


function ksd_spam_count() {
	global $wpdb, $comments;
	$count = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved = 'spam'");
	return $count;
}

function ksd_manage_page() {
	global $wpdb;
	$count = sprintf(__('Akismet Spam (%s)'), ksd_spam_count());
	if ( function_exists('add_management_page') )
		add_management_page(__('Akismet Spam'), $count, 1, __FILE__, 'ksd_caught');
}

function ksd_caught() {
	global $wpdb, $comment;
	if (isset($_POST['submit']) && 'recover' == $_POST['action'] && ! empty($_POST['not_spam'])) {
		$i = 0;
		foreach ($_POST['not_spam'] as $comment):
			$comment = (int) $comment;
			if ( function_exists('wp_set_comment_status') )
				wp_set_comment_status($comment, 'approve');
			else
				$wpdb->query("UPDATE $wpdb->comments SET comment_approved = '1' WHERE comment_ID = '$comment'");
			ksd_submit_nonspam_comment($comment);
			++$i;
		endforeach;
		echo '<div class="updated"><p>' . sprintf(__('%1$s comments recovered.'), $i) . "</p></div>";
	}
	if ('delete' == $_POST['action']) {
		$delete_time = addslashes( $_POST['display_time'] );
		$nuked = $wpdb->query( "DELETE FROM $wpdb->comments WHERE comment_approved = 'spam' AND '$delete_time' > comment_date_gmt" );
		if (isset($nuked)) {
			echo '<div class="updated"><p>';
			if ($nuked) {
				_e('All spam deleted.');
			}
			echo "</p></div>";
		}
	}
?>
<div class="wrap">
<h2><?php _e('Caught Spam') ?></h2>
<?php
$count = get_option('akismet_spam_count');
if ( $count ) {
?>
<p><?php printf(__('Akismet has caught <strong>%1$s</strong> for you since you installed it.'), $count); ?></p>
<?php
}
$spam_count = ksd_spam_count();
if (0 == $spam_count) {
	echo '<p>'.__('You have no spam currently in the queue. Must be your lucky day. :)').'</p>';
	echo '</div>';
} else {
	echo '<p>'.__('You can delete all of the spam from your database with a single click. This operation cannot be undone, so you may wish to check to ensure that no legitimate comments got through first. Spam is automattically deleted after 15 days, so don&#8217;t sweat it.').'</p>';
?>
<form method="post" action="">
<input type="hidden" name="action" value="delete" />
<?php printf(__('There are currently %1$s comments identified as spam.'), $spam_count); ?>&nbsp; &nbsp; <input type="submit" name="Submit" value="<?php _e('Delete all'); ?>" />
<input type="hidden" name="display_time" value="<?php echo current_time('mysql', 1); ?>" />
</form>
</div>
<div class="wrap">
<h2><?php _e('Last 15 days'); ?></h2>
<?php echo '<p>'.__('These are the latest comments identified as spam by Akismet. If you see any mistakes, simple mark the comment as "not spam" and Akismet will learn from the submission. If you wish to recover a comment from spam, simply select the comment, and click Not Spam. After 15 days we clean out the junk for you.').'</p>'; ?>
<?php
$comments = $wpdb->get_results("SELECT *, COUNT(*) AS ccount FROM $wpdb->comments WHERE comment_approved = 'spam' GROUP BY comment_author_IP ORDER BY comment_date DESC LIMIT 150");

if ($comments) {
?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="action" value="recover" />
<ol id="spam-list" class="commentlist">
<?php
$i = 0;
foreach($comments as $comment) {
	$i++;
	$comment_date = mysql2date(get_settings("date_format") . " @ " . get_settings("time_format"), $comment->comment_date);
	$post = get_post($comment->comment_post_ID);
	$post_title = $post->post_title;
	if ($i % 2) $class = 'class="alternate"';
	else $class = '';
	echo "\n\t<li id='comment-$comment->comment_ID' $class>"; 
	?>
	<p><strong><?php _e('Name:') ?></strong> <?php comment_author_link() ?> <?php if ($comment->comment_author_email) { ?>| <strong><?php _e('E-mail:') ?></strong> <?php comment_author_email_link() ?> <?php } if ($comment->comment_author_url && 'http://' != $comment->comment_author_url) { ?> | <strong><?php _e('URI:') ?></strong> <?php comment_author_url_link() ?> <?php } ?>| <strong><?php _e('IP:') ?></strong> <a href="http://ws.arin.net/cgi-bin/whois.pl?queryinput=<?php comment_author_IP() ?>"><?php comment_author_IP() ?></a> | <strong><?php _e('Date:') ?></strong> <?php comment_date(); ?></p>
<?php comment_text() ?>
<label for="spam-<?php echo $comment->comment_ID; ?>">
<input type="checkbox" id="spam-<?php echo $comment->comment_ID; ?>" name="not_spam[]" value="<?php echo $comment->comment_ID; ?>" />
<?php _e('Not Spam') ?></label>
<?php
}
}
?>
</ol>
<p class="submit"> 
<input type="submit" name="submit" value="<?php _e('Not Spam &raquo;'); ?>" />
</p>
</form>
</div>
<?php
	}
}

add_action('admin_menu', 'ksd_manage_page');

function akismet_stats() {
	$count = get_option('akismet_spam_count');
	if ( !$count )
		return;
	$path = plugin_basename(__FILE__);
	echo '<h3>'.__('Spam').'</h3>';
	echo '<p>'.sprintf(__('<a href="%1$s">Akismet</a> has protected your site from <a href="%2$s">%3$s spam comments</a>.'), 'http://akismet.com/', "edit.php?page=$path", $count).'</p>';
}

add_action('activity_box_end', 'akismet_stats');

?>
