INSERT INTO `<?php echo $wpdb->prefix;?>topspin_currency` (`currency`, `symbol`) VALUES
('USD', '$'),
('GBP', '&pound;'),
('EUR', '&euro;'),
('JPY', '&yen;'),
('AUD', '&#xA5;'),
('CAD', '$') ON DUPLICATE KEY UPDATE `currency`=`currency`;