<?php

require_once dirname(__DIR__) . '/index.class.php';

class DialBonusHomeManagerController extends DialBonusBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }

    public function loadCustomCssJs() {
        $this->addJavascript($this->dialbonus->config['jsUrl'].'mgr/widgets/balance.grid.js');
        $this->addJavascript($this->dialbonus->config['jsUrl'].'mgr/widgets/groups.grid.js');
        $this->addJavascript($this->dialbonus->config['jsUrl'].'mgr/widgets/codes.grid.js');
        $this->addJavascript($this->dialbonus->config['jsUrl'].'mgr/widgets/operations.grid.js');
        $this->addJavascript($this->dialbonus->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->dialbonus->config['jsUrl'] . 'mgr/sections/index.js');
    }

    public function getPageTitle() {
        return $this->modx->lexicon('dialbonus');
    }

    public function getTemplateFile() {
        return $this->dialbonus->config['templatesPath'] . 'home.tpl';
    }
}
