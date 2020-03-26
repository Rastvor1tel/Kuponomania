<?php
$userId = $modx->user->get('id');
$pdoFetch = new pdoFetch($modx);

$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');
$bonus->checkTable();

$result = $bonus->getUserCouponsList($userId, true, false);

$placeholders = [];
$output = [];
foreach ($result as $item) {
    $placeholders['id'] = $item['b_id'];
    $placeholders['prod_id'] = $item['prod_id'];
    $placeholders['code'] = $item['code'];
    $placeholders['image'] = $item['image'];
    $placeholders['thumb'] = $item['image'];
    $placeholders['used'] = $item['used'];
    $placeholders['price'] = $item['price'];
    $placeholders['pagetitle'] = $item['pagetitle'];
    $placeholders['introtext'] = $item['introtext'];
    $output[] = $pdoFetch->getChunk('@FILE chunks/User/userCoupons.tpl', $placeholders);
}

return '<div class="global-layout catalog-layout">'.implode("", $output).'</div>';