<?php

add_action('after_setup_theme','topspin_after_setup_theme');

function topspin_after_setup_theme() {

	//Define theme parents and childs
	define('TOPSPIN_CURRENT_THEME_PATH',get_theme_root().'/'.get_stylesheet());
	define('TOPSPIN_CURRENT_THEME_URL',dirname(get_stylesheet_uri()));
	define('TOPSPIN_CURRENT_THEMEPARENT_PATH',get_theme_root().'/'.get_template());
	define('TOPSPIN_CURRENT_THEMEPARENT_URL',get_template_directory());

	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	
	if(is_admin()) {
		wp_enqueue_style('topspin-admin',TOPSPIN_PLUGIN_URL.'/resources/css/admin.css');
	}
	else {
		global $store;
		if($store) {
			$templateMode = $store->settings_get('topspin_template_mode');
			### CSS/JS
			wp_enqueue_style('topspin-default',TOPSPIN_PLUGIN_URL.'/templates/topspin-'.$templateMode.'/topspin.css');
			###	3.1
			if(file_exists(TOPSPIN_CURRENT_THEME_PATH.'/topspin-'.$templateMode.'/topspin.css')) { wp_enqueue_style('topspin-theme',TOPSPIN_CURRENT_THEME_URL.'/topspin-'.$templateMode.'/topspin.css'); }
			###	3.0.0
			elseif(file_exists(TOPSPIN_CURRENT_THEME_PATH.'/topspin.css')) { wp_enqueue_style('topspin-theme',TOPSPIN_CURRENT_THEME_URL.'/topspin.css'); }
			### IE7 CSS
			if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0')) {
				wp_enqueue_style('topspin-default-ie7',TOPSPIN_PLUGIN_URL.'/templates/topspin-'.$templateMode.'/topspin-ie7.css');
				###	3.1
				if(file_exists(TOPSPIN_CURRENT_THEME_PATH.'/topspin-'.$templateMode.'/topspin-ie7.css')) { wp_enqueue_style('topspin-theme',TOPSPIN_CURRENT_THEME_URL.'/topspin-'.$templateMode.'/topspin-ie7.css'); }
				###	3.0.0
				elseif(file_exists(TOPSPIN_CURRENT_THEME_PATH.'/topspin-ie7.css')) { wp_enqueue_style('topspin-theme',TOPSPIN_CURRENT_THEME_URL.'/topspin-ie7.css'); }
			}
			wp_enqueue_style('jquery.colorbox',TOPSPIN_PLUGIN_URL.'/resources/js/colorbox/colorbox.css');
			wp_enqueue_script('jquery.colorbox',TOPSPIN_PLUGIN_URL.'/resources/js/colorbox/jquery.colorbox-min.js',array('jquery'),'1.3.17.2');
			wp_enqueue_script('topspin-core','http://cdn.topspin.net/javascripts/topspin_core.js?aId='.TOPSPIN_ARTIST_ID,null,'3.3');
			wp_enqueue_script('topspin-ready',TOPSPIN_PLUGIN_URL.'/resources/js/topspin.ready.js',array('jquery'),'3.3');
		}
	}
}

?>