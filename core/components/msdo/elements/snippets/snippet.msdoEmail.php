<?php
$miniShop2 = $modx->getService('minishop2');
$msdo = $modx->getService('msdo', 'msdo', $modx->getOption('msdo_core_path', null, $modx->getOption('core_path') . 'components/msdo/') . 'model/msdo/', $scriptProperties);
if (!($msdo instanceof msdo)) return '';
$output = '';
$codes = array();
$products = $modx->getCollection('msOrderProduct', array('order_id' => $id, 'options:!=' => '[]'));
if($products){
	foreach($products as $product){
		$product_codes = $modx->fromJSON($product->options);
		if(count($product_codes) > 1){
			foreach($product_codes as $code){
				$codes[] = $code;
			}
		}else{
			$codes[] = $product_codes[0];
		}
	}
	$output = implode("\n", $codes);
}
return $output;