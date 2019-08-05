<?php
class msdo
{
	/* @var modX $modx */
	public $modx;
	public $namespace = 'msdo';
	public $cache = null;
	public $config = array();
	public $initialized = array();
	public $active = false;
	public $ms2;


	/* @var pdoTools $pdoTools */
	public $pdoTools;


	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx, array $config = array())
	{
		$this->modx =& $modx;

		$this->namespace = $this->getOption('namespace', $config, 'msdo');
		$corePath = $this->modx->getOption('msdo_core_path', $config, $this->modx->getOption('core_path') . 'components/msdo/');
		$assetsUrl = $this->modx->getOption('msdo_assets_url', $config, $this->modx->getOption('assets_url') . 'components/msdo/');
		$connectorUrl = $assetsUrl . 'connector.php';

		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',
			'imagesUrl' => $assetsUrl . 'images/',
			'connectorUrl' => $connectorUrl,

			'corePath' => $corePath,
			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			'templatesPath' => $corePath . 'elements/templates/',
			'chunkSuffix' => '.chunk.tpl',
			'snippetsPath' => $corePath . 'elements/snippets/',
			'processorsPath' => $corePath . 'processors/',

			'json_response' => true,
			'webconnector' => $assetsUrl . 'action.php',
			//'frontend_css' => $this->modx->getOption('msdo_frontend_css', null, '[[+assetsUrl]]css/web/default.css'),
			//'frontend_js' => $this->modx->getOption('msdo_frontend_js', null, '[[+assetsUrl]]js/web/default.js'),

			'cache_key' => $this->namespace . '/',




		), $config);

		$this->modx->addPackage('msdo', $this->config['modelPath']);
		$this->modx->lexicon->load('msdo:default');
		$this->active = $this->modx->getOption('msdo_active', $config, false);

		if (!$this->ms2 = $modx->getService('miniShop2')) {
			$this->modx->log(modX::LOG_LEVEL_ERROR, 'msDigitalOffers requires installed miniShop2.');
			return false;
		}
	}

	public function getOption($key, $config = array(), $default = null){
		$option = $default;
		if (!empty($key) && is_string($key)) {
			if ($config != null && array_key_exists($key, $config)) {
				$option = $config[$key];
			} elseif (array_key_exists($key, $this->config)) {
				$option = $this->config[$key];
			} elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
				$option = $this->modx->getOption("{$this->namespace}.{$key}");
			}
		}
		return $option;
	}

	// манагер
	public function onDocFormPrerender($sp){
		if ($this->modx->getOption('mode', $sp) !== 'upd') {
			return;
		}
		if (!$this->modx->getObject('msProduct', $sp['id'])) {
			return;
		}
		// lexicon
		$this->modx->controller->addLexiconTopic('msdo:default,msdo:manager');
		// css
		$this->modx->regClientCSS($this->getOption('cssUrl') . 'mgr/main.css');
		// js
		$this->modx->regClientStartupScript($this->getOption('jsUrl') . 'mgr/msdo.js');
		$this->modx->regClientStartupScript($this->getOption('jsUrl') . 'mgr/misc/utils.js');
		$this->modx->regClientStartupScript($this->getOption('jsUrl') . 'mgr/misc/msdo.combo.js');
		//
		$data_js = preg_replace(array('/^\n/', '/\t{6}/'), '', '
			msdo.config.connector_url = "' . $this->config['connectorUrl'] . '";
			msdo.product_id = ' . $sp['id'] . ';
		');
		$this->modx->regClientStartupScript("<script type=\"text/javascript\">\n" . $data_js . "\n</script>", true);
		// inject
		$this->modx->regClientStartupScript($this->getOption('jsUrl') . 'mgr/inject/offers.grid.js');
		$this->modx->regClientStartupScript($this->getOption('jsUrl') . 'mgr/inject/bought.grid.js');
		$this->modx->regClientStartupScript($this->getOption('jsUrl') . 'mgr/inject/tab.js');
	}

	// извлекает код товара и создает msdoBought с этим кодом
	public function buyProductCodes($product_id, $count, $order_id, $user_id){

		$query = $this->modx->newQuery('msdoOffer');
		$query->where(array(
			'product_id' => $product_id,
			'active' => 1
		));
		$query->limit($count);
		$_codes = $this->modx->getCollection('msdoOffer', $query);


		$codes = array();
		foreach($_codes as $code){
			$value = $code->value;
			if($code->remove()){
				$bought = $this->modx->newObject('msdoBought',array(
				   'product_id' => $product_id,
				   'order_id' => $order_id,
				   'user_id' => $user_id,
				   'value' => $value,
				   'boughtdon' => date("Y-m-d H:i:s")
				));

				if($bought->save()){
					$codes[] = $value;
				}
			}
		}

		//$this->modx->log(1, print_r($codes));
		return $codes;
	}

}