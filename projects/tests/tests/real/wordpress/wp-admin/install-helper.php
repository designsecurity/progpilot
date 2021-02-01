<?php
require_once('../wp-config.php');
$debug = 0;

/**
 ** maybe_create_table()
 ** Create db table if it doesn't exist.
 ** Returns:  true if already exists or on successful completion
 **           false on error
 */
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

/**
 ** maybe_add_column()
 ** Add column to db table if it doesn't exist.
 ** Returns:  true if already exists or on successful completion
 **           false on error
 */
function maybe_add_column($table_name, $column_name, $create_ddl) {
    global $wpdb, $debug;
    foreach ($wpdb->get_col("DESC $table_name",0) as $column ) {
        if ($debug) echo("checking $column == $column_name<br />");
        if ($column == $column_name) {
            return true;
        }
    }
    //didn't find it try to create it.
    $q = $wpdb->query($create_ddl);
    // we cannot directly tell that whether this succeeded!
    foreach ($wpdb->get_col("DESC $table_name",0) as $column ) {
        if ($column == $column_name) {
            return true;
        }
    }
    return false;
}


/**
 ** maybe_drop_column()
 ** Drop column from db table if it exists.
 ** Returns:  true if it doesn't already exist or on successful drop
 **           false on error
 */
function maybe_drop_column($table_name, $column_name, $drop_ddl) {
    global $wpdb;
    foreach ($wpdb->get_col("DESC $table_name",0) as $column ) {
        if ($column == $column_name) {
            //found it try to drop it.
            $q = $wpdb->query($drop_ddl);
            // we cannot directly tell that whether this succeeded!
            foreach ($wpdb->get_col("DESC $table_name",0) as $column ) {
                if ($column == $column_name) {
                    return false;
                }
            }
        }
    }
    // else didn't find it
    return true;
}


/**
 ** check_column()
 ** Check column matches passed in criteria.
 ** Pass in null to skip checking that criteria
 ** Returns:  true if it matches
 **           false otherwise
 ** (case sensitive) Column names returned from DESC table are:
 **      Field
 **      Type
 **      Null
 **      Key
 **      Default
 **      Extra
 */
function check_column($table_name, $col_name, $col_type, $is_null = null, $key = null, $default = null, $extra = null) {
    global $wpdb, $debug;
    $diffs = 0;
    $results = $wpdb->get_results("DESC $table_name");
    
    foreach ($results as $row ) {
        if ($debug > 1) print_r($row);
        if ($row->Field == $col_name) {
            // got our column, check the params
            if ($debug) echo ("checking $row->Type against $col_type\n");
            if (($col_type != null) && ($row->Type != $col_type)) {
                ++$diffs;
            }
            if (($is_null != null) && ($row->Null != $is_null)) {
                ++$diffs;
            }
            if (($key != null) && ($row->Key  != $key)) {
                ++$diffs;
            }
            if (($default != null) && ($row->Default != $default)) {
                ++$diffs;
            }
            if (($extra != null) && ($row->Extra != $extra)) {
                ++$diffs;
            }
            if ($diffs > 0) {
                if ($debug) echo ("diffs = $diffs returning false\n");
                return false;
            }
            return true;
        } // end if found our column
    }
    return false;
}
    
/*
echo "<p>testing</p>";
echo "<pre>";

//check_column('wp_links', 'link_description', 'mediumtext'); 
//if (check_column($wpdb->comments, 'comment_author', 'tinytext'))
//    echo "ok\n";
$error_count = 0;
$tablename = $wpdb->links;
// check the column
if (!check_column($wpdb->links, 'link_description', 'varchar(255)'))
{
    $ddl = "ALTER TABLE $wpdb->links MODIFY COLUMN link_description varchar(255) NOT NULL DEFAULT '' ";
    $q = $wpdb->query($ddl);
}
if (check_column($wpdb->links, 'link_description', 'varchar(255)')) {
    $res .= $tablename . ' - ok <br />';
} else {
    $res .= 'There was a problem with ' . $tablename . '<br />';
    ++$error_count;
}
echo "</pre>";
*/
?>