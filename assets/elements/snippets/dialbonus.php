<?php
$defaultBonusCorePath = $modx->getOption('core_path') . 'components/dialbonus/';
$bonusCorePath = $modx->getOption('bonus.core_path', null, $defaultBonusCorePath);
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/', $scriptProperties);

/* setup default properties */
$tpl = $modx->getOption('tpl', $scriptProperties, 'rowTpl');
$sort = $modx->getOption('sort', $scriptProperties, 'name');
$dir = $modx->getOption('dir', $scriptProperties, 'ASC');

$output = '';

$bonus->checkTable();

return $output;