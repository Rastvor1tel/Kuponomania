<?php

$sql = 'CREATE TABLE IF NOT EXISTS `modx_yandex_money_payments` (
  `order_id`   INTEGER UNSIGNED NOT NULL,
  `payment_id` CHAR(36)         NOT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `modx_yandex_money_payments_unq_payment_id` (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8';
$modx->query($sql);

$output = '';
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
        $output = '<h2>Yandex.Money Installer</h2>
<p>Thanks for installing Yandex.Money plugin! Please review the setup options below before proceeding.</p><br />';
        break;
    case xPDOTransport::ACTION_UPGRADE:
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}
return $output;