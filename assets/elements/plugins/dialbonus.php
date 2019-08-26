<?php
if ($status == 2) {
    $orderPrice = $order->_fields['cost'];
    $userId = $order->_fields['user_id'];

    $defaultBonusCorePath = $modx->getOption('core_path') . 'components/dialbonus/';
    $bonusCorePath = $modx->getOption('bonus.core_path', null, $defaultBonusCorePath);
    $bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/', $scriptProperties);
    $bonus->checkTable();

    $userData = $bonus->getUserBalanceData($userId);
    $bonusGroupsList = $bonus->getBonusGroupList();
    $bonus->bonusLvlUp($userId);
    die();
}