<?php

function get_comment_text() {
	global $comment;
	return apply_filters('get_comment_text', $comment->comment_content);
}

function comment_text() {
	echo apply_filters('comment_text', get_comment_text() );
}

?>
