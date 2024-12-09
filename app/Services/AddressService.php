<?php
namespace App\Services;

use App\Utils\Http;

class AddressService
{
    private $apiKey;
    private $baseUrl;

    public function __construct($apiKey, $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }
    
    public function validateAddress($currency, $address, $network)
    {
        $url = $this->baseUrl . "/address/validate";
        $headers = [
            "X-API-KEY: {$this->apiKey}"
        ];
        $params = [
            "currency" => $currency,
            "address" => $address,
            "network" => $network
        ];
        $queryString = http_build_query($params);
        $urlWithParams = $url . "?" . $queryString;
        return Http::makeRequest($urlWithParams, 'GET', '', $headers);
    }
}
