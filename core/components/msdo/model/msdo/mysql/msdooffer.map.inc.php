<?php
$xpdo_meta_map['msdoOffer']= array (
  'package' => 'msdo',
  'version' => '1.1',
  'table' => 'msdo_offers',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'product_id' => NULL,
    'value' => NULL,
    'active' => 1,
    'createdon' => NULL,
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
    'value' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'integer',
      'null' => true,
      'default' => 1,
    ),
    'createdon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
  ),
);
