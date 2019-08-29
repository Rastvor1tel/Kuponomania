<?php
class DialBonusGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'dialBonusCode';
    public $languageTopics = ['dialbonus:default'];
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'dialbonus.code';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'name:LIKE' => '%'.$query.'%',
                'OR:value:LIKE' => '%'.$query.'%',
            ));
        }
        return $c;
    }
}
return 'DialBonusGetListProcessor';