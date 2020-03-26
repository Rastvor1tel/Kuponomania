<?php
$userId = $modx->user->get('id');
$pdoFetch = new pdoFetch($modx);

$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');
$bonus->checkTable();

if (isset($_POST['b_id']) && intval($_POST['b_id']) > 0) {
    $upd = $bonus->setUserCouponUsed(intval($_POST['b_id']));
}

$result = $bonus->getUserCouponsList($userId, false, true);

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
if (empty($output)) $output[] = '<div class="right-content">Просроченных купонов нет</div>';
return '<div class="global-layout catalog-layout">'.implode("", $output).'</div>';