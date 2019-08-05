<?php

class msdoCreateOffersProcessor extends modObjectProcessor
{
	public $classKey = 'msdoOffer';

	/** {@inheritDoc} */
	public function process()
	{
		$product_id = $this->getProperty('product_id', 0);
		if (empty($product_id)) {
			return $this->success();
		}
		$value = $this->getProperty('value', 0);
		$values = explode ("\n", $value);

		if(count($values) < 1 || empty($values[0])){
			return $this->success();
		}

		//$this->modx->log(1, print_r($values, 1));

		foreach ($values as $v) {
			if (empty($v)) continue;
			$this->modx->error->reset();
			if (!$response = $this->modx->runProcessor('create', array( 'product_id' => $product_id, 'value' => $v), array('processors_path' => dirname(__FILE__) . '/'))){
				continue;
			}
		}
		return $this->success();
	}
}

return 'msdoCreateOffersProcessor';