<?php
class DialBonusRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'dialBonusBalance';
    public $languageTopics = ['dialbonus:default'];
    public $objectType = 'dialbonus.balance';
}
return 'DialBonusRemoveProcessor';