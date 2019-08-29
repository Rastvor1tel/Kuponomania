<?php

class DialBonus {
    public $modx;
    public $config = array();

    function __construct(modX &$modx, array $config = array()) {
        $this->modx =& $modx;

        $basePath = $this->modx->getOption('bonus.core_path', $config, $this->modx->getOption('core_path') . 'components/dialbonus/');
        $assetsUrl = $this->modx->getOption('bonus.assets_url', $config, $this->modx->getOption('assets_url') . 'components/dialbonus/');
        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath . 'model/',
            'processorsPath' => $basePath . 'processors/',
            'chunksPath' => $basePath . 'elements/chunks/',
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl . 'connector.php',
        ), $config);
        $this->modx->addPackage('dialbonus', $this->config['modelPath']);
    }

    public function checkTable() {
        $query = $this->modx->newQuery('dialBonusBalance');
        $query->select(['dialBonusBalance.*']);
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$result) {
            $manager = $this->modx->getManager();
            $manager->createObjectContainer('dialBonusBalance');
            $manager->createObjectContainer('dialBonusOperation');
            $manager->createObjectContainer('dialBonusGroup');
            $manager->createObjectContainer('dialBonusCode');
        }
    }

    private function setUserBonusBalanceField($userId, $field, $value) {
        $query = $this->modx->newQuery('dialBonusBalance');
        $query->command('update');
        $query->set([
            $field => $value
        ]);
        $query->where([
            'user_id' => $userId
        ]);
        $query->prepare();
        $query->stmt->execute();
    }

    private function addBonusOperation($userId, $bonusValue, $type) {
        $query = $this->modx->newObject('dialBonusOperation', [
            'user_id' => $userId,
            'date' => date('Y-m-d H:i:s'),
            'value' => $bonusValue,
            'type' => $type
        ]);
        $query->save();
    }

    public function getBonusGroupList() {
        $query = $this->modx->newQuery('dialBonusGroup');
        $query->select(['dialBonusGroup.*']);
        $query->sortby('order_sum', 'ASC');
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserBalanceData($userId) {
        $query = $this->modx->newQuery('dialBonusBalance');
        $query->select(['dialBonusBalance.*']);
        $query->where([
            'dialBonusBalance.user_id' => $userId
        ]);
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        return $result;
    }

    public function getUserBonusBalance($userId) {
        $userData = $this->getUserBalanceData($userId);
        $result = $userData['value'];
        return $result;
    }

    public function getUserBonusHistory($userId) {
        $query = $this->modx->newQuery('dialBonusOperation');
        $query->select(['dialBonusOperation.*']);
        $query->sortby('date', 'DESC');
        $query->where([
            'user_id' => $userId
        ]);
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    private function getBonusGroup($groupId) {
        $query = $this->modx->newQuery('dialBonusGroup');
        $query->select(['dialBonusGroup.*']);
        $query->sortby('order_sum', 'ASC');
        $query->where([
            'id' => $groupId
        ]);
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        return $result;
    }

    private function getUserBonusGroup($userId) {
        $userData = $this->getUserBalanceData($userId);
        $result = $this->getBonusGroup($userData['bonus_group']);
        return $result;
    }

    private function getUserBonusModifier($userId) {
        $bonusGroup = $this->getUserBonusGroup($userId);
        $result = $bonusGroup['bonus_from_order'] / 100;
        return $result;
    }

    public function getUserBonusDiscountModifier($userId) {
        $bonusGroup = $this->getUserBonusGroup($userId);
        $result = $bonusGroup['bonus_on_order'] / 100;
        return $result;
    }

    public function getUserOrdersList($userId) {
        $query = $this->modx->newQuery('msOrder');
        $query->select([
            'msOrder.*',
            'msOrderProduct.product_id',
            'msOrderProduct.count',
            'modResource.unpub_date'
        ]);
        $query->where([
            'msOrder.user_id' => $userId,
            'msOrder.status' => 2
        ]);
        $query->innerJoin('msOrderProduct', 'msOrderProduct', 'msOrder.id = msOrderProduct.order_id');
        $query->innerJoin('modResource', 'modResource', 'msOrderProduct.product_id = modResource.id');
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOrderAdditionalProps($orderId) {
        $query = $this->modx->newQuery('msOrder');
        $query->select([
            'msOrder.id',
            'msOrder.num',
            'msOrder.cost',
            'msOrder.cart_cost',
            'msOrderAddress.properties'
        ]);
        $query->where([
            'msOrder.id' => $orderId,
            'msOrder.status' => 2
        ]);
        $query->innerJoin('msOrderAddress', 'msOrderAddress', 'msOrder.address = msOrderAddress.id');
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        return $result;
    }

    public function getUserOrdersSum($userId) {
        $result = 0;
        $orderList = $this->getUserOrdersList($userId);
        foreach ($orderList as $orderItem) {
            $result += $orderItem['cost'];
        }
        return $result;
    }

    private function setBonusLvlUp($userId) {
        $bonusGroups = $this->getBonusGroupList();
        $sum = $this->getUserOrdersSum($userId);
        foreach ($bonusGroups as $group) {
            if ($group['order_sum'] >= $sum) {
                $this->setUserBonusBalanceField($userId, 'bonus_group', $group['id']);
                break;
            }
        }
        return;
    }

    public function setBonusBalance($orderId, $userId) {
        $arOrder = $this->getOrderAdditionalProps($orderId);
        $this->setBonusLvlUp($userId);
        $bonusModifier = $this->getUserBonusModifier($userId);
        $bonusFromOrder = $arOrder['cart_cost'] * $bonusModifier;
        $balanceData = $this->getUserBalanceData($userId);
        $newBalance = $balanceData['value'] + $bonusFromOrder;
        $this->setUserBonusBalanceField($userId, 'value', $newBalance);
        $this->addBonusOperation($userId, $bonusFromOrder, 'write-on');
        return;
    }

    public function decreaseBonusBalance($orderId, $userId) {
        $arOrder = $this->getOrderAdditionalProps($orderId);
        $orderProps = json_decode($arOrder['properties'], true);
        if ($orderProps['extfld_bonuspayed'] = 'Y') {
            $balanceData = $this->getUserBalanceData($userId);
            $newBalance = $balanceData['value'] - $orderProps['extfld_bonusvalue'];
            $newBalance = $newBalance >= 0 ? $newBalance : 0;
            $this->setUserBonusBalanceField($userId, 'value', $newBalance);
            $this->addBonusOperation($userId, $orderProps['extfld_bonusvalue'], 'write-off');
        }
        return;
    }
}