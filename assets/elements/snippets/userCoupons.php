<?php
$userId = $modx->user->get('id');
$pdoFetch = new pdoFetch($modx);

$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');
$bonus->checkTable();

if (isset($_POST['b_id']) && intval($_POST['b_id']) > 0) {
	$upd = $bonus->setUserCouponUsed(intval($_POST['b_id']));
}

if ($mode == 'expired')
	$result = $bonus->getUserCouponsList($userId, 'expired');
elseif ($mode == 'used')
	$result = $bonus->getUserCouponsList($userId, 'used');
else
	$result = $bonus->getUserCouponsList($userId);

$placeholders = [];
$output = [];
foreach ($result as $item) {
	$query = $modx->newQuery('modTemplateVarResource');
	$query->select([
		'modTemplateVarResource.*',
	]);
	$query->where([
		'modTemplateVarResource.contentid' => $item['product_id'],
		'modTemplateVarResource.tmplvarid' => 11
	]);
	$query->prepare();
	$query->stmt->execute();
	$image = $query->stmt->fetchAll(PDO::FETCH_ASSOC)[0]['value'];
	$placeholders = [
		'id'           => $item['b_id'],
		'prod_id'      => $item['prod_id'],
		'code'         => $item['code'],
		'image'        => $item['image'],
		'previewImage' => $image,
		'used'         => $item['used'],
		'price'        => $item['price'],
		'pagetitle'    => $item['pagetitle'],
		'introtext'    => $item['introtext']
	];
	$output[] = $pdoFetch->getChunk('@FILE chunks/User/userCoupons.tpl', $placeholders);
}

return '<div class="global-layout catalog-layout">' . implode("", $output) . '</div>';