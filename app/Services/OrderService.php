<?php

namespace App\Services;

use App\Utils\Http;

class OrderService
{
    private $apiKey;
    private $baseUrl;

    public function __construct($apiKey, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    public function placeOrder($send, $receive, $amount, $receiveAddress, $sendNetwork, $receiveNetwork, $payload)
    {
        $url = "{$this->baseUrl}/orders";
        $headers = [
            "X-API-KEY: {$this->apiKey}",
            "Content-Type: application/json"
        ];
        $data = [
            "send" => $send,
            "receive" => $receive,
            "amount" => $amount,
            "receiveAddress" => $receiveAddress,
            "sendNetwork" => $sendNetwork,
            "receiveNetwork" => $receiveNetwork,
            "payload" => $payload
        ];
        return Http::makeRequest($url, 'POST', json_encode($data), $headers);
    }
    
    public function getOrderStatus($orderId)
    {
        $url = "{$this->baseUrl}/orders/{$orderId}";

        $headers = [
            "X-API-KEY: {$this->apiKey}"
        ];

        return Http::makeRequest($url, 'GET', '', $headers);
    }
}
