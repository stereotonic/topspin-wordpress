<?php

/*
 *	3.4 UPGRADE NOTICE
 *	--------------------
 *
 	2012-08-10
	 	- Checks and adds a new field to the topspin_items table (created_date)
	 	- Checks and adds a new field to the topspin_stores table (desc_length)
	 	- Checks and adds a new field to the topspin_stores table (sale_tag)
	 	- Checks and adds a new field to the topspin_items table (sku_data)
	 	- Checks and adds a new field to the topspin_items table (in_stock_quantity)
 	2012-03-22
	 	- Checks and adds a new field to the topspin_tags table (artist_name)
 */

global $wpdb;

// Checks and adds a new field to the topspin_tags table (artist_name)
if(!topspin_table_column_exists('topspin_stores','artist_id')) {
	topspin_table_column_add('topspin_stores','artist_id','INT',array('index'=>1,'after'=>'post_id'));

	// Migrates the pre-3.4 artist_id default setting to current stores
	$artist_id = maybe_unserialize($wpdb->get_var($wpdb->prepare("SELECT `value` FROM `".$wpdb->prefix."topspin_settings` WHERE `name` = 'topspin_artist_id'")));
	if(is_string($artist_id)) { $wpdb->query($wpdb->prepare("UPDATE `".$wpdb->prefix."topspin_stores` SET `artist_id` = %d WHERE `artist_id` = '0'",$artist_id)); }

}

// Checks and adds a new field to the topspin_items table (created_date)
if(!topspin_table_column_exists('topspin_items','created_date')) {
	topspin_table_column_add('topspin_items','created_date','DATETIME',array('after'=>'last_modified'));
	
	// Set created_date to last_modified
	$wpdb->query($wpdb->prepare("UPDATE `".$wpdb->prefix."topspin_items` SET `created_date` = `last_modified`"));
}

// Checks and adds a new field to the topspin_stores table (desc_length)
if(!topspin_table_column_exists('topspin_stores','desc_length','INT')) {
	topspin_table_column_add('topspin_stores','desc_length','INT',array('after'=>'internal_name'));
}

// Checks and adds a new field to the topspin_stores table (sale_tag)
if(!topspin_table_column_exists('topspin_stores','sale_tag')) {
	topspin_table_column_add('topspin_stores','sale_tag','VARCHAR(255)',array('after'=>'desc_length'));
}

// Checks and adds a new field to the topspin_items table (sku_data)
if(!topspin_table_column_exists('topspin_items','sku_data')) {
	topspin_table_column_add('topspin_items','sku_data','LONGTEXT',array('after'=>'created_date'));
}

// Checks and adds a new field to the topspin_items table (in_stock_quantity)
if(!topspin_table_column_exists('topspin_items','in_stock_quantity')) {
	topspin_table_column_add('topspin_items','in_stock_quantity','INT',array('after'=>'sku_data'));
}

?>