<?php
$result = 0;
if ($product) {
	$pdoFetch = new pdoFetch($modx);

	$bonusCorePath = $modx->getOption('bonus.core_path');
	$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');
	$bonus->checkTable();

	$arProducts = $bonus->getBuyedCount($product);
	foreach ($arProducts as $arItem) {
		$result += $arItem['count'];
	}
}
return $result;