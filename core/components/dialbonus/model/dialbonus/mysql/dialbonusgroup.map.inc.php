<?php
$xpdo_meta_map['dialBonusGroup']= array (
  'package' => 'dialbonus',
  'version' => NULL,
  'table' => 'dialbonus_group',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'order_sum' => 0.0,
    'discount_value' => NULL,
  ),
  'fieldMeta' => 
  array (
    'order_sum' => 
    array (
      'dbtype' => 'decimal',
      'precision' => '12,2',
      'phptype' => 'float',
      'null' => true,
      'default' => 0.0,
    ),
    'discount_value' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
);
