<?php

class msdoOfferCreateProcessor extends modObjectCreateProcessor {


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
			'value' => $this->getProperty('value')
		))) {
			return $this->modx->lexicon('msdo_err_non_unique');
		}

		$this->setDefaultProperties(array(
            'createdon' => date("Y-m-d H:i:s")
         ));

		return !$this->hasErrors();
	}
	/** {@inheritDoc} */
	public function beforeSave() {
		$c = $this->modx->newQuery('msdoOffer');
		$c->where(array(
			'product_id' => $this->getProperty('product_id'),
		));

		$this->object->fromArray(array(
			'rank' => $this->modx->getCount('msdoOffer', $c),
			'active' => true
		));

		return parent::beforeSave();
	}


	public function afterSave() {
        $this->modx->invokeEvent('msdoOnCreateOffer', array(
			'offer' => $this->object,
		));
		return parent::afterSave();
    }




}
return 'msdoOfferCreateProcessor';