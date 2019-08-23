<?php
class DialBonusRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'dialBonusGroup';
    public $languageTopics = ['dialbonus:default'];
    public $objectType = 'dialbonus.balance';
}
return 'DialBonusRemoveProcessor';