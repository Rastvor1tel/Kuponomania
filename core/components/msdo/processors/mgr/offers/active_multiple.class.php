<?php
class msdoOfferActiveMultipleProcessor extends modObjectProcessor {
	public $classKey = 'msdoOffer';
	/** {@inheritDoc} */
	public function process() {
		$ids = $this->getProperty('ids',null);
		if (empty($ids)) {
			return $this->success();
		}
		$value = $this->getProperty('value',0);
		$ids = is_array($ids) ? $ids : explode(',',$ids);
		foreach ($ids as $id) {
			if (!empty($id)) {
				$this->modx->runProcessor('active',
					array(
						'id' => $id,
						'value' => $value,
					),
					array('processors_path' => dirname(__FILE__).'/')
				);
			}
		}
		return $this->success();
	}
}
return 'msdoOfferActiveMultipleProcessor';