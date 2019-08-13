<?php
$userId = $modx->user->get('id');

$query = $modx->newQuery('msOrder');
$query->select([
    'msOrder.*',
    'msOrderProduct.product_id',
    'msOrderProduct.count',
    'modResource.unpub_date'
]);
$query->where([
    'msOrder.user_id' => $userId
]);
$query->innerJoin('msOrderProduct', 'msOrderProduct', 'msOrder.id = msOrderProduct.order_id');
$query->innerJoin('modResource', 'modResource', 'msOrderProduct.product_id = modResource.id');
$query->prepare();
$query->stmt->execute();
$result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
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