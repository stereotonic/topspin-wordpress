<?php

add_action('init','topspin_init');

function topspin_init() {
	// Initialize WP-Cron
	topspin_cron_init();
}

?>