<?php

// For debug
ini_set('display_errors', 1);
ini_set('error_reporting', -1);

// Load MODX config
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
	require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
	require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}

/** @noinspection PhpIncludeInspection */
//require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var msdo $msdo */
$msdo = $modx->getService('msdo', 'msdo', $modx->getOption('msdo_core_path', null, $modx->getOption('core_path') . 'components/msdo/') . 'model/msdo/');
$modx->lexicon->load('msdo:default');


$data = $modx->fromJson($_REQUEST['data']);


if($_REQUEST['action'] == 'mgr/gallery/updatefromgrid'){
    $data = $modx->fromJSON($_REQUEST['data']);
    if(!$data['color']) return false;
    if(!$data['id']) $_REQUEST['action'] = 'mgr/gallery/createfromgrid';
} 



// handle request
$corePath = $modx->getOption('msdo_core_path', null, $modx->getOption('core_path') . 'components/msdo/');
$path = $modx->getOption('processorsPath', $msdo->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));