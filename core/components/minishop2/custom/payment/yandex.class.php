<?php
if (!class_exists('msPaymentInterface')) {
	require_once dirname(dirname(dirname(__FILE__))) . '/model/minishop2/mspaymenthandler.class.php';
}

require $_SERVER['DOCUMENT_ROOT'] . '/assets/lib/YandexCheckout/autoload.php';

use YandexCheckout\Client;
use YandexCheckout\Model\Notification\NotificationSucceeded;
use YandexCheckout\Model\Notification\NotificationWaitingForCapture;
use YandexCheckout\Model\NotificationEventType;

class Yandex extends msPaymentHandler implements msPaymentInterface {
	/**
	 * Yandex constructor.
	 *
	 * @param xPDOObject $object
	 * @param array $config
	 */
	function __construct(xPDOObject $object, $config = []) {
		parent::__construct($object, $config);
		
		$siteUrl = $this->modx->getOption('site_url');
		$assetsUrl = $this->modx->getOption('assets_url') . 'components/minishop2/';
		$paymentUrl = $siteUrl . substr($assetsUrl, 1) . 'payment/yandex.php';
		
		$this->config = array_merge([
			'paymentUrl'    => $paymentUrl,
			'apiUrl'        => $this->modx->getOption('ms2_yandex_api_url', NULL, 'https://payment.yandex.net/api/v3/payments'),
			'apiKey'        => $this->modx->getOption('ms2_yandex_apikey', NULL, ''),
			'shopId'        => $this->modx->getOption('ms2_yandex_shopid', NULL, ''),
			/*'apiKey'        => 'test_DSHDYsQ2aqLdGUr8uVfbgE4IUovd4noGoAD1JAyDeI8',
			'shopId'        => '626783',*/
			'returnUrl'     => $this->modx->getOption('ms2_yandex_return_url', NULL, $siteUrl),
			'json_response' => false,
		], $config);
	}
	
	public function createPayObject($orderId, $orderSumm, $orderHash, $items = []) {
		$client = new Client();
		$client->setAuth($this->config['shopId'], $this->config['apiKey']);
		$params = [
			'amount'       => [
				'value'    => $orderSumm,
				'currency' => 'RUB',
			],
			'description'  => '',
			'confirmation' => [
				'type'       => 'redirect',
				'return_url' => $this->config['returnUrl'],
			],
			'receipt'      => [
				'customer' => $this->getCustomerData($orderId),
				'items'    => $items,
			],
			'capture'      => true,
			'metadata'     => [
				'orderId'   => $orderId,
				'orderHash' => $orderHash,
			]
		];
		$payment = $client->createPayment($params, uniqid('', true));
		return $payment;
	}
	
	public function createPayment($orderId, $paymentId, $orderSum, $items) {
		$client = new Client();
		$client->setAuth($this->config['shopId'], $this->config['apiKey']);
		$receiptParams = [
			'customer'    => $this->getCustomerData($orderId),
			'payment_id'  => $paymentId,
			'type'        => 'payment',
			'send'        => true,
			'items'       => $items,
			'settlements' => [
				[
					'type'   => 'cashless',
					'amount' => [
						'value'    => $orderSum,
						'currency' => 'RUB',
					]
				]
			],
		];
		$response = $client->createReceipt($receiptParams, uniqid('', true));
		return $response;
	}
	
	public function getCustomerData($orderId) {
		$result = [];
		$query = $this->modx->newQuery('msOrder');
		$query->select([
			'msOrder.id',
			'msOrder.num',
			'msOrder.address',
			'modUserProfile.*'
		]);
		$query->where([
			'msOrder.id'     => $orderId
		]);
		$query->innerJoin('msOrderAddress', 'msOrderAddress', 'msOrder.address = msOrderAddress.id');
		$query->innerJoin('modUserProfile', 'modUserProfile', 'msOrderAddress.user_id = modUserProfile.id');
		$query->prepare();
		$query->stmt->execute();
		$userData = $query->stmt->fetchAll(PDO::FETCH_ASSOC)[0];
		$result = [
			'full_name' => $userData['fullname'],
			'phone'     => preg_replace("/[^0-9]/", '', $userData['phone']),
			'email'     => $userData['email']
		];
		return $result;
	}
	
	public function getOrder($orderId) {
		$result = [];
		$query = $this->modx->newQuery('msOrderProduct');
		$query->select(['msOrderProduct.*']);
		$query->where([
			'msOrderProduct.order_id' => $orderId
		]);
		$query->prepare();
		$query->stmt->execute();
		$dbResult = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
		if ($dbResult) {
			foreach ($dbResult as $dbItem) {
				$result[] = [
					"description"     => $dbItem['name'],
					"quantity"        => number_format($dbItem['count'], 2, '.', ''),
					"amount"          => [
						"value"    => number_format($dbItem['price'], 2, '.', ''),
						"currency" => "RUB"
					],
					"vat_code"        => "4",
					"payment_mode"    => "full_prepayment",
					"payment_subject" => "commodity"
				];
			}
		}
		return $result;
	}
	
	public function getPaymentLink(msOrder $order) {
		$orderId = $order->get('id');
		$items = $this->getOrder($orderId);
		$customer = $this->getCustomerData($orderId);
		$orderSumm = $order->get('cost');
		$orderHash = $this->getOrderHash($order);
		$response = $this->createPayObject($orderId, $orderSumm, $orderHash, $items);
		$link = $response->confirmation->confirmation_url;
		return $link;
	}
	
	public function requestCheck() {
		$source = file_get_contents('php://input');
		$requestBody = json_decode($source, true);
		try {
			$notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED) ? new NotificationSucceeded($requestBody) : new NotificationWaitingForCapture($requestBody);
		} catch (Exception $e) {
			// Обработка ошибок при неверных данных
		}
		$payment = $notification->getObject();
		return $payment;
	}
	
	public function changeStatus(msOrder $order, $status = '') {
		switch ($status) {
			case 'succeeded':
				$this->ms2->changeOrderStatus($order->get('id'), 2); // Set status "paid"
				break;
			case 'canceled':
				$this->ms2->changeOrderStatus($order->get('id'), 4); // Set status "cancelled"
				break;
		}
		return true;
	}
}