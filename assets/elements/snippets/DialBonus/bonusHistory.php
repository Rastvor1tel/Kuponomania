<?php
$userId = $modx->user->get('id');
$pdoFetch = new pdoFetch($modx);
$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');

$tplWrapper = $modx->getOption('tpl', $scriptProperties, '@FILE chunks/DialBonus/bonusHistoryWrapper.tpl');
$tplInner = $modx->getOption('tpl', $scriptProperties, '@FILE chunks/DialBonus/bonusHistoryInner.tpl');

$bonusHistory = $bonus->getUserBonusHistory($userId);

$placeholders = [];

foreach ($bonusHistory as $item) {
    if ($item['type'] == 'writeon')
        $itemName = 'Зачисление';
    else
        $itemName = 'Списание';
    $placeholders[] = $pdoFetch->getChunk($tplInner, [
        'date' => $item['date'],
        'name' => $itemName,
        'value' => $item['value'],
        'class' => $item['type']
    ]);
}

if ($placeholders) $placeholders = implode("\n", $placeholders);

$output = $pdoFetch->getChunk($tplWrapper, [
    'wrapper' => $placeholders
]);
return $output;