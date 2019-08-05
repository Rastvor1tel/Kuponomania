<?php
$xpdo_meta_map['msdoBought']= array (
  'package' => 'msdo',
  'version' => '1.1',
  'table' => 'msdo_bought',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'product_id' => NULL,
    'order_id' => NULL,
    'user_id' => NULL,
    'value' => NULL,
    'boughtdon' => NULL,
  ),
  'fieldMeta' => 
  array (
    'product_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
    ),
    'order_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
    ),
    'user_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
    ),
    'value' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'boughtdon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
  ),
);
