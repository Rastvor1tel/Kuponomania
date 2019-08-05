<?php
if (empty($_REQUEST['action'])) {
	die('Access denied');
} else $action = $_REQUEST['action'];

define('MODX_API_MODE', true);
if (file_exists(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php')) {
	require dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php'; // на время разработки
} else {
	require dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php'; // на постоянку
}

$modx->getService('error', 'error.modError');
$modx->getRequest();
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');
$modx->error->message = null;
$properties = array();
$properties['json_response'] = 1;
// Switch context
$context = 'web';
if (!empty($_REQUEST['ctx']) && $modx->getCount('modContext', $_REQUEST['ctx'])) {
	$context = $_REQUEST['ctx'];
}
if ($context != 'web') {
	$modx->switchContext($context);
}
define('MODX_ACTION_MODE', true);



$corePath = $modx->getOption('msdo_core_path', null, $modx->getOption('core_path') . 'components/msdo/');
$msdo = $modx->getService('msdo', 'msdo', $corePath . 'model/msdo/');
$modx->lexicon->load('msdo:default', 'msdo:manager');

$response = $msdo->getFrontendOffer();

if (is_array($response)) {
	$response = $modx->toJSON($response);
}
exit($response);
