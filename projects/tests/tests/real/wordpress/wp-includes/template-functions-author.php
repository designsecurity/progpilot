<?php

function get_the_author($idmode = '') {
	global $authordata;
	return apply_filters('the_author', $authordata->display_name);
}

function the_author($idmode = '', $echo = true) {
	if ( $echo )
		echo get_the_author($idmode);
	return get_the_author($idmode);
}

function get_the_author_description() {
	global $authordata;
	return $authordata->description;
}
function the_author_description() {
	echo get_the_author_description();
}

function get_the_author_login() {
	global $authordata;
	return $authordata->user_login;
}

function the_author_login() {
	echo get_the_author_login();
}

function get_the_author_firstname() {
	global $authordata;
	return $authordata->first_name;
}
function the_author_firstname() {
	echo get_the_author_firstname();
}

function get_the_author_lastname() {
	global $authordata;
	return $authordata->last_name;
}

function the_author_lastname() {
	echo get_the_author_lastname();
}

function get_the_author_nickname() {
	global $authordata;
	return $authordata->nickname;
}

function the_author_nickname() {
	echo get_the_author_nickname();
}

function get_the_author_ID() {
	global $authordata;
	return $authordata->ID;
}
function the_author_ID() {
	echo get_the_author_id();
}

function get_the_author_email() {
	global $authordata;
	return $authordata->user_email;
}

function the_author_email() {
	echo apply_filters('the_author_email', get_the_author_email() );
}

function get_the_author_url() {
	global $authordata;
	return $authordata->user_url;
}

function the_author_url() {
	echo get_the_author_url();
}

function get_the_author_icq() {
	global $authordata;
	return $authordata->icq;
}

function the_author_icq() {
	echo get_the_author_icq();
}

function get_the_author_aim() {
	global $authordata;
	return str_replace(' ', '+', $authordata->aim);
}

function the_author_aim() {
	echo get_the_author_aim();
}

function get_the_author_yim() {
	global $authordata;
	return $authordata->yim;
}

function the_author_yim() {
	echo get_the_author_yim();
}

function get_the_author_msn() {
	global $authordata;
	return $authordata->msn;
}

function the_author_msn() {
	echo get_the_author_msn();
}

function get_the_author_posts() {
	global $post;
	$posts = get_usernumposts($post->post_author);
	return $posts;
}

function the_author_posts() {
	echo get_the_author_posts();
}

/* the_author_posts_link() requires no get_, use get_author_link() */
function the_author_posts_link($idmode='') {
	global $authordata;

	echo '<a href="' . get_author_link(0, $authordata->ID, $authordata->user_nicename) . '" title="' . sprintf(__("Posts by %s"), wp_specialchars(the_author($idmode, false))) . '">' . the_author($idmode, false) . '</a>';
}

function get_author_link($echo = false, $author_id, $author_nicename) {
	global $wpdb, $wp_rewrite, $post, $cache_userdata;
	$auth_ID = $author_id;
	$link = $wp_rewrite->get_author_permastruct();

	if ( empty($link) ) {
		$file = get_settings('home') . '/';
		$link = $file . '?author=' . $auth_ID;
	} else {
		if ( '' == $author_nicename )
			$author_nicename = $cache_userdata[$author_id]->user_nicename;
		$link = str_replace('%author%', $author_nicename, $link);
		$link = get_settings('home') . trailingslashit($link);
	}

	$link = apply_filters('author_link', $link, $author_id, $author_nicename);

	if ( $echo )
		echo $link;
	return $link;
}

function wp_list_authors($args = '') {
	parse_str($args, $r);

	if ( !isset($r['optioncount']) )
		$r['optioncount'] = false;
	if ( !isset($r['exclude_admin']) )
		$r['exclude_admin'] = true;
	if ( !isset($r['show_fullname']) )
		$r['show_fullname'] = false;
	if ( !isset($r['hide_empty']) )
		$r['hide_empty'] = true;
	if ( !isset($r['feed']) )
		$r['feed'] = '';
	if ( !isset($r['feed_image']) )
		$r['feed_image'] = '';

	list_authors($r['optioncount'], $r['exclude_admin'], $r['show_fullname'], $r['hide_empty'], $r['feed'], $r['feed_image']);
}

function list_authors($optioncount = false, $exclude_admin = true, $show_fullname = false, $hide_empty = true, $feed = '', $feed_image = '') {
	global $wpdb;
	$query = "SELECT ID, user_nicename from $wpdb->users " . ($exclude_admin ? "WHERE user_login <> 'admin' " : '') . "ORDER BY display_name";
	$authors = $wpdb->get_results($query);

	foreach ( $authors as $author ) {
		$author = get_userdata( $author->ID );
		$posts = get_usernumposts($author->ID);
		$name = $author->nickname;

		if ( $show_fullname && ($author->first_name != '' && $author->last_name != '') )
			$name = "$author->first_name $author->last_name";

		if ( !($posts == 0 && $hide_empty) )
			echo "<li>";
		if ( $posts == 0 ) {
			if ( !$hide_empty )
				$link = $name;
		} else {
			$link = '<a href="' . get_author_link(0, $author->ID, $author->user_nicename) . '" title="' . sprintf(__("Posts by %s"), wp_specialchars($author->display_name)) . '">' . $name . '</a>';

			if ( (! empty($feed_image)) || (! empty($feed)) ) {
				$link .= ' ';
				if (empty($feed_image))
					$link .= '(';
				$link .= '<a href="' . get_author_rss_link(0, $author->ID, $author->user_nicename) . '"';

				if ( !empty($feed) ) {
					$title = ' title="' . $feed . '"';
					$alt = ' alt="' . $feed . '"';
					$name = $feed;
					$link .= $title;
				}

				$link .= '>';

				if ( !empty($feed_image) )
					$link .= "<img src=\"$feed_image\" border=\"0\"$alt$title" . ' />';
				else
					$link .= $name;

				$link .= '</a>';

				if ( empty($feed_image) )
					$link .= ')';
			}

			if ( $optioncount )
				$link .= ' ('. $posts . ')';

		}

		if ( !($posts == 0 && $hide_empty) )
			echo "$link</li>";
	}
}

?>