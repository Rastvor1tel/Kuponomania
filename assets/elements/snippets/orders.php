<?php
$userId = $modx->user->get('id');

$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');
$bonus->checkTable();

$result = $bonus->getUserOrdersList($userId);

$all = 0;
$expired = 0;
foreach ($result as $item) {
    $all += $item['count'];
    if ($item['unpub_date'] < time()) $expired += $item['count'];
}

$result = <<<CONTENT
<ul class="lk-nav">
    <li class="lk-nav-item"><a href="#" class="lk-nav-item-link">Полученные<span class="lk-nav-item-count">$all</span></a></li>
    <li class="lk-nav-item"><a href="#" class="lk-nav-item-link">Просроченные<span class="lk-nav-item-count">$expired</span></a></li>
</ul>
CONTENT;

 return $result;