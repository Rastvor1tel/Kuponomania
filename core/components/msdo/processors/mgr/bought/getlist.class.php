<?php

class msdoBoughtGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'msdoBought';
	//public $primaryKeyField = 'product_id';
	public $defaultSortField = 'id';
	public $defaultSortDirection  = 'asc';
	public $languageTopics = array('msdo:default','msdo:manager');
	public $permission = 'msdosetting_list';
	/** {@inheritDoc} */
	public function initialize() {
		if (!$this->modx->hasPermission($this->permission)) {
			return $this->modx->lexicon('access_denied');
		}
		return parent::initialize();
	}
	/** {@inheritDoc} */
	public function prepareQueryBeforeCount(xPDOQuery $c) {

		$product_id = $this->getProperty('product_id');
		$c->where(array('product_id' => $product_id));
		$c->leftJoin('modUserProfile', 'modUserProfile', 'msdoBought.user_id = modUserProfile.internalKey');
		$c->leftJoin('msOrder', 'msOrder', 'msdoBought.order_id = msOrder.id');
		$c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
		$c->select('modUserProfile.email, msOrder.num');


		//$priceColumns = $this->modx->getSelectColumns('msdoBought', 'msdoBought', '', array(), true);
		//$c->select($priceColumns);

		return $c;
	}
	/** {@inheritDoc} */
	public function getData() {
		$data = array();
		$limit = intval($this->getProperty('limit'));
		$start = intval($this->getProperty('start'));
		/* query for chunks */
		$c = $this->modx->newQuery($this->classKey);
		$c = $this->prepareQueryBeforeCount($c);
		$data['total'] = $this->modx->getCount($this->classKey,$c);
		$c = $this->prepareQueryAfterCount($c);
		$sortClassKey = $this->getSortClassKey();
		$sortKey = $this->modx->getSelectColumns($sortClassKey,$this->getProperty('sortAlias',$sortClassKey),'',array($this->getProperty('sort')));
		if (empty($sortKey)) $sortKey = $this->getProperty('sort');
		$c->sortby($sortKey,$this->getProperty('dir'));
		if ($limit > 0) {
			$c->limit($limit,$start);
		}
		if ($c->prepare() && $c->stmt->execute()) {
			$data['results'] = $c->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	}
	/** {@inheritDoc} */
	public function iterate(array $data) {
		$list = array();
		$list = $this->beforeIteration($list);
		$this->currentIndex = 0;
		/** @var xPDOObject|modAccessibleObject $object */
		if(!empty($data['results']))
		{
			foreach ($data['results'] as $array)
			{
				$list[] = $this->prepareArray($array);
				$this->currentIndex++;
			}
		}
		$list = $this->afterIteration($list);
		return $list;
	}
	/** {@inheritDoc} */
	public function prepareArray(array $data) {
/*		if (empty($data['customer'])) {
			$data['customer'] = $data['customer_username'];
		}
		$data['actions'] = array(
			array(
				'className' => 'cancel',
				'text' => $this->modx->lexicon('msbe_menu_cancel'),
			),
		);*/
		//$data['operation_name'] = '<span style="color:#'.$data['operation_color'].';">'.$data['operation_name'].'</span>';

		return $data;
	}

}

return 'msdoBoughtGetListProcessor';