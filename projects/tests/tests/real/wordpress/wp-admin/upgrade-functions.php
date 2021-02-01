<?php

require_once(ABSPATH . '/wp-admin/admin-functions.php');
require_once(ABSPATH . '/wp-admin/upgrade-schema.php');
// Functions to be called in install and upgrade scripts
function upgrade_all() {
	global $wp_current_db_version, $wp_db_version;
	$wp_current_db_version = __get_option('db_version');

	// We are up-to-date.  Nothing to do.
	if ( $wp_db_version == $wp_current_db_version )
		return;

	// If the version is not set in the DB, try to guess the version.
	if ( empty($wp_current_db_version) ) {
		$wp_current_db_version = 0;

		// If the template option exists, we have 1.5.
		$template = __get_option('template');
		if ( !empty($template) )
			$wp_current_db_version = 2541;
	}
	
	populate_options();

	if ( $wp_current_db_version < 2541 ) {
		upgrade_100();
		upgrade_101();
		upgrade_110();
		upgrade_130();
	}
	
	if ( $wp_current_db_version < 3308 )
		upgrade_160();

	save_mod_rewrite_rules();
	
	update_option('db_version', $wp_db_version);
}

function upgrade_100() {
	global $wpdb;

	// Get the title and ID of every post, post_name to check if it already has a value
	$posts = $wpdb->get_results("SELECT ID, post_title, post_name FROM $wpdb->posts WHERE post_name = ''");
	if ($posts) {
		foreach($posts as $post) {
			if ('' == $post->post_name) { 
				$newtitle = sanitize_title($post->post_title);
				$wpdb->query("UPDATE $wpdb->posts SET post_name = '$newtitle' WHERE ID = '$post->ID'");
			}
		}
	}
	
	$categories = $wpdb->get_results("SELECT cat_ID, cat_name, category_nicename FROM $wpdb->categories");
	foreach ($categories as $category) {
		if ('' == $category->category_nicename) { 
			$newtitle = sanitize_title($category->cat_name);
			$wpdb->query("UPDATE $wpdb->categories SET category_nicename = '$newtitle' WHERE cat_ID = '$category->cat_ID'");
		}
	}


	$wpdb->query("UPDATE $wpdb->options SET option_value = REPLACE(option_value, 'wp-links/links-images/', 'wp-images/links/')
	WHERE option_name LIKE 'links_rating_image%'
	AND option_value LIKE 'wp-links/links-images/%'");

	$done_ids = $wpdb->get_results("SELECT DISTINCT post_id FROM $wpdb->post2cat");
	if ($done_ids) :
		foreach ($done_ids as $done_id) :
			$done_posts[] = $done_id->post_id;
		endforeach;
		$catwhere = ' AND ID NOT IN (' . implode(',', $done_posts) . ')';
	else:
		$catwhere = '';
	endif;
	
	$allposts = $wpdb->get_results("SELECT ID, post_category FROM $wpdb->posts WHERE post_category != '0' $catwhere");
	if ($allposts) :
		foreach ($allposts as $post) {
			// Check to see if it's already been imported
			$cat = $wpdb->get_row("SELECT * FROM $wpdb->post2cat WHERE post_id = $post->ID AND category_id = $post->post_category");
			if (!$cat && 0 != $post->post_category) { // If there's no result
				$wpdb->query("
					INSERT INTO $wpdb->post2cat
					(post_id, category_id)
					VALUES
					('$post->ID', '$post->post_category')
					");
			}
		}
	endif;
}

function upgrade_101() {
	global $wpdb;

	// Clean up indices, add a few
	add_clean_index($wpdb->posts, 'post_name');
	add_clean_index($wpdb->posts, 'post_status');
	add_clean_index($wpdb->categories, 'category_nicename');
	add_clean_index($wpdb->comments, 'comment_approved');
	add_clean_index($wpdb->comments, 'comment_post_ID');
	add_clean_index($wpdb->links , 'link_category');
	add_clean_index($wpdb->links , 'link_visible');
}


function upgrade_110() {
	global $wpdb;
	
    // Set user_nicename.
	$users = $wpdb->get_results("SELECT ID, user_nickname, user_nicename FROM $wpdb->users");
 	foreach ($users as $user) {
 		if ('' == $user->user_nicename) { 
 			$newname = sanitize_title($user->user_nickname);
 			$wpdb->query("UPDATE $wpdb->users SET user_nicename = '$newname' WHERE ID = '$user->ID'");
 		}
 	}

	$users = $wpdb->get_results("SELECT ID, user_pass from $wpdb->users");
	foreach ($users as $row) {
		if (!preg_match('/^[A-Fa-f0-9]{32}$/', $row->user_pass)) {
			   $wpdb->query('UPDATE '.$wpdb->users.' SET user_pass = MD5(\''.$row->user_pass.'\') WHERE ID = \''.$row->ID.'\'');
		}
	}


	// Get the GMT offset, we'll use that later on
	$all_options = get_alloptions_110();

	$time_difference = $all_options->time_difference;

	$server_time = time()+date('Z');
	$weblogger_time = $server_time + $time_difference*3600;
	$gmt_time = time();

	$diff_gmt_server = ($gmt_time - $server_time) / 3600;
	$diff_weblogger_server = ($weblogger_time - $server_time) / 3600;
	$diff_gmt_weblogger = $diff_gmt_server - $diff_weblogger_server;
	$gmt_offset = -$diff_gmt_weblogger;

	// Add a gmt_offset option, with value $gmt_offset
	add_option('gmt_offset', $gmt_offset);

	// Check if we already set the GMT fields (if we did, then
	// MAX(post_date_gmt) can't be '0000-00-00 00:00:00'
	// <michel_v> I just slapped myself silly for not thinking about it earlier
	$got_gmt_fields = ($wpdb->get_var("SELECT MAX(post_date_gmt) FROM $wpdb->posts") == '0000-00-00 00:00:00') ? false : true;

	if (!$got_gmt_fields) {

		// Add or substract time to all dates, to get GMT dates
		$add_hours = intval($diff_gmt_weblogger);
		$add_minutes = intval(60 * ($diff_gmt_weblogger - $add_hours));
		$wpdb->query("UPDATE $wpdb->posts SET post_date_gmt = DATE_ADD(post_date, INTERVAL '$add_hours:$add_minutes' HOUR_MINUTE)");
		$wpdb->query("UPDATE $wpdb->posts SET post_modified = post_date");
		$wpdb->query("UPDATE $wpdb->posts SET post_modified_gmt = DATE_ADD(post_modified, INTERVAL '$add_hours:$add_minutes' HOUR_MINUTE) WHERE post_modified != '0000-00-00 00:00:00'");
		$wpdb->query("UPDATE $wpdb->comments SET comment_date_gmt = DATE_ADD(comment_date, INTERVAL '$add_hours:$add_minutes' HOUR_MINUTE)");
		$wpdb->query("UPDATE $wpdb->users SET user_registered = DATE_ADD(user_registered, INTERVAL '$add_hours:$add_minutes' HOUR_MINUTE)");
	}

}

function upgrade_130() {
    global $wpdb, $table_prefix;

    // Remove extraneous backslashes.
	$posts = $wpdb->get_results("SELECT ID, post_title, post_content, post_excerpt, guid, post_date, post_name, post_status, post_author FROM $wpdb->posts");
	if ($posts) {
		foreach($posts as $post) {
            $post_content = addslashes(deslash($post->post_content));
            $post_title = addslashes(deslash($post->post_title));
            $post_excerpt = addslashes(deslash($post->post_excerpt));
			if ( empty($post->guid) )
				$guid = get_permalink($post->ID);
			else
				$guid = $post->guid;

            $wpdb->query("UPDATE $wpdb->posts SET post_title = '$post_title', post_content = '$post_content', post_excerpt = '$post_excerpt', guid = '$guid' WHERE ID = '$post->ID'");
		}
	}

    // Remove extraneous backslashes.
	$comments = $wpdb->get_results("SELECT comment_ID, comment_author, comment_content FROM $wpdb->comments");
	if ($comments) {
		foreach($comments as $comment) {
            $comment_content = addslashes(deslash($comment->comment_content));
            $comment_author = addslashes(deslash($comment->comment_author));
            $wpdb->query("UPDATE $wpdb->comments SET comment_content = '$comment_content', comment_author = '$comment_author' WHERE comment_ID = '$comment->comment_ID'");
		}
	}

    // Remove extraneous backslashes.
	$links = $wpdb->get_results("SELECT link_id, link_name, link_description FROM $wpdb->links");
	if ($links) {
		foreach($links as $link) {
            $link_name = addslashes(deslash($link->link_name));
            $link_description = addslashes(deslash($link->link_description));
            $wpdb->query("UPDATE $wpdb->links SET link_name = '$link_name', link_description = '$link_description' WHERE link_id = '$link->link_id'");
		}
	}

    // The "paged" option for what_to_show is no more.
    if ($wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = 'what_to_show'") == 'paged') {
        $wpdb->query("UPDATE $wpdb->options SET option_value = 'posts' WHERE option_name = 'what_to_show'");
    }

		$active_plugins = __get_option('active_plugins');

		// If plugins are not stored in an array, they're stored in the old
		// newline separated format.  Convert to new format.
		if ( !is_array( $active_plugins ) ) {
			$active_plugins = explode("\n", trim($active_plugins));
			update_option('active_plugins', $active_plugins);
		}

	// Obsolete tables
	$wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . 'optionvalues');
	$wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . 'optiontypes');
	$wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . 'optiongroups');
	$wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . 'optiongroup_options');

	// Update comments table to use comment_type
	$wpdb->query("UPDATE $wpdb->comments SET comment_type='trackback', comment_content = REPLACE(comment_content, '<trackback />', '') WHERE comment_content LIKE '<trackback />%'");
	$wpdb->query("UPDATE $wpdb->comments SET comment_type='pingback', comment_content = REPLACE(comment_content, '<pingback />', '') WHERE comment_content LIKE '<pingback />%'");

	// Some versions have multiple duplicate option_name rows with the same values
	$options = $wpdb->get_results("SELECT option_name, COUNT(option_name) AS dupes FROM `$wpdb->options` GROUP BY option_name");
	foreach ( $options as $option ) {
		if ( 1 != $option->dupes ) { // Could this be done in the query?
			$limit = $option->dupes - 1;
			$dupe_ids = $wpdb->get_col("SELECT option_id FROM $wpdb->options WHERE option_name = '$option->option_name' LIMIT $limit");
			$dupe_ids = join($dupe_ids, ',');
			$wpdb->query("DELETE FROM $wpdb->options WHERE option_id IN ($dupe_ids)");
		}
	}

	make_site_theme();
}

