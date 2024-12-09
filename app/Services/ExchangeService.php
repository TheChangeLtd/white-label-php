<?php

namespace App\Services;

use App\Utils\Http;

class ExchangeService
{
    private $apiKey;
    private $baseUrl;

    public function __construct($apiKey, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    public function getPair($send, $receive, $sendNetwork, $receiveNetwork)
    {
        $url = $this->baseUrl . "/exchange/pair";
        $queryParams = [
            'send' => $send,
            'receive' => $receive,
            'sendNetwork' => $sendNetwork,
            'receiveNetwork' => $receiveNetwork
        ];
        $url .= '?' . http_build_query($queryParams);
        $headers = [
            "X-API-KEY: {$this->apiKey}",
            "Content-Type: application/json"
        ];
        return Http::makeRequest($url, 'GET', null, $headers);
    }
    
    public function getRate($send, $receive, $amount, $sendNetwork, $receiveNetwork)
    {
        $url = $this->baseUrl . "/exchange/rate";
        $queryParams = [
            'send' => $send,
            'receive' => $receive,
            'amount' => $amount,
            'sendNetwork' => $sendNetwork,
            'receiveNetwork' => $receiveNetwork
        ];
        $url .= '?' . http_build_query($queryParams);
        $headers = [
            "X-API-KEY: {$this->apiKey}",
            "Content-Type: application/json"
        ];
        return Http::makeRequest($url, 'GET', null, $headers);
    }
}
