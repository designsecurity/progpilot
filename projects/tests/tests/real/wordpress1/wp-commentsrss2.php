<?php 

	require_once('wp-config.php');
	/*
	class wpdb {
	
	}
	
	$wpdb = new wpdb;
*/
		if (is_single() || is_page()) {
			$comments = $wpdb->get_results("SELECT comment_ID, comment_author, comment_author_email, 
			comment_author_url, comment_date, comment_date_gmt, comment_content, comment_post_ID, 
			$wpdb->posts.ID, $wpdb->posts.post_password FROM $wpdb->comments 
			LEFT JOIN $wpdb->posts ON comment_post_id = id WHERE comment_post_ID = '$id' 
			AND $wpdb->comments.comment_approved = '1' AND $wpdb->posts.post_status IN ('publish', 'static', 'object') 
			AND post_date_gmt < '" . gmdate("Y-m-d H:i:59") . "' 
			ORDER BY comment_date_gmt DESC LIMIT " . get_settings('posts_per_rss') );
		} else { // if no post id passed in, we'll just ue the last 10 comments.
			$comments = $wpdb->get_results("SELECT comment_ID, comment_author, comment_author_email, 
			comment_author_url, comment_date, comment_date_gmt, comment_content, comment_post_ID, 
			$wpdb->posts.ID, $wpdb->posts.post_password FROM $wpdb->comments 
			LEFT JOIN $wpdb->posts ON comment_post_id = id WHERE $wpdb->posts.post_status IN ('publish', 'static', 'object') 
			AND $wpdb->comments.comment_approved = '1' AND post_date_gmt < '" . gmdate("Y-m-d H:i:s") . "'  
			ORDER BY comment_date_gmt DESC LIMIT " . get_settings('posts_per_rss') );
		}
	// this line is WordPress' motor, do not delete it.
		if ($comments) {
			foreach ($comments as $comment) {
				// Some plugins may need to know the metadata
				// associated with this comment's post:
				get_post_custom($comment->comment_post_ID);
?>
	<item>
		<title><?php if ( ! (is_single() || is_page()) ) {
			$title = get_the_title($comment->comment_post_ID);
			$title = apply_filters('the_title', $title);
			$title = apply_filters('the_title_rss', $title);
			printf(__('Comment on %1$s by %2$s'), $title, get_comment_author_rss());
		} else {	
			printf(__('by: %s'), get_comment_author_rss());			
		} ?></title>
		<link><?php comment_link() ?></link>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_comment_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<guid><?php comment_link() ?></guid>
			<?php 
			if (!empty($comment->post_password) && $_COOKIE['wp-postpass'] != $comment->post_password) {
			?>
		<description><?php _e('Protected Comments: Please enter your password to view comments.'); ?></description>
		<content:encoded><![CDATA[<?php echo get_the_password_form() ?>]]></content:encoded>
			<?php
			} else {
			?>
		<description><?php comment_text_rss() ?></description>
		<content:encoded><![CDATA[<?php comment_text() ?>]]></content:encoded>
			<?php 
			} // close check for password 
			?>
	</item>
<?php 
			}
		}
?>
</channel>
</rss>