function upgrade_160() {
	global $wpdb, $table_prefix, $wp_current_db_version;

	populate_roles_160();

	$users = $wpdb->get_results("SELECT * FROM $wpdb->users");
	foreach ( $users as $user ) :
		if ( !empty( $user->user_firstname ) )
			update_usermeta( $user->ID, 'first_name', $wpdb->escape($user->user_firstname) );
		if ( !empty( $user->user_lastname ) )
			update_usermeta( $user->ID, 'last_name', $wpdb->escape($user->user_lastname) );
		if ( !empty( $user->user_nickname ) )
			update_usermeta( $user->ID, 'nickname', $wpdb->escape($user->user_nickname) );
		if ( !empty( $user->user_level ) )
			update_usermeta( $user->ID, $table_prefix . 'user_level', $user->user_level );
		if ( !empty( $user->user_icq ) )
			update_usermeta( $user->ID, 'icq', $wpdb->escape($user->user_icq) );
		if ( !empty( $user->user_aim ) )
			update_usermeta( $user->ID, 'aim', $wpdb->escape($user->user_aim) );
		if ( !empty( $user->user_msn ) )
			update_usermeta( $user->ID, 'msn', $wpdb->escape($user->user_msn) );
		if ( !empty( $user->user_yim ) )
			update_usermeta( $user->ID, 'yim', $wpdb->escape($user->user_icq) );
		if ( !empty( $user->user_description ) )
			update_usermeta( $user->ID, 'description', $wpdb->escape($user->user_description) );

		if ( isset( $user->user_idmode ) ):
			$idmode = $user->user_idmode;
			if ($idmode == 'nickname') $id = $user->user_nickname;
			if ($idmode == 'login') $id = $user->user_login;
			if ($idmode == 'firstname') $id = $user->user_firstname;
			if ($idmode == 'lastname') $id = $user->user_lastname;
			if ($idmode == 'namefl') $id = $user->user_firstname.' '.$user->user_lastname;
			if ($idmode == 'namelf') $id = $user->user_lastname.' '.$user->user_firstname;
			if (!$idmode) $id = $user->user_nickname;
			$id = $wpdb->escape( $id );
			$wpdb->query("UPDATE $wpdb->users SET display_name = '$id' WHERE ID = '$user->ID'");
		endif;
		
		// FIXME: RESET_CAPS is temporary code to reset roles and caps if flag is set.
		$caps = get_usermeta( $user->ID, $table_prefix . 'capabilities');
		if ( empty($caps) || defined('RESET_CAPS') ) {
			$level = get_usermeta($user->ID, $table_prefix . 'user_level');
			$role = translate_level_to_role($level);
			update_usermeta( $user->ID, $table_prefix . 'capabilities', array($role => true) );
		}
			
	endforeach;
	$old_user_fields = array( 'user_firstname', 'user_lastname', 'user_icq', 'user_aim', 'user_msn', 'user_yim', 'user_idmode', 'user_ip', 'user_domain', 'user_browser', 'user_description', 'user_nickname', 'user_level' );
	$wpdb->hide_errors();
	foreach ( $old_user_fields as $old )
		$wpdb->query("ALTER TABLE $wpdb->users DROP $old");
	$wpdb->show_errors();
	
	if ( 0 == $wpdb->get_var("SELECT SUM(category_count) FROM $wpdb->categories") ) { // Create counts
		$categories = $wpdb->get_col("SELECT cat_ID FROM $wpdb->categories");
		foreach ( $categories as $cat_id ) {
			$count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->post2cat, $wpdb->posts WHERE $wpdb->posts.ID=$wpdb->post2cat.post_id AND post_status='publish' AND category_id = '$cat_id'");
			$wpdb->query("UPDATE $wpdb->categories SET category_count = '$count' WHERE cat_ID = '$cat_id'");
		}
	}

	// populate comment_count field of posts table
	$comments = $wpdb->get_results( "SELECT comment_post_ID, COUNT(*) as c FROM $wpdb->comments WHERE comment_approved = '1' GROUP BY comment_post_ID" );
	if( is_array( $comments ) ) {
		foreach ($comments as $comment) {
			$wpdb->query( "UPDATE $wpdb->posts SET comment_count = $comment->c WHERE ID = '$comment->comment_post_ID'" );
		}
	}

	// Some alpha versions used a post status of object instead of attachment and put
	// the mime type in post_type instead of post_mime_type.
	if ( $wp_current_db_version > 2541 && $wp_current_db_version <= 3091 ) {
		$objects = $wpdb->get_results("SELECT ID, post_type FROM $wpdb->posts WHERE post_status = 'object'");
		foreach ($objects as $object) {
			$wpdb->query("UPDATE $wpdb->posts SET post_status = 'attachment',
			post_mime_type = '$object->post_type',
			post_type = ''
			WHERE ID = $object->ID");
			
			$meta = get_post_meta($object->ID, 'imagedata', true);
			if ( ! empty($meta['file']) )
				add_post_meta($object->ID, '_wp_attached_file', $meta['file']);
		}
	}
}

// The functions we use to actually do stuff

// General
function maybe_create_table($table_name, $create_ddl) {
    global $wpdb;
    foreach ($wpdb->get_col("SHOW TABLES",0) as $table ) {
        if ($table == $table_name) {
            return true;
        }
    }
    //didn't find it try to create it.
    $q = $wpdb->query($create_ddl);
    // we cannot directly tell that whether this succeeded!
    foreach ($wpdb->get_col("SHOW TABLES",0) as $table ) {
        if ($table == $table_name) {
            return true;
        }
    }
    return false;
}

function drop_index($table, $index) {
	global $wpdb;
	$wpdb->hide_errors();
	$wpdb->query("ALTER TABLE `$table` DROP INDEX `$index`");
	// Now we need to take out all the extra ones we may have created
	for ($i = 0; $i < 25; $i++) {
		$wpdb->query("ALTER TABLE `$table` DROP INDEX `{$index}_$i`");
	}
	$wpdb->show_errors();
	return true;
}

function add_clean_index($table, $index) {
	global $wpdb;
	drop_index($table, $index);
	$wpdb->query("ALTER TABLE `$table` ADD INDEX ( `$index` )");
	return true;
}

/**
 ** maybe_add_column()
 ** Add column to db table if it doesn't exist.
 ** Returns:  true if already exists or on successful completion
 **           false on error
 */
function maybe_add_column($table_name, $column_name, $create_ddl) {
    global $wpdb, $debug;
    foreach ($wpdb->get_col("DESC $table_name", 0) as $column ) {
        if ($debug) echo("checking $column == $column_name<br />");
        if ($column == $column_name) {
            return true;
        }
    }
    //didn't find it try to create it.
    $q = $wpdb->query($create_ddl);
    // we cannot directly tell that whether this succeeded!
    foreach ($wpdb->get_col("DESC $table_name", 0) as $column ) {
        if ($column == $column_name) {
            return true;
        }
    }
    return false;
}


// get_alloptions as it was for 1.2.
function get_alloptions_110() {
	global $wpdb;
	if ($options = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options")) {
		foreach ($options as $option) {
			// "When trying to design a foolproof system, 
			//  never underestimate the ingenuity of the fools :)" -- Dougal
			if ('siteurl' == $option->option_name) $option->option_value = preg_replace('|/+$|', '', $option->option_value);
			if ('home' == $option->option_name) $option->option_value = preg_replace('|/+$|', '', $option->option_value);
			if ('category_base' == $option->option_name) $option->option_value = preg_replace('|/+$|', '', $option->option_value);
			$all_options->{$option->option_name} = stripslashes($option->option_value);
		}
	}
	return $all_options;
}

// Version of get_option that is private to install/upgrade.
function __get_option($setting) {
	global $wpdb;

	$option = $wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = '$setting'");

	if ( 'home' == $setting && '' == $option )
		return __get_option('siteurl');

	if ( 'siteurl' == $setting || 'home' == $setting || 'category_base' == $setting )
		$option = preg_replace('|/+$|', '', $option);

	@ $kellogs = unserialize($option);
	if ($kellogs !== FALSE)
		return $kellogs;
	else
		return $option;
}

function deslash($content) {
    // Note: \\\ inside a regex denotes a single backslash.

    // Replace one or more backslashes followed by a single quote with
    // a single quote.
    $content = preg_replace("/\\\+'/", "'", $content);

    // Replace one or more backslashes followed by a double quote with
    // a double quote.
    $content = preg_replace('/\\\+"/', '"', $content);

    // Replace one or more backslashes with one backslash.
    $content = preg_replace("/\\\+/", "\\", $content);

    return $content;
}

function dbDelta($queries, $execute = true) {
	global $wpdb;
	
	// Seperate individual queries into an array
	if( !is_array($queries) ) {
		$queries = explode( ';', $queries );
		if('' == $queries[count($queries) - 1]) array_pop($queries);
	}
	
	$cqueries = array(); // Creation Queries
	$iqueries = array(); // Insertion Queries
	$for_update = array();
	
	// Create a tablename index for an array ($cqueries) of queries
	foreach($queries as $qry) {
		if(preg_match("|CREATE TABLE ([^ ]*)|", $qry, $matches)) {
			$cqueries[strtolower($matches[1])] = $qry;
			$for_update[$matches[1]] = 'Created table '.$matches[1];
		}
		else if(preg_match("|CREATE DATABASE ([^ ]*)|", $qry, $matches)) {
			array_unshift($cqueries, $qry);
		}
		else if(preg_match("|INSERT INTO ([^ ]*)|", $qry, $matches)) {
			$iqueries[] = $qry;
		}
		else if(preg_match("|UPDATE ([^ ]*)|", $qry, $matches)) {
			$iqueries[] = $qry;
		}
		else {
			// Unrecognized query type
		}
	}	

	// Check to see which tables and fields exist
	if($tables = $wpdb->get_col('SHOW TABLES;')) {
		// For every table in the database
		foreach($tables as $table) {
			// If a table query exists for the database table...
			if( array_key_exists(strtolower($table), $cqueries) ) {
				// Clear the field and index arrays
				unset($cfields);
				unset($indices);
				// Get all of the field names in the query from between the parens
				preg_match("|\((.*)\)|ms", $cqueries[strtolower($table)], $match2);
				$qryline = trim($match2[1]);

				// Separate field lines into an array
				$flds = explode("\n", $qryline);

				//echo "<hr/><pre>\n".print_r(strtolower($table), true).":\n".print_r($cqueries, true)."</pre><hr/>";
				
				// For every field line specified in the query
				foreach($flds as $fld) {
					// Extract the field name
					preg_match("|^([^ ]*)|", trim($fld), $fvals);
					$fieldname = $fvals[1];
					
					// Verify the found field name
					$validfield = true;
					switch(strtolower($fieldname))
					{
					case '':
					case 'primary':
					case 'index':
					case 'fulltext':
					case 'unique':
					case 'key':
						$validfield = false;
						$indices[] = trim(trim($fld), ", \n");
						break;
					}
					$fld = trim($fld);
					
					// If it's a valid field, add it to the field array
					if($validfield) {
						$cfields[strtolower($fieldname)] = trim($fld, ", \n");
					}
				}
				
				// Fetch the table column structure from the database
				$tablefields = $wpdb->get_results("DESCRIBE {$table};");
								
				// For every field in the table
				foreach($tablefields as $tablefield) {				
					// If the table field exists in the field array...
					if(array_key_exists(strtolower($tablefield->Field), $cfields)) {
						// Get the field type from the query
						preg_match("|".$tablefield->Field." ([^ ]*( unsigned)?)|i", $cfields[strtolower($tablefield->Field)], $matches);
						$fieldtype = $matches[1];

						// Is actual field type different from the field type in query?
						if($tablefield->Type != $fieldtype) {
							// Add a query to change the column type
							$cqueries[] = "ALTER TABLE {$table} CHANGE COLUMN {$tablefield->Field} " . $cfields[strtolower($tablefield->Field)];
							$for_update[$table.'.'.$tablefield->Field] = "Changed type of {$table}.{$tablefield->Field} from {$tablefield->Type} to {$fieldtype}";
						}
						
						// Get the default value from the array
							//echo "{$cfields[strtolower($tablefield->Field)]}<br>";
						if(preg_match("| DEFAULT '(.*)'|i", $cfields[strtolower($tablefield->Field)], $matches)) {
							$default_value = $matches[1];
							if($tablefield->Default != $default_value)
							{
								// Add a query to change the column's default value
								$cqueries[] = "ALTER TABLE {$table} ALTER COLUMN {$tablefield->Field} SET DEFAULT '{$default_value}'";
								$for_update[$table.'.'.$tablefield->Field] = "Changed default value of {$table}.{$tablefield->Field} from {$tablefield->Default} to {$default_value}";
							}
						}

						// Remove the field from the array (so it's not added)
						unset($cfields[strtolower($tablefield->Field)]);
					}
					else {
						// This field exists in the table, but not in the creation queries?
					}
				}

				// For every remaining field specified for the table
				foreach($cfields as $fieldname => $fielddef) {
					// Push a query line into $cqueries that adds the field to that table
					$cqueries[] = "ALTER TABLE {$table} ADD COLUMN $fielddef";
					$for_update[$table.'.'.$fieldname] = 'Added column '.$table.'.'.$fieldname;
				}
				
				// Index stuff goes here
				// Fetch the table index structure from the database
				$tableindices = $wpdb->get_results("SHOW INDEX FROM {$table};");
				
				if($tableindices) {
					// Clear the index array
					unset($index_ary);

					// For every index in the table
					foreach($tableindices as $tableindex) {
						// Add the index to the index data array
						$keyname = $tableindex->Key_name;
						$index_ary[$keyname]['columns'][] = array('fieldname' => $tableindex->Column_name, 'subpart' => $tableindex->Sub_part);
						$index_ary[$keyname]['unique'] = ($tableindex->Non_unique == 0)?true:false;
					}

					// For each actual index in the index array
					foreach($index_ary as $index_name => $index_data) {
						// Build a create string to compare to the query
						$index_string = '';
						if($index_name == 'PRIMARY') {
							$index_string .= 'PRIMARY ';
						}
						else if($index_data['unique']) {
							$index_string .= 'UNIQUE ';
						}
						$index_string .= 'KEY ';
						if($index_name != 'PRIMARY') {
							$index_string .= $index_name;
						}
						$index_columns = '';
						// For each column in the index
						foreach($index_data['columns'] as $column_data) {					
							if($index_columns != '') $index_columns .= ',';
							// Add the field to the column list string
							$index_columns .= $column_data['fieldname'];
							if($column_data['subpart'] != '') {
								$index_columns .= '('.$column_data['subpart'].')';
							}
						}
						// Add the column list to the index create string 
						$index_string .= ' ('.$index_columns.')';

						if(!(($aindex = array_search($index_string, $indices)) === false)) {
							unset($indices[$aindex]);
							//echo "<pre style=\"border:1px solid #ccc;margin-top:5px;\">{$table}:<br/>Found index:".$index_string."</pre>\n";
						}
						//else echo "<pre style=\"border:1px solid #ccc;margin-top:5px;\">{$table}:<br/><b>Did not find index:</b>".$index_string."<br/>".print_r($indices, true)."</pre>\n";
					}
				}

				// For every remaining index specified for the table
				foreach($indices as $index) {
					// Push a query line into $cqueries that adds the index to that table
					$cqueries[] = "ALTER TABLE {$table} ADD $index";
					$for_update[$table.'.'.$fieldname] = 'Added index '.$table.' '.$index;
				}

				// Remove the original table creation query from processing
				unset($cqueries[strtolower($table)]);
				unset($for_update[strtolower($table)]);
			} else {
				// This table exists in the database, but not in the creation queries?
			}
		}
	}

	$allqueries = array_merge($cqueries, $iqueries);
	if($execute) {
		foreach($allqueries as $query) {
			//echo "<pre style=\"border:1px solid #ccc;margin-top:5px;\">".print_r($query, true)."</pre>\n";
			$wpdb->query($query);
		}
	}

	return $for_update;
}

function make_db_current() {
	global $wp_queries;

	$alterations = dbDelta($wp_queries);
	echo "<ol>\n";
	foreach($alterations as $alteration) echo "<li>$alteration</li>\n";
	echo "</ol>\n";
}

function make_db_current_silent() {
	global $wp_queries;

	$alterations = dbDelta($wp_queries);
}

function make_site_theme_from_oldschool($theme_name, $template) {
	$home_path = get_home_path();
	$site_dir = ABSPATH . "wp-content/themes/$template";

	if (! file_exists("$home_path/index.php"))
		return false;

	// Copy files from the old locations to the site theme.
	// TODO: This does not copy arbitarary include dependencies.  Only the
	// standard WP files are copied.
	$files = array('index.php' => 'index.php', 'wp-layout.css' => 'style.css', 'wp-comments.php' => 'comments.php', 'wp-comments-popup.php' => 'comments-popup.php');

	foreach ($files as $oldfile => $newfile) {
		if ($oldfile == 'index.php')
			$oldpath = $home_path;
		else
			$oldpath = ABSPATH;

		if ($oldfile == 'index.php') { // Check to make sure it's not a new index
			$index = implode('', file("$oldpath/$oldfile"));
			if ( strstr( $index, 'WP_USE_THEMES' ) ) {
				if (! @copy(ABSPATH . 'wp-content/themes/default/index.php', "$site_dir/$newfile"))
					return false;
				continue; // Don't copy anything
				}
		}

		if (! @copy("$oldpath/$oldfile", "$site_dir/$newfile"))
			return false;

		chmod("$site_dir/$newfile", 0777);

		// Update the blog header include in each file.
		$lines = explode("\n", implode('', file("$site_dir/$newfile")));
		if ($lines) {
			$f = fopen("$site_dir/$newfile", 'w');

			foreach ($lines as $line) {
				if (preg_match('/require.*wp-blog-header/', $line))
					$line = '//' . $line;

				// Update stylesheet references.
				$line = str_replace("<?php echo __get_option('siteurl'); ?>/wp-layout.css", "<?php bloginfo('stylesheet_url'); ?>", $line);

				// Update comments template inclusion.
				$line = str_replace("<?php include(ABSPATH . 'wp-comments.php'); ?>", "<?php comments_template(); ?>", $line);

				fwrite($f, "{$line}\n");
			}
			fclose($f);
		}
	}

	// Add a theme header.
	$header = "/*\nTheme Name: $theme_name\nTheme URI: " . __get_option('siteurl') . "\nDescription: A theme automatically created by the upgrade.\nVersion: 1.0\nAuthor: Moi\n*/\n";

	$stylelines = file_get_contents("$site_dir/style.css");
	if ($stylelines) {
		$f = fopen("$site_dir/style.css", 'w');

		fwrite($f, $header);
		fwrite($f, $stylelines);
		fclose($f);
	}

	return true;
}

function make_site_theme_from_default($theme_name, $template) {
	$site_dir = ABSPATH . "wp-content/themes/$template";
	$default_dir = ABSPATH . 'wp-content/themes/default';

	// Copy files from the default theme to the site theme.
	//$files = array('index.php', 'comments.php', 'comments-popup.php', 'footer.php', 'header.php', 'sidebar.php', 'style.css');

	$theme_dir = @ dir("$default_dir");
	if ($theme_dir) {
		while(($theme_file = $theme_dir->read()) !== false) {
			if (is_dir("$default_dir/$theme_file"))
				continue;
			if (! @copy("$default_dir/$theme_file", "$site_dir/$theme_file"))
				return;
			chmod("$site_dir/$theme_file", 0777);
		}
	}

	// Rewrite the theme header.
	$stylelines = explode("\n", implode('', file("$site_dir/style.css")));
	if ($stylelines) {
		$f = fopen("$site_dir/style.css", 'w');

		foreach ($stylelines as $line) {
			if (strstr($line, "Theme Name:")) $line = "Theme Name: $theme_name";
			elseif (strstr($line, "Theme URI:")) $line = "Theme URI: " . __get_option('siteurl');
			elseif (strstr($line, "Description:")) $line = "Description: Your theme";
			elseif (strstr($line, "Version:")) $line = "Version: 1";
			elseif (strstr($line, "Author:")) $line = "Author: You";
			fwrite($f, "{$line}\n");
		}
		fclose($f);
	}

	// Copy the images.
	umask(0);
	if (! mkdir("$site_dir/images", 0777)) {
		return false;
	}

	$images_dir = @ dir("$default_dir/images");
	if ($images_dir) {
		while(($image = $images_dir->read()) !== false) {
			if (is_dir("$default_dir/images/$image"))
				continue;
			if (! @copy("$default_dir/images/$image", "$site_dir/images/$image"))
				return;
			chmod("$site_dir/images/$image", 0777);
		}
	}
}

// Create a site theme from the default theme.
function make_site_theme() {
	// Name the theme after the blog.
	$theme_name = __get_option('blogname');
	$template = sanitize_title($theme_name);
	$site_dir = ABSPATH . "wp-content/themes/$template";

	// If the theme already exists, nothing to do.
	if ( is_dir($site_dir)) {
		return false;
	}

	// We must be able to write to the themes dir.
	if (! is_writable(ABSPATH . "wp-content/themes")) {
		return false;
	}

	umask(0);
	if (! mkdir($site_dir, 0777)) {
		return false;
	}

	if (file_exists(ABSPATH . 'wp-layout.css')) {
		if (! make_site_theme_from_oldschool($theme_name, $template)) {
			// TODO:  rm -rf the site theme directory.
			return false;
		}
	} else {
		if (! make_site_theme_from_default($theme_name, $template))
			// TODO:  rm -rf the site theme directory.
			return false;
	}

	// Make the new site theme active.
	$current_template = __get_option('template');
	if ($current_template == 'default') {
		update_option('template', $template);
		update_option('stylesheet', $template);
	}
	return $template;
}

function translate_level_to_role($level) {
	switch ($level) {
	case 10:
	case 9:
	case 8:
		return 'administrator';
	case 7:
	case 6:
	case 5:
		return 'editor';
	case 4:
	case 3:
	case 2:
		return 'author';
	case 1:
		return 'contributor';
	case 0:
		return 'subscriber';
	}
}

?>
