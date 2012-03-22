<?php

/*
 *
 *	Last Modified:			March 22, 2012
 *
 *	--------------------------------------
 *	Change Log
 *	--------------------------------------
 *	2012-03-22
 		- Moved topspin_ajax.php to hooks/wp_ajax.php
 		- Added "topspin_refresh_tags" action
 *	2011-08-12
 		- Added order parameter
 */

add_action('wp_ajax_topspin_get_items','topspin_ajax_get_items');
add_action('wp_ajax_topspin_refresh_tags','topspin_ajax_refresh_tags');

function topspin_ajax_get_items() {
	global $store;
	$store_id = esc_attr($_GET['store_id']);
	$offer_types = explode(',',$_GET['offer_types']);
	$tags = explode(',',$_GET['tags']);
	$order = (isset($_GET['order']) && strlen($_GET['order'])) ? $_GET['order'] : null;
	$theStore = $store->getStore($store_id);
	$artist_id = ($theStore) ? $theStore['artist_id'] : null;
	$itemsList = $store->items_get_filtered_list($offer_types,$tags,$artist_id,$order);
	echo json_encode($itemsList);
	die();
}

function topspin_ajax_refresh_tags() {
	global $store;
	$store_id = esc_attr($_GET['store_id']);
	$artist_id = esc_attr($_GET['artist_id']);
	$ret = array('error'=>1);
	$theStore = $store->getStore($store_id);
	if($theStore) { $tags = $store->getStoreTags($store_id); }
	else { $tags = $store->tags_get_list($artist_id); }
	$ret = array(
		'success' => 1,
		'response' => array(
			'tags' => $tags
		)
	);
	echo json_encode($ret);
	die();
}

?>