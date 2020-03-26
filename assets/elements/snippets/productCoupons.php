<?php
$pdoFetch = new pdoFetch($modx);

$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');
$bonus->checkTable();

$result = $bonus->checkProductCoupons($product);

$placeholders = [];
$output = [];

if($result) {
	$placeholders['active'] = 'haveCoupons';
	if ($type == 'buy') {
		$placeholders['text'] = 'Купить';
	} else {
		$placeholders['text'] = 'Выбрать купон';
	}
} else {
	$placeholders['active'] = 'noneCoupons';
	$placeholders['text'] = 'Нет в наличии';
}

$output = $pdoFetch->getChunk($tpl, $placeholders);

return $output;
