<?php

add_action('plugins_loaded','topspin_plugins_loaded');

function topspin_plugins_loaded() {
	global $store;
	// Instantiate Topspin_Store Class
	$store = new Topspin_Store();

	// Retrieves and sets the API credentials
	if(!defined('TOPSPIN_ARTIST_ID')) { define('TOPSPIN_ARTIST_ID',$store->getSetting('topspin_artist_id')); }
	if(!defined('TOPSPIN_API_USERNAME')) { define('TOPSPIN_API_USERNAME',$store->getSetting('topspin_api_username')); }
	if(!defined('TOPSPIN_API_KEY')) { define('TOPSPIN_API_KEY',$store->getSetting('topspin_api_key')); }
	$store->setAPICredentials(TOPSPIN_ARTIST_ID,TOPSPIN_API_USERNAME,TOPSPIN_API_KEY);
}

?>