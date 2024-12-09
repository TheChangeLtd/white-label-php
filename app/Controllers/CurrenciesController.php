<?php

namespace App\Controllers;

class CurrenciesController
{
    protected $currenciesService;

    public function __construct($currenciesService)
    {
        $this->currenciesService = $currenciesService;
    }

    public function fetchAll()
    {
        $currencies = $this->currenciesService->GetCurrencies();
        $httpCode = intval($currencies['httpCode']);
        if ($httpCode !== 200) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['message' => $currencies]);
            exit;
        }
        http_response_code(200);
        echo json_encode($currencies);
    }
}
