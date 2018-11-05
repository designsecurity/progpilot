<?php


class wpdb {
}

$wpdb = new wpdb();

$comments = $wpdb->get_results("SELECT comment_ID, comment_author, comment_author_email, 
comment_author_url, comment_date, comment_date_gmt, comment_content, comment_post_ID, 
$wpdb->posts.ID, $wpdb->posts.post_password FROM $wpdb->comments 
LEFT JOIN $wpdb->posts ON comment_post_id = id WHERE $wpdb->posts.post_status IN ('publish', 'static', 'object') 
AND $wpdb->comments.comment_approved = '1' AND post_date_gmt < '" . gmdate("Y-m-d H:i:s") . "'  
ORDER BY comment_date_gmt DESC LIMIT " . get_settings('posts_per_rss') );

// this line is WordPress' motor, do not delete it.
if ($comments) {
    foreach ($comments as $comment) {
        // Some plugins may need to know the metadata
        // associated with this comment's post:
        get_post_custom($comment->comment_post_ID);
        
        echo $comment->ddd;
    }
}
