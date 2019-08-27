<?php return array (
  'a39339ebc7349e9bafcbdffdb5358988' => 
  array (
    'criteria' => 
    array (
      'name' => 'msdo',
    ),
    'object' => 
    array (
      'name' => 'msdo',
      'path' => '{core_path}components/msdo/',
      'assets_path' => '',
    ),
  ),
  '2dc5d7cd868d8e4df92ec46277c7468c' => 
  array (
    'criteria' => 
    array (
      'key' => 'msdo_active',
    ),
    'object' => 
    array (
      'key' => 'msdo_active',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'msdo',
      'area' => 'msdo_main',
      'editedon' => NULL,
    ),
  ),
  '253bf4c4a872010b05970a0369b77c72' => 
  array (
    'criteria' => 
    array (
      'category' => 'msDigitalOffers',
    ),
    'object' => 
    array (
      'id' => 12,
      'parent' => 0,
      'category' => 'msDigitalOffers',
      'rank' => 0,
    ),
  ),
  '82328247f83d5645dde33730678d030a' => 
  array (
    'criteria' => 
    array (
      'name' => 'msdoEmail',
    ),
    'object' => 
    array (
      'id' => 62,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'msdoEmail',
      'description' => '',
      'editor_type' => 0,
      'category' => 12,
      'cache_type' => 0,
      'snippet' => '$miniShop2 = $modx->getService(\'minishop2\');
$msdo = $modx->getService(\'msdo\', \'msdo\', $modx->getOption(\'msdo_core_path\', null, $modx->getOption(\'core_path\') . \'components/msdo/\') . \'model/msdo/\', $scriptProperties);
if (!($msdo instanceof msdo)) return \'\';
$output = \'\';
$codes = array();
$products = $modx->getCollection(\'msOrderProduct\', array(\'order_id\' => $id, \'options:!=\' => \'[]\'));
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
	$output = implode("\\n", $codes);
}
return $output;',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/msdo/elements/snippets/snippet.msdoEmail.php',
      'content' => '$miniShop2 = $modx->getService(\'minishop2\');
$msdo = $modx->getService(\'msdo\', \'msdo\', $modx->getOption(\'msdo_core_path\', null, $modx->getOption(\'core_path\') . \'components/msdo/\') . \'model/msdo/\', $scriptProperties);
if (!($msdo instanceof msdo)) return \'\';
$output = \'\';
$codes = array();
$products = $modx->getCollection(\'msOrderProduct\', array(\'order_id\' => $id, \'options:!=\' => \'[]\'));
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
	$output = implode("\\n", $codes);
}
return $output;',
    ),
  ),
  'e3668c3ff4b6e198f2e1cfa4188c119d' => 
  array (
    'criteria' => 
    array (
      'name' => 'msDigitalOffers',
    ),
    'object' => 
    array (
      'id' => 14,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'msDigitalOffers',
      'description' => '',
      'editor_type' => 0,
      'category' => 12,
      'cache_type' => 0,
      'plugincode' => '$msdo = $modx->getService(\'msdo\', \'msdo\', $modx->getOption(\'msdo_core_path\', null, $modx->getOption(\'core_path\') . \'components/msdo/\') . \'model/msdo/\', $scriptProperties);
if (!($msdo instanceof msdo)) return \'\';

$eventName = $modx->event->name;
if (method_exists($msdo, $eventName) && $msdo->active) {
	$msdo->$eventName($scriptProperties, $product);
}

switch($modx->event->name){
    case \'msOnChangeOrderStatus\':
		if($status == 2){
			$products = $order->getMany(\'Products\');
			foreach ($products as $product){
				$product_id  = $product->get(\'product_id\');
				$values = $msdo->buyProductCodes($product_id, $product->get(\'count\'),  $order->get(\'id\'), $order->get(\'user_id\'));
				if(empty($values)) continue;
				$product->set(\'options\', $modx->toJson($values));
				$product->save();
			}
		}
	break;
}',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/msdo/elements/plugins/plugin.msDigitalOffers.php',
      'content' => '$msdo = $modx->getService(\'msdo\', \'msdo\', $modx->getOption(\'msdo_core_path\', null, $modx->getOption(\'core_path\') . \'components/msdo/\') . \'model/msdo/\', $scriptProperties);
if (!($msdo instanceof msdo)) return \'\';

$eventName = $modx->event->name;
if (method_exists($msdo, $eventName) && $msdo->active) {
	$msdo->$eventName($scriptProperties, $product);
}

switch($modx->event->name){
    case \'msOnChangeOrderStatus\':
		if($status == 2){
			$products = $order->getMany(\'Products\');
			foreach ($products as $product){
				$product_id  = $product->get(\'product_id\');
				$values = $msdo->buyProductCodes($product_id, $product->get(\'count\'),  $order->get(\'id\'), $order->get(\'user_id\'));
				if(empty($values)) continue;
				$product->set(\'options\', $modx->toJson($values));
				$product->save();
			}
		}
	break;
}',
    ),
  ),
  '603ab482c407db93604885072fbd5fb3' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 14,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 14,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '03e9105b3deafc47ce76e562e3e7d6f2' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 14,
      'event' => 'msOnChangeOrderStatus',
    ),
    'object' => 
    array (
      'pluginid' => 14,
      'event' => 'msOnChangeOrderStatus',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);