<?php

add_action('admin_init','topspin_admin_init');

function topspin_admin_init() {
	global $store,$topspin_success;
	if($_SERVER['REQUEST_METHOD']=='POST') {
		if(isset($_POST['action'])) {
			switch($_POST['action']) {
				case "topspin_rerun_upgrades":
					if(isset($_POST['fix_upgrades'])) { topspin_rerun_upgrades(); }
					$topspin_success = 'Plugin upgrade scripts successfully ran.';
					break;
				case "topspin_sync_cache":
					if(isset($_POST['cache_all'])) { $store->rebuildAll(); }
					$topspin_success = 'Cache successfully updated.';
					break;
				case "topspin_general_settings":
					unset($_POST['action']);
					## Empty all stores and store settings if different artist ID is set
					if($_POST['topspin_artist_id']!=$store->settings_get('topspin_artist_id')) {
						$stores = $store->stores_get_list();
						if(count($stores)) {
							foreach($stores as $_store) {
								$store->deleteStore($_store->store_id,1);
								wp_delete_post($_store->ID,1);	//deletes the page from the posts table
							}
						}
					}
	
					## Set Each Option
					foreach($_POST as $key=>$value) {
						$store->settings_set($key,$value); //Update all posted settings on this page.
						update_option($key,$value); //Update WordPress options table (v2.0)
					}
					//$store->rebuildAll();
	
					##	If Artists is Unset (New)
					if(!isset($_POST['topspin_artist_id'])) {
						$artistsList = $store->artists_get_list();
						$store->settings_set('topspin_artist_id',$artistsList[0]['id']);
						update_option('topspin_artist_id',$artistsList[0]['id']);
					}
					$topspin_success = 'Settings saved.';
					break;
			}
		}
	}
}

?>