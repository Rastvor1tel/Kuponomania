<?php
$modx->regClientScript($modx->getOption('bonus.assets_url') . 'js/web/progressbar.min.js');
$modx->regClientScript($modx->getOption('bonus.assets_url') . 'js/web/bonuspage.js');

$userId = $modx->user->get('id');
$pdoFetch = new pdoFetch($modx);
$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');

$tpl = $modx->getOption('tpl', $scriptProperties, '@FILE chunks/DialBonus/detailBonusPage.tpl');

$userOrderSum = $bonus->getUserOrdersSum($userId);
$userBonusGroupId = $bonus->getUserBalanceData($userId)['bonus_group'];
$bonusGroups = $bonus->getBonusGroupList();

$placeholders = [];
$curGroupKey = 0;

$placeholders['order_sum'] = $userOrderSum;

foreach ($bonusGroups as $key => $group) {
    if ($group['id'] == $userBonusGroupId) {
        $placeholders['cur_group_name'] = $group['name'];
        $placeholders['cur_group_border'] = (int)$group['order_sum'];
        $placeholders['cur_group_discount'] = $group['bonus_on_order'];
        $placeholders['sum_to_next_group'] = $group['order_sum'] - $userOrderSum;
        $curGroupKey = $key + 1;
    }
    if (($curGroupKey == $key) && ($curGroupKey > 0)) {
        $placeholders['next_group_name'] = $group['name'];
        $placeholders['next_group_discount'] = $group['bonus_on_order'] - $placeholders['cur_group_discount'];
    }
}


$output = $pdoFetch->getChunk($tpl, $placeholders);
return $output;