<?php

namespace App\Services;

use App\Utils\Http;

class CurrenciesService
{
    private $apiKey;
    private $baseUrl;

    public function __construct($apiKey, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }
    
    public function GetCurrencies()
    {
        $url = $this->baseUrl . "/currencies";
        $headers = [
            "X-API-KEY: {$this->apiKey}"
        ];
        $urlWithParams = $url;
        return Http::makeRequest($urlWithParams, 'GET', '', $headers);
    }
}
