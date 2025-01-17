<?php
$action= $modx->newObject('modAction');
$action->fromArray(array(
    'id' => 1,
    'namespace' => 'dialbonus',
    'parent' => 0,
    'controller' => 'controllers/home',
    'haslayout' => true,
    'lang_topics' => 'dialbonus:default',
    'assets' => '',
),'',true,true);

$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
    'text' => 'dialbonus',
    'parent' => 'components',
    'description' => 'dialbonus.desc',
    'icon' => 'images/icons/plugin.gif',
    'menuindex' => 0,
    'params' => '',
    'handler' => '',
),'',true,true);
$menu->addOne($action);
unset($menus);

return $menu;