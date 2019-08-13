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
$paymentStatus = $paymentObject->getStatus();
$paymentMeta = $paymentObject->getMetadata();

$orderId = $paymentMeta['orderId'];
$orderHash = $paymentMeta['orderHash'];


if ($order = $modx->getObject('msOrder', (int)$orderId)) {
    if (($paymentStatus == 'succeeded') && ($orderHash == $handler->getOrderHash($order))) {
        if ($order = $modx->getObject('msOrder', array('id' => $orderId))) {
            $handler->receive($order, $paymentStatus);
        } else {
            $modx->log(modX::LOG_LEVEL_ERROR, '[miniShop2] Не удалось подтвердить заказ с id ' . $orderId);
        }
    }
}