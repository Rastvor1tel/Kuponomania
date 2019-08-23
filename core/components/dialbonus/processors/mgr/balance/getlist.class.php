<?php
class DialBonusGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'dialBonusBalance';
    public $languageTopics = ['dialbonus:default'];
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'dialbonus.balance';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'user_id:LIKE' => '%'.$query.'%',
                'OR:value:LIKE' => '%'.$query.'%',
            ));
        }
        return $c;
    }
}
return 'DialBonusGetListProcessor';