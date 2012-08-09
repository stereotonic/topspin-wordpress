<?php

/*
 *	Template Related Functions
 */


function topspin_get_template_file($filename) {
	global $store;
	$templateMode = $store->settings_get('topspin_template_mode');
	$templateFile = sprintf('%s/templates/topspin-%s/%s',TOPSPIN_PLUGIN_PATH,$templateMode,$filename);
	
	// 3.0.0
	$currentPath = sprintf('%s/topspin-templates/%s',TOPSPIN_CURRENT_THEME_PATH,$filename);
	$currentParentPath = sprintf('%s/topspin-templates/%s',TOPSPIN_CURRENT_THEMEPARENT_PATH,$filename);
	if(file_exists($currentPath)) { $templateFile = $currentPath; }
	elseif(file_exists($currentParentPath)) { $templateFile = $currentParentPath; }

	// 3.1
	$currentPath = sprintf('%s/topspin-%s/%s',TOPSPIN_CURRENT_THEME_PATH,$templateMode,$filename);
	$currentParentPath = sprintf('%s/topspin-%s/%s',TOPSPIN_CURRENT_THEMEPARENT_PATH,$templateMode,$filename);
	if(file_exists($currentPath)) { $templateFile = $currentPath; }
	elseif(file_exists($currentParentPath)) { $templateFile = $currentParentPath; }

	return $templateFile;
}

function topspin_get_template_output($templateFile,$item=null) {
	/*
	 *	PARAMETERS
	 		@templateFile (string)			Obtained from topspin_get_template_file()
	 */
	ob_start();
	include($templateFile);
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
}

?>