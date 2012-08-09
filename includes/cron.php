<?php

function topspin_cron_init() {
	if(!wp_next_scheduled('topspin_cron_fetch_items')) {
		wp_schedule_event(time(),'every_5_min','topspin_cron_fetch_items');
	}
}

?>