<?php
$userId = $modx->user->get('id');
$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');
return $bonus->getUserBonusBalance($userId);