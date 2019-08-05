<?php

/**
 * Class msdoMainController
 */
abstract class msdoMainController extends modExtraManagerController {
	/** @var msdo $msdo */
	public $msdo;
	public $miniShop2;

	/**
	 * @return void
	 */
	public function initialize() {
		if (!include_once MODX_CORE_PATH . 'components/minishop2/model/minishop2/minishop2.class.php') {
			throw new Exception('msOptionsPrice requires installed miniShop2.');
		}

		$corePath = $this->modx->getOption('msdo_core_path', null, $this->modx->getOption('core_path') . 'components/msdo/');
		require_once $corePath . 'model/msdo/msdo.class.php';

		$this->msdo = new msdo($this->modx);
		//$this->miniShop2 = new miniShop2($this->modx);

		$this->addCss($this->msdo->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->msdo->config['jsUrl'] . 'mgr/msdo.js');
		$this->addHtml('
		<script type="text/javascript">
			msdo.config = ' . $this->modx->toJSON($this->msdo->config) . ';
			msdo.config.connector_url = "' . $this->msdo->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('msdo:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends msdoMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}