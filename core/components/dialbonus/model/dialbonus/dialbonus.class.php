<?php

class DialBonus {
	public $modx;
	public $config = [];
	
	function __construct(modX &$modx, array $config = []) {
		$this->modx =& $modx;
		
		$basePath = $this->modx->getOption('bonus.core_path', $config, $this->modx->getOption('core_path') . 'components/dialbonus/');
		$assetsUrl = $this->modx->getOption('bonus.assets_url', $config, $this->modx->getOption('assets_url') . 'components/dialbonus/');
		$this->config = array_merge([
			'basePath'       => $basePath,
			'corePath'       => $basePath,
			'modelPath'      => $basePath . 'model/',
			'processorsPath' => $basePath . 'processors/',
			'chunksPath'     => $basePath . 'elements/chunks/',
			'jsUrl'          => $assetsUrl . 'js/',
			'cssUrl'         => $assetsUrl . 'css/',
			'assetsUrl'      => $assetsUrl,
			'connectorUrl'   => $assetsUrl . 'connector.php',
		], $config);
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
			$field => (string)$value
		]);
		$query->where([
			'user_id' => $userId
		]);
		$query->prepare();
		$query->stmt->execute();
	}
	
	public function addBonusUser($userId) {
		$query = $this->modx->newQuery('dialBonusBalance');
		$query->select(['dialBonusBalance.*']);
		$query->where([
			'dialBonusBalance.user_id' => $userId
		]);
		$query->prepare();
		$query->stmt->execute();
		$result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
		if (!$result) {
			$query = $this->modx->newObject('dialBonusBalance', [
				'user_id'     => $userId,
				'value'       => 0,
				'bonus_group' => 1
			]);
			$query->save();
		}
	}
	
	private function addBonusOperation($userId, $bonusValue, $type) {
		$query = $this->modx->newObject('dialBonusOperation', [
			'user_id' => $userId,
			'date'    => date('Y-m-d H:i:s'),
			'value'   => $bonusValue,
			'type'    => $type
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
			'msOrder.status'  => 2
		]);
		$query->innerJoin('msOrderProduct', 'msOrderProduct', 'msOrder.id = msOrderProduct.order_id');
		$query->innerJoin('modResource', 'modResource', 'msOrderProduct.product_id = modResource.id');
		$query->prepare();
		$query->stmt->execute();
		$result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function getOrderAdditionalProps($orderId) {
		$result = [];
		$query = $this->modx->newQuery('msOrder');
		$query->select([
			'msOrder.id',
			'msOrder.num',
			'msOrder.cost',
			'msOrder.cart_cost',
			'msOrderAddress.properties'
		]);
		$query->where([
			'msOrder.id'     => $orderId,
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
	
	public function getBonusCode($name) {
		$query = $this->modx->newQuery('dialBonusCode');
		$query->select([
			'dialBonusCode.*',
		]);
		$query->where([
			'dialBonusCode.name' => $name
		]);
		$query->prepare();
		$query->stmt->execute();
		$result = $query->stmt->fetchAll(PDO::FETCH_ASSOC)[0];
		return $result;
	}
	
	public function updateBonusCode($name, $field, $value) {
		$query = $this->modx->newQuery('dialBonusCode');
		$query->command('update');
		$query->set([
			'dialBonusCode.' . $field => $value
		]);
		$query->where([
			'name' => $name
		]);
		$query->prepare();
		$query->stmt->execute();
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
	
	public function setBonusBalanceAfterOrder($orderId, $userId) {
		$arOrder = $this->getOrderAdditionalProps($orderId);
		$this->setBonusLvlUp($userId);
		$bonusModifier = $this->getUserBonusModifier($userId);
		$bonusFromOrder = $arOrder['cart_cost'] * $bonusModifier;
		$this->increaseBonusBalance($bonusFromOrder, $userId);
	}
	
	public function addBonusCode2User($userId, $codeId) {
		$arUser = $this->getUserBalanceData($userId);
		$codeString = $arUser['bonus_code'] ? $arUser['bonus_code'] . ',' . $codeId : $codeId;
		$this->setUserBonusBalanceField($userId, 'bonus_code', $codeString);
	}
	
	public function increaseBonusBalance($bonusValue, $userId) {
		if ($bonusValue > 0) {
			$balanceData = $this->getUserBalanceData($userId);
			$newBalance = $balanceData['value'] + $bonusValue;
			$this->setUserBonusBalanceField($userId, 'value', $newBalance);
			$this->addBonusOperation($userId, $bonusValue, 'write-on');
		}
	}
	
	public function decreaseBonusBalance($orderId, $userId) {
		$arOrder = $this->getOrderAdditionalProps($orderId);
		$orderProps = json_decode($arOrder['properties'], true);
		if ($orderProps['extfld_bonuspayed'] = 'Y') {
			$balanceData = $this->getUserBalanceData($userId);
			if ($orderProps['extfld_bonusvalue'] > 0) {
				$newBalance = $balanceData['value'] - $orderProps['extfld_bonusvalue'];
				$newBalance = $newBalance >= 0 ? $newBalance : 0;
				$this->setUserBonusBalanceField($userId, 'value', $newBalance);
				$this->addBonusOperation($userId, $orderProps['extfld_bonusvalue'], 'write-off');
			}
		}
	}
	
	public function getBuyedCount($productId) {
		$query = $this->modx->newQuery('msOrderProduct');
		$query->select([
			'msOrderProduct.*',
		]);
		$query->where([
			'msOrderProduct.product_id' => $productId
		]);
		$query->prepare();
		$query->stmt->execute();
		$result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function getProductCoupons($productId) {
		$sql = "SELECT * FROM `modx_msdo_offers` AS b WHERE b.product_id = $productId";
		$statement = $this->modx->query($sql);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function checkProductCoupons($productId) {
		$result = $this->getProductCoupons($productId);
		if ($result) return true;
		else return false;
	}
	
	public function getUserCouponsList($userId, $mode='') {
		$sql = "SELECT b.id as b_id, b.used, b.user_id, b.product_id, b.value as code, p.id as prod_id, p.price, p.image , r.id as r_id, r.pagetitle, r.introtext, r.unpub_date FROM `modx_msdo_bought` AS b INNER JOIN `modx_ms2_products` as p ON b.product_id= p.id INNER JOIN `modx_site_content` as r ON b.product_id= r.id WHERE b.user_id = " . $userId;
		if ($mode == 'expired') $sql .= " AND r.unpub_date > CURTIME()";
		if ($mode == 'used') $sql .= " AND b.used=1";
		else $sql .= " AND b.used IS NULL";
		$sql .= ' ORDER BY b.`boughtdon` DESC';
		$statement = $this->modx->query($sql);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function setUserCouponUsed($boughtId) {
		$sql = "UPDATE `modx_msdo_bought` SET used = 1 WHERE id = " . $boughtId;
		$query = $this->modx->prepare($sql);
		$query->execute();
	}
	
}