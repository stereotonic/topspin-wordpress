<?php

add_action('topspin_cron_fetch_items','topspin_cron_rebuild');

// Cron Rebuild
function topspin_cron_rebuild() {
	global $store;
	###	Rebuild
	$store->rebuildAll();
}

?>