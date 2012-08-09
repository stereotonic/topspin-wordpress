<?php

add_action('wp_head','topspin_wp_head');

function topspin_wp_head() {
	$html ='<script type="text/javascript">var ajaxurl = \'%s\'</script>';
	echo sprintf($html,admin_url('admin-ajax.php'));
}

?>