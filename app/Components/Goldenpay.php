<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 09.01.2018
 * Time: 15:25
 */

namespace App\Components;


class Goldenpay
{
    private $urlGetPaymentKey    = "https://rest.goldenpay.az/web/service/merchant/getPaymentKey";
    private $urlGetPaymentResult = "https://rest.goldenpay.az/web/service/merchant/getPaymentResult";
    private $urlRedirect         = "https://rest.goldenpay.az/web/paypage?payment_key=";

    private $merchantName = "applemarket";
    private $authKey      = "f921bdcf89b141a829ed509cba65b8ff";

    public function getPaymentKeyJSONRequest($amount, $lang, $cardType, $description) {
        $params = array(
            'merchantName' => $this->merchantName,
            'cardType' => $cardType,
            'amount' => $amount,
            'description' => $description
        );

        $params['hashCode'] = $this->getHashcCode($params);
        $params['lang'] = $lang;

        $request = json_encode($params);

        $json = json_decode($this->getJsonContent($this->urlGetPaymentKey, $request));

        $json->urlRedirect =($this->urlRedirect).($json->paymentKey);

        return $json;
    }


    public function getPaymentResult($payment_key) {
        $params = array(
            'payment_key' => $payment_key
        );
        $params['hash_code'] = $this->getHashcCode($params);

        $options = array(
            'http' => array(
                'header'  => "Accept: application/json\r\n",
                'method'  => 'GET'
            )
        );

        $context = stream_context_create($options);
        $json = file_get_contents($this->urlGetPaymentResult."?".
            http_build_query($params), false, $context);

        return json_decode($json);
    }


    private function getHashcCode($params) {
        return md5($this->authKey.implode($params));
    }

    private function getParamsClone() {
        return array_merge(array(), $params);
    }


    private function getJsonContent($url, $content) {
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\nAccept: application/json\r\n",
                'method'  => 'POST',
                'content' => $content
            ),
        );
        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);
    }
}
