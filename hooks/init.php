<?php

add_action('init','topspin_init');

function topspin_init() {
	// Initialize WP-Cron
	global $store;
	if($store->settings_get('topspin_cache_system')=="WP-Cron") { topspin_cron_init(); }
	
	define('TOPSPIN_NEW_CUTOFF_DATE',date('Y-m-d H:i:s',time()-(3600*24*3)));
}

?>