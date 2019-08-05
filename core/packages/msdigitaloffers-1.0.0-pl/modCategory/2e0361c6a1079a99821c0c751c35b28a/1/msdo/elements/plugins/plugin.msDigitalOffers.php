<?php
$msdo = $modx->getService('msdo', 'msdo', $modx->getOption('msdo_core_path', null, $modx->getOption('core_path') . 'components/msdo/') . 'model/msdo/', $scriptProperties);
if (!($msdo instanceof msdo)) return '';

$eventName = $modx->event->name;
if (method_exists($msdo, $eventName) && $msdo->active) {
	$msdo->$eventName($scriptProperties, $product);
}

switch($modx->event->name){
    case 'msOnChangeOrderStatus':
		if($status == 2){
			$products = $order->getMany('Products');
			foreach ($products as $product){
				$product_id  = $product->get('product_id');
				$values = $msdo->buyProductCodes($product_id, $product->get('count'),  $order->get('id'), $order->get('user_id'));
				if(empty($values)) continue;
				$product->set('options', $modx->toJson($values));
				$product->save();
			}
		}
	break;
}



