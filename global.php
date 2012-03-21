<?php
/*
 *	Last Modified:		March 14, 2012
 *
 *	----------------------------------
 *	Change Log
 *	----------------------------------
 *	2012-03-14
 		- Organized files.
 *	2011-07-26
 		- included 2 new file "topspin_db.php", and "topspin_template_tags.php"
 *	2011-04-06
 		- updated the $store->setAPICredentials() call method and reordered topspin api constants
 */

// Pathing Constants
define('TOPSPIN_VERSION','3.3.3.3');
define('TOPSPIN_PLUGIN_PATH',dirname(__FILE__));
define('TOPSPIN_PLUGIN_URL',WP_PLUGIN_URL.'/'.basename(TOPSPIN_PLUGIN_PATH));
define('TOPSPIN_CURRENT_THEME_PATH',get_theme_root().'/'.get_stylesheet());
define('TOPSPIN_CURRENT_THEME_URL',dirname(get_stylesheet_uri()));
define('TOPSPIN_CURRENT_THEMEPARENT_PATH',get_theme_root().'/'.get_template());
define('TOPSPIN_CURRENT_THEMEPARENT_URL',get_template_directory());

// Include Plugin Classes
require_once('classes/Topspin_Store.php');

// Include Plugin Files
require_once(TOPSPIN_PLUGIN_PATH.'/includes/activation.php');
require_once(TOPSPIN_PLUGIN_PATH.'/includes/cron.php');
require_once(TOPSPIN_PLUGIN_PATH.'/includes/db.php');
require_once(TOPSPIN_PLUGIN_PATH.'/includes/page.php');
require_once(TOPSPIN_PLUGIN_PATH.'/includes/shortcodes.php');
require_once(TOPSPIN_PLUGIN_PATH.'/includes/template-tags.php');
require_once(TOPSPIN_PLUGIN_PATH.'/includes/upgrade.php');

// Load Hooks
require_once(TOPSPIN_PLUGIN_PATH.'/hooks/admin_menu.php');
require_once(TOPSPIN_PLUGIN_PATH.'/hooks/after_setup_theme.php');
require_once(TOPSPIN_PLUGIN_PATH.'/hooks/cron_schedules.php');
require_once(TOPSPIN_PLUGIN_PATH.'/hooks/init.php');
require_once(TOPSPIN_PLUGIN_PATH.'/hooks/plugins_loaded.php');
require_once(TOPSPIN_PLUGIN_PATH.'/hooks/wp_ajax.php');
require_once(TOPSPIN_PLUGIN_PATH.'/hooks/custom/topspin_cron_fetch_items.php');

//	Deprecated (version 2.0.0)
require_once(TOPSPIN_PLUGIN_PATH.'/deprecated/topspin_2.0.php');

?>