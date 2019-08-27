<?php
if ($status == 2) {
    $orderPrice = $order->_fields['cost'];
    $userId = $order->_fields['user_id'];

    $bonusCorePath = $modx->getOption('bonus.core_path');
    $bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');
    $bonus->checkTable();

    $bonus->setBonusLvlUp($userId);
    $bonus->setBonusBalance($orderPrice, $userId);
}