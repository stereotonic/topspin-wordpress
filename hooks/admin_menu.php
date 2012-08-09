<?php


add_action('admin_menu','topspin_admin_menu');

function topspin_admin_menu() {
	add_menu_page('Topspin','Topspin',6,'topspin/page/settings_general','topspin_page_settings_general');
	add_submenu_page('topspin/page/settings_general','Settings','Settings',6,'topspin/page/settings_general','topspin_page_settings_general');
	add_submenu_page('topspin/page/settings_general','View Stores','View Stores',6,'topspin/page/settings_viewstores','topspin_page_settings_viewstores');
	add_submenu_page('topspin/page/settings_general','View Most Popular','View Most Popular',6,'topspin/page/settings_viewmostpopular','topspin_page_settings_viewmostpopular');
	add_submenu_page('topspin/page/settings_general','View Items','View Items',6,'topspin/page/settings_viewitems','topspin_page_settings_viewitems');
	add_submenu_page('topspin/page/settings_general','View Orders','View Orders',6,'topspin/page/settings_vieworders','topspin_page_settings_vieworders');
	add_submenu_page('topspin/page/settings_general','Store Setup','Add Store',6,'topspin/page/settings_edit','topspin_page_settings_edit');
	add_submenu_page('topspin/page/settings_general','Nav Menu','Nav Menu',6,'topspin/page/settings_navmenu','topspin_page_settings_navmenu');
}

?>