<?php
$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');

if ($modx->event->name == 'msOnChangeOrderStatus') {
    if ($status == 2) {
        $userId = $order->get('user_id');
        $orderId = $order->get('id');
        $orderSum = $order->get('cost');

        $bonus->checkTable();
        $bonus->decreaseBonusBalance($orderId, $userId);
        $bonus->setBonusBalance($orderId, $userId);
    }
}

if ($modx->event->name == 'msOnCreateOrder') {
    $order = $order->get();
    $useBonus = $order['extfld_bonuspayed'];
    if ($useBonus) {
        $userId = $msOrder->get('user_id');
        $userBonusBalance = $bonus->getUserBonusBalance($userId);
        $orderCost = $msOrder->get('cost');
        $cartCost = $msOrder->get('cart_cost');
        $maxBonusDiscount = $orderCost * $bonus->getUserBonusDiscountModifier($userId);
        $payedBonus = $order['extfld_bonusvalue'];
        if (($payedBonus <= $maxBonusDiscount) && ($payedBonus <= $userBonusBalance)) {
            $msOrder->set("cost",$orderCost - $payedBonus);
            $msOrder->save();
        }
    }
}