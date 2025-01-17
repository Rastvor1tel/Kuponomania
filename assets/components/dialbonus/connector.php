<?php
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('dialbonus.core_path',null,$modx->getOption('core_path').'components/dialbonus/');
require_once $corePath.'model/dialbonus/dialbonus.class.php';
$modx->dialbonus = new DialBonus($modx);

$modx->lexicon->load('dialbonus:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->dialbonus->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));