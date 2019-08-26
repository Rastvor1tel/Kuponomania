<?php
class DialBonusGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'dialBonusGroup';
    public $languageTopics = ['dialbonus:default'];
    public $defaultSortField = 'order_sum';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'dialbonus.groups';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'order_sum:LIKE' => '%'.$query.'%',
                'OR:discount_value:LIKE' => '%'.$query.'%',
            ));
        }
        return $c;
    }
}
return 'DialBonusGetListProcessor';