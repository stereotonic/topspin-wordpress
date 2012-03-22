<?php

add_action('plugins_loaded','topspin_plugins_loaded');

function topspin_plugins_loaded() {
	global $store;
	// Instantiate Topspin_Store Class
	$store = new Topspin_Store();

	// Retrieves and sets the API credentials
	if(!defined('TOPSPIN_API_USERNAME')) { define('TOPSPIN_API_USERNAME',$store->settings_get('topspin_api_username')); }
	if(!defined('TOPSPIN_API_KEY')) { define('TOPSPIN_API_KEY',$store->settings_get('topspin_api_key')); }

	if(version_compare(get_option('topspin_version'),TOPSPIN_VERSION,'<')) {
		update_option('topspin_update_check',0);
		add_action('init','topspin_upgrade');
	}
	else {
		if(!get_option('topspin_update_check')) {
			add_action('init','topspin_upgrade');
		}
	}

}

?>