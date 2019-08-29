<?php
class DialBonusUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'dialBonusCode';
    public $languageTopics = ['dialbonus:default'];
    public $objectType = 'dialbonus.code';

    public function beforeSet() {
        $key = $this->getProperty('key');

        $this->setCheckbox('multiple', true);
        $this->setCheckbox('active', true);
        return parent::beforeSet();
    }
}
return 'DialBonusUpdateProcessor';