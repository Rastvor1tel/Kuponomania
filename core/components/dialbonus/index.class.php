<?php
require_once dirname(__FILE__) . '/model/dialbonus/dialbonus.class.php';

abstract class DialBonusBaseManagerController extends modExtraManagerController {
    public $dialbonus;

    public function initialize() {
        $this->dialbonus = new DialBonus($this->modx);

        $this->addCss($this->dialbonus->config['cssUrl'] . 'mgr.css');
        $this->addJavascript($this->dialbonus->config['jsUrl'] . 'mgr/11dialbonus.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            DialBonus.config = ' . $this->modx->toJSON($this->dialbonus->config) . ';
        });
        </script>');
        return parent::initialize();
    }

    public function getLanguageTopics() {
        return array('dialbonus:default');
    }

    public function checkPermissions() {
        return true;
    }
}

class IndexManagerController extends DialBonusBaseManagerController {
    public static function getDefaultController() {
        return 'home';
    }
}