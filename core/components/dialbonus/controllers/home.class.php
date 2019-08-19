<?php

class DialBonusHomeManagerController extends DialBonusBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }

    public function getPageTitle() {
        return $this->modx->lexicon('dialbonus');
    }

    public function loadCustomCssJs() {
        $this->addJavascript($this->dialbonus->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->dialbonus->config['jsUrl'] . 'mgr/sections/index.js');
    }

    public function getTemplateFile() {
        return $this->dialbonus->config['templatesPath'] . 'home.tpl';
    }
}
