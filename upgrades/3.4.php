<?php

/*
 *	3.4 UPGRADE NOTICE
 *	--------------------
 *
 	2012-03-22
	 	- Checks and adds a new field to the topspin_tags table (artist_name)
 */

global $wpdb;

// Checks and adds a new field to the topspin_tags table (artist_name)
if(!topspin_table_column_exists('topspin_stores','artist_id','INT')) {
	topspin_table_column_add('topspin_stores','artist_id','INT',array('index'=>1,'after'=>'post_id'));

	// Migrates the pre-3.4 artist_id default setting to current stores
	$artist_id = maybe_unserialize($wpdb->get_var($wpdb->prepare("SELECT `value` FROM `".$wpdb->prefix."topspin_settings` WHERE `name` = 'topspin_artist_id'")));
	if(is_string($artist_id)) { $wpdb->query($wpdb->prepare("UPDATE `".$wpdb->prefix."topspin_stores` SET `artist_id` = %d WHERE `artist_id` = '0'",$artist_id)); }

}

?>