<?php
class msdoOfferRemoveProcessor extends modObjectRemoveProcessor  {
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
}
return 'msdoOfferRemoveProcessor';