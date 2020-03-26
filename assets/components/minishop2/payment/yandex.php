<?php
define('MODX_API_MODE', true);
/** @noinspection PhpIncludeInspection */
require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php';

/** @var modX $modx */
$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');

/** @var miniShop2 $miniShop2 */
$miniShop2 = $modx->getService('miniShop2');
$miniShop2->loadCustomClasses('payment');

if (!class_exists('Yandex')) {
	exit('Error: не удалось загрузить класс "Yandex".');
}
/** @var msOrder $order */
$order = $modx->newObject('msOrder');
/** @var msPaymentInterface|Yandex $handler */
$handler = new Yandex($order);

$paymentObject = $handler->requestCheck();
$arPayment = [
	'ID'     => $paymentObject->getId(),
	'AMOUNT' => $paymentObject->getAmount(),
	'STATUS' => $paymentObject->getStatus(),
	'META'   => $paymentObject->getMetadata()
];

$orderId = $arPayment['META']['orderId'];
$orderHash = $arPayment['META']['orderHash'];

if ($order = $modx->getObject('msOrder', (int)$orderId)) {
	if (($arPayment['STATUS'] == 'succeeded') && ($orderHash == $handler->getOrderHash($order))) {
		if ($order = $modx->getObject('msOrder', ['id' => $orderId])) {
			$handler->changeStatus($order, $arPayment['STATUS']);
			$items = $handler->getOrder($orderId);
			$handler->createPayment($orderId, $arPayment['ID'], $arPayment['AMOUNT'], $items);
		} else {
			$modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2] Не удалось подтвердить заказ с id ' . $orderId);
		}
	}
}