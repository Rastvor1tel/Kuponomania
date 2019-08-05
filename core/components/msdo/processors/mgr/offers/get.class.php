<?php
class msdoOfferGetProcessor extends modObjectGetProcessor {
	public $classKey = 'msdoOffer';
	public $languageTopics = array('msdo:default','msdo:manager');
	public $permission = 'msdosetting_view';

	/** {@inheritDoc} */
	public function initialize() {
		if (!$this->modx->hasPermission($this->permission)) {
			return $this->modx->lexicon('access_denied');
		}
		return parent::initialize();
	}
	/** {@inheritDoc} */
	public function cleanup() {
		$array = $this->object->toArray();
		//$array['option_'] = $array['option'];

		return $this->success('', $array);
	}
}
return 'msdoOfferGetProcessor';