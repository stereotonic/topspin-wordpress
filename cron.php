<?php

$wpRoot = dirname(dirname(dirname(dirname(__FILE__))));

include($wpRoot.'/wp-load.php');

topspin_cron_rebuild();

?>