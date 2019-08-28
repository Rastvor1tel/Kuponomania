<?php
$userId = $modx->user->get('id');
$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');

$result = $bonus->getUserBonusDiscountModifier($userId);

if ($orderSum) {
    $orderSum = preg_replace('/[^0-9\+]/', '', $orderSum);
    $balance = $bonus->getUserBonusBalance($userId);
    $result = $orderSum * $result;
    if (!$front)
        $result = $balance >= $result ? $result : $balance;
}

return $result;