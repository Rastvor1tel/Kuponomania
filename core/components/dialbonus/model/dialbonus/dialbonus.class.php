<?php

class DialBonus {
    public $modx;
    public $config = array();

    function __construct(modX &$modx, array $config = array()) {
        $this->modx =& $modx;

        $basePath = $this->modx->getOption('bonus.core_path', $config, $this->modx->getOption('core_path') . 'components/dialbonus/');
        $assetsUrl = $this->modx->getOption('bonus.assets_url', $config, $this->modx->getOption('assets_url') . 'components/dialbonus/');
        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath . 'model/',
            'processorsPath' => $basePath . 'processors/',
            'chunksPath' => $basePath . 'elements/chunks/',
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl . 'connector.php',
        ), $config);
        $this->modx->addPackage('dialbonus', $this->config['modelPath']);
    }

    public function getChunk($name, $properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->_getTplChunk($name);
            if (empty($chunk)) {
                $chunk = $this->modx->getObject('modChunk', array('name' => $name));
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }

    private function _getTplChunk($name, $postfix = '.chunk.tpl') {
        $chunk = false;
        $f = $this->config['chunksPath'] . strtolower($name) . $postfix;
        if (file_exists($f)) {
            $o = file_get_contents($f);
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name', $name);
            $chunk->setContent($o);
        }
        return $chunk;
    }

    public function checkTable() {
        $query = $this->modx->newQuery('dialBonusBalance');
        $query->select(['dialBonusBalance.*']);
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$result) {
            $manager = $this->modx->getManager();
            $manager->createObjectContainer('dialBonusBalance');
            $manager->createObjectContainer('dialBonusOperation');
            $manager->createObjectContainer('dialBonusGroup');
        }
    }

    public function getUserBalanceData($userId) {
        $query = $this->modx->newQuery('dialBonusBalance');
        $query->select(['dialBonusBalance.*']);
        $query->where([
            'dialBonusBalance.user_id' => $userId
        ]);
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBonusGroupList() {
        $query = $this->modx->newQuery('dialBonusGroup');
        $query->select(['dialBonusGroup.*']);
        $query->sortby('order_sum', 'ASC');
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserOrdersList ($userId) {
        $query = $this->modx->newQuery('msOrder');
        $query->select([
            'msOrder.*',
            'msOrderProduct.product_id',
            'msOrderProduct.count',
            'modResource.unpub_date'
        ]);
        $query->where([
            'msOrder.user_id' => $userId
        ]);
        $query->innerJoin('msOrderProduct', 'msOrderProduct', 'msOrder.id = msOrderProduct.order_id');
        $query->innerJoin('modResource', 'modResource', 'msOrderProduct.product_id = modResource.id');
        $query->prepare();
        $query->stmt->execute();
        $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserOrdersSum ($userId) {
        $result = 0;
        $orderList = $this->getUserOrdersList($userId);
        foreach ($orderList as $orderItem) {
            $result += $orderItem['cost'];
        }
        return $result;
    }

    public function bonusLvlUp ($userId) {
        $bonusGroups = $this->getBonusGroupList();
        $sum = $this->getUserOrdersSum($userId);
        foreach ($bonusGroups as $group) {
            if ($group['order_sum'] >= $sum) {
                $query = $this->modx->newQuery('dialBonusBalance');
                $query->command('update');
                $query->set([
                    'bonus_group' => $group['id']
                ]);
                $query->where([
                    'user_id' => $userId
                ]);
                $query->prepare();
                $query->stmt->execute();
                break;
            }
        }
        return;
    }
}