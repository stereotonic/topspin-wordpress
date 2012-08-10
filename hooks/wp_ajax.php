<?php

/*
 *
 *	Last Modified:			May 23, 2012
 *
 *	--------------------------------------
 *	Change Log
 *	--------------------------------------
 *	2012-05-23
 		- Added item lightbox action
 *	2012-03-22
 		- Moved topspin_ajax.php to hooks/wp_ajax.php
 		- Added "topspin_refresh_tags" action
 *	2011-08-12
 		- Added order parameter
 */

add_action('wp_ajax_topspin_get_items','topspin_ajax_get_items');
add_action('wp_ajax_nopriv_topspin_get_items','topspin_ajax_get_items');
add_action('wp_ajax_topspin_refresh_tags','topspin_ajax_refresh_tags');
add_action('wp_ajax_nopriv_topspin_refresh_tags','topspin_ajax_refresh_tags');
add_action('wp_ajax_topspin_get_lightbox','topspin_ajax_get_lightbox');
add_action('wp_ajax_nopriv_topspin_get_lightbox','topspin_ajax_get_lightbox');

function topspin_ajax_get_items() {
	global $store;
	$store_id = esc_attr($_GET['store_id']);
	$offer_types = explode(',',$_GET['offer_types']);
	$tags = explode(',',$_GET['tags']);
	$order = (isset($_GET['order']) && strlen($_GET['order'])) ? $_GET['order'] : null;
	$sort_by = (isset($_GET['sort_by']) && strlen($_GET['sort_by'])) ? $_GET['sort_by'] : 'manual';
	$theStore = $store->getStore($store_id);
	$artist_id = ($artist_id) ? $artist_id : (($theStore) ? $theStore['artist_id'] : null);
	if($theStore && $sort_by=='manual') {
		$itemsList = $store->stores_get_items($store_id);
	}
	else {
		$itemsList = $store->items_get_filtered_list($offer_types,$tags,$artist_id,$order);
		if(count($itemsList)) {
			$itemsOrder = explode(',',$theStore['items_order']);
			$itemsOrderArr = array();
			foreach($itemsOrder as $item) {
				$itemArr = explode(':',$item);
				$itemsOrderArr[$itemArr[0]] = $itemArr[1];
			}
			foreach($itemsList as $key=>$item) {
				$itemsList[$key]['is_public'] = $itemsOrderArr[$item['id']];
			}
		}
	}
	echo json_encode($itemsList);
	die();
}

function topspin_ajax_refresh_tags() {
	global $store;
	$store_id = esc_attr($_GET['store_id']);
	$artist_id = esc_attr($_GET['artist_id']);
	$ret = array('error'=>1);
	$theStore = $store->getStore($store_id);
	if($theStore) { $tags = $store->stores_get_tags($store_id); }
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

function topspin_ajax_get_lightbox() {
	global $store;
	$item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0;
	if($item_id) {
		$item = topspin_get_item($item_id);
		$lightboxFile = topspin_get_template_file('item-lightbox.php');
		echo topspin_get_template_output($lightboxFile,$item);
	}
	die();
}

?>