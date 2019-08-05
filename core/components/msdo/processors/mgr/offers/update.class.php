<?php

class msdoOfferUpdateProcessor extends modObjectUpdateProcessor {
	public $classKey = 'msdoOffer';
	public $languageTopics = array('msdo:default','msdo:manager');
	public $permission = 'msdosetting_save';
	/** {@inheritDoc} */
	public function initialize() {
		if (!$this->modx->hasPermission($this->permission)) {
			return $this->modx->lexicon('access_denied');
		}
		return parent::initialize();
	}
	/** {@inheritDoc} */
	public function beforeSet() {
		if ($this->modx->getObject('msdoOffer',array(
			'product_id' => $this->getProperty('product_id'),
			'color' => $this->getProperty('color'),
			'size' => $this->getProperty('size'),
			'id:!=' => $this->getProperty('id')

		))) {
			$this->modx->error->addField('name', $this->modx->lexicon('msdo_err_non_name_unique'));
		}

		if ($price = $this->getProperty('price')) {
			$price = preg_replace(array('/[^0-9%\-,\.]/','/,/'), array('', '.'), $price);
			if (strpos($price, '%') !== false) {
				$price = str_replace('%', '', $price) . '%';
			}
			if (empty($price)) {$price = '0';}
			$this->setProperty('price', $price);
		}

		return parent::beforeSet();
	}

	public function afterSave() {
        $this->modx->invokeEvent('msdoOnUpdateOffer', array(
			'offer' => $this->object,
		));
		return parent::afterSave();
    }


}
return 'msdoOfferUpdateProcessor';