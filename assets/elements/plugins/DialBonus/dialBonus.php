<?php
$userId = $modx->user->get('id');
$bonusCorePath = $modx->getOption('bonus.core_path');
$bonus = $modx->getService('dialbonus', 'DialBonus', $bonusCorePath . 'model/dialbonus/');

if ($modx->event->name == 'OnUserSave') {
    $userId = $user->get('id');
    $bonus->addBonusUser($userId);
}

if ($modx->event->name == 'msOnChangeOrderStatus') {
    if ($status == 2) {
        $userId = $order->get('user_id');
        $orderId = $order->get('id');
        $orderSum = $order->get('cost');

        $bonus->checkTable();
        $bonus->decreaseBonusBalance($orderId, $userId);
        $bonus->setBonusBalanceAfterOrder($orderId, $userId);
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

if (($modx->event->name == 'OnPageNotFound')) {
    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') return;

    if ($_REQUEST['q'] == 'bonus-promocode') {
        $bonusCode = $bonus->getBonusCode($_REQUEST['bonuscode']);
        $bonusCodeResult = [];
        if ($bonusCode['active']) {
            if ($bonusCode['multiple']) {
                $arUser = $bonus->getUserBalanceData($userId);
                $userCoupons = explode(',', $arUser['bonus_code']);
                if(($userCoupons[0] != $bonusCode['id']) && (!in_array($bonusCode['id'], $userCoupons))) {
                    $bonus->increaseBonusBalance($bonusCode['value'], $userId);
                    $bonusCodeResult['message'] = "Код успешно активирован.";
                    $bonusCodeResult['status'] = "success";
                    $bonus->addBonusCode2User($userId, $bonusCode['id']);
                } else {
                    $bonusCodeResult['message'] = "Этот код был уже активирован вами.";
                    $bonusCodeResult['status'] = "error";
                }
            } else {
                $bonus->increaseBonusBalance($bonusCode['value'], $userId);
                $bonusCodeResult['message'] = "Код успешно активирован.";
                $bonusCodeResult['status'] = "success";
                $bonus->updateBonusCode($bonusCode['name'], 'active', 0);
            }
        } else {
            $bonusCodeResult['message'] = "Такого кода нет или он не действителен.";
            $bonusCodeResult['status'] = "error";
        }
        $bonusCodeResult['balance'] = $bonus->getUserBonusBalance($userId);
        echo json_encode($bonusCodeResult);
        die();
    }
}