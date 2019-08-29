<?php
class DialBonusRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'dialBonusCode';
    public $languageTopics = ['dialbonus:default'];
    public $objectType = 'dialbonus.code';
}
return 'DialBonusRemoveProcessor';