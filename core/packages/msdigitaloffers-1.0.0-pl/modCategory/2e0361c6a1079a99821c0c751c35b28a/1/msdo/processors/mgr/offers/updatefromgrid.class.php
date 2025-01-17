<?php
require_once (dirname(__FILE__).'/update.class.php');
class msdoOfferFromGridProcessor extends msdoOfferUpdateProcessor {
	/** {@inheritDoc} */
	public static function getInstance(modX &$modx,$className,$properties = array()) {
		/** @var modProcessor $processor */
		$processor = new msdoOfferFromGridProcessor($modx,$properties);
		return $processor;
	}
	/** {@inheritDoc} */
	public function initialize() {
		$data = $this->getProperty('data');
		if (empty($data)) {
			return $this->modx->lexicon('invalid_data');
		}
		$data = $this->modx->fromJSON($data);
		if (empty($data)) {
			return $this->modx->lexicon('invalid_data');
		}

		if (!empty($data['price'])) {
			$price = $data['price'];
			$price = preg_replace(array('/[^0-9%\-,\.]/','/,/'), array('', '.'), $price);
			if (strpos($price, '%') !== false) {
				$data['price'] = str_replace('%', '', $price) . '%';
			}
			if (empty($price)) {$data['price'] = '0';}
		}
		else {$data['price'] = '0';}

		$this->setProperties($data);
		$this->unsetProperty('data');
		return parent::initialize();
	}
}
return 'msdoOfferFromGridProcessor';