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

    public function outputArray(array $array, $count = false) {
        foreach ($array as &$item) {
            $user = $this->modx->getObject('modUser', array('id' => $item['user_id']));
            if ($user) $item['user_id'] = $user->get('username') . '(' . $item['user_id'] . ')';
            $group = $this->modx->getObject('dialBonusGroup', array('id' => $item['bonus_group']));
            if ($group) $item['bonus_group'] = $group->get('name') . '(' . $item['bonus_group'] . ')';
        }
        if ($count === false) {
            $count = count($array);
        }
        $output = json_encode(array(
            'success' => true,
            'total' => $count,
            'results' => $array
        ));
        if ($output === false) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Processor failed creating output array due to JSON error ' . json_last_error());
            return json_encode(array('success' => false));
        }
        return $output;
    }
}
return 'DialBonusGetListProcessor';