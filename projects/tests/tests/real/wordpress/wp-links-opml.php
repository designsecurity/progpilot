<?php 
$doing_rss = 1;

require('wp-blog-header.php');
header('Content-type: text/xml; charset=' . get_settings('blog_charset'), true);
$link_cat = $_GET['link_cat'];
if ((empty($link_cat)) || ($link_cat == 'all') || ($link_cat == '0')) {
    $sql_cat = '';
} else { // be safe
    $link_cat = ''.urldecode($link_cat).'';
    $link_cat = addslashes_gpc($link_cat);
    $link_cat = intval($link_cat);
    if ($link_cat != 0) {
        $sql_cat = "AND $wpdb->links.link_category = $link_cat";
        $cat_name = $wpdb->get_var("SELECT $wpdb->linkcategories.cat_name FROM $wpdb->linkcategories WHERE $wpdb->linkcategories.cat_id = $link_cat");
        if (!empty($cat_name)) {
            $cat_name = ": category $cat_name";
        }
    }
}
?><?php echo '<?xml version="1.0"?'.">\n"; ?>
<!-- generator="wordpress/<?php echo $wp_version ?>" -->
<opml version="1.0">
    <head>
        <title>Links for <?php echo get_bloginfo('name').$cat_name ?></title>
        <dateCreated><?php echo gmdate("D, d M Y H:i:s"); ?> GMT</dateCreated>
    </head>
    <body>
<?php $sql = "SELECT $wpdb->links.link_url, link_rss, $wpdb->links.link_name, $wpdb->links.link_category, $wpdb->linkcategories.cat_name, link_updated 
FROM $wpdb->links 
 JOIN $wpdb->linkcategories on $wpdb->links.link_category = $wpdb->linkcategories.cat_id
 $sql_cat
 ORDER BY $wpdb->linkcategories.cat_name, $wpdb->links.link_name \n";
 //echo("<!-- $sql -->");
 $prev_cat_id = 0;
 $results = $wpdb->get_results($sql);
 if ($results) {
     foreach ($results as $result) {
         if ($result->link_category != $prev_cat_id) { // new category
             if ($prev_cat_id != 0)  { // not first time
?>
        </outline>
<?php
             } // end if not first time
?>
        <outline type="category" title="<?php echo wp_specialchars($result->cat_name); ?>">
<?php
             $prev_cat_id = $result->link_category;
        } // end if new category
?>
            <outline text="<?php echo wp_specialchars($result->link_name); ?>" type="link" xmlUrl="<?php echo wp_specialchars($result->link_rss); ?>" htmlUrl="<?php echo wp_specialchars($result->link_url); ?>" updated="<?php if ('0000-00-00 00:00:00' != $result->link_updated) echo $result->link_updated; ?>" />
<?php
        } // end foreach
    } // end if
?>
        </outline>
    </body>
</opml>