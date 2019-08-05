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
    function __construct(xPDOObject $object, $config = array()) {
        parent::__construct($object, $config);

        $siteUrl = $this->modx->getOption('site_url');
        $assetsUrl = $this->modx->getOption('assets_url') . 'components/minishop2/';
        $paymentUrl = $siteUrl . substr($assetsUrl, 1) . 'payment/yandex.php';

        $this->config = array_merge(array(
            'paymentUrl' => $paymentUrl,
            'apiUrl' => $this->modx->getOption('ms2_yandex_api_url', null, 'https://payment.yandex.net/api/v3/payments'),
            'apiKey' => $this->modx->getOption('ms2_yandex_apikey', null, ''),
            'shopId' => $this->modx->getOption('ms2_yandex_shopid', null, ''),
            'returnUrl' => $this->modx->getOption('ms2_yandex_return_url', null, $siteUrl),
            'json_response' => false,
        ), $config);
    }

    public function createPay($orderId, $orderSumm, $items = []) {
        $client = new Client();
        $client->setAuth($this->config['shopId'], $this->config['apiKey']);
        $params = [
            'amount' => [
                'value' => $orderSumm,
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => $this->config['returnUrl'],
            ],
            'items' => $items,
            'capture' => true,
        ];
        $payment = $client->createPayment($orderId, $params);
        return $payment;
    }

    /**
     * Returns a direct link for continue payment process of existing order
     * @param msOrder $order
     * @return string
     */
    public function getPaymentLink(msOrder $order) {
        $orderId = $order->get('id');
        $orderSumm = $order->get('cost');
        $response = $this->createPay($orderId, $orderSumm);
        $link = $response->confirmation->confirmation_url;
        return $link;
    }

    public function requestCheck() {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED) ? new NotificationSucceeded($requestBody) : new NotificationWaitingForCapture($requestBody);
        $payment = $notification->getObject();
        return $payment;
    }
}