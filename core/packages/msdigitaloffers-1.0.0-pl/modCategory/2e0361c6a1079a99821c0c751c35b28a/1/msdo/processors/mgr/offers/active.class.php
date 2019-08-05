<?php

class msdoOfferActiveProcessor extends modObjectProcessor {
	public $classKey = 'msdoOffer';
	/** {@inheritDoc} */
	public function process() {

		$id = $this->getProperty('id',null);
		if (empty($id)) {
			return $this->success();
		}
		$value = $this->getProperty('value',0);

		if ($price = $this->modx->getObject('msdoOffer',$id)) {
			$price->set('active', $value);
			$price->save();
		}

		return $this->success();
	}

}
return 'msdoOfferActiveProcessor';