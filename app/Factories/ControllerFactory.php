<?php

namespace App\Factories;

use App\Services\TranslationService;
use App\Services\ConfigService;
use App\Services\AddressService;
use App\Services\ExchangeService;
use App\Services\OrderService;
use App\Services\CurrenciesService;
use App\Renderers\TemplateRenderer;
use App\Controllers\AddressController;
use App\Controllers\CurrenciesController;
use App\Controllers\OrderController;
use App\Controllers\ExchangeController;

class ControllerFactory
{
    protected $lang;
    protected $config;
    protected $apiKey;
    protected $baseUrl;

    public function __construct($config, $lang)
    {
        $this->config = $config;
        $this->lang = $lang;
        $this->apiKey = ConfigService::get('api_key');
        $this->baseUrl = ConfigService::get('api_base_url');
    }

    public function createAddressController()
    {
        $addressService = new AddressService($this->apiKey, $this->baseUrl);
        $translationService = new TranslationService($this->lang);
        
        return new AddressController($addressService, $translationService);
    }

    public function createCurrenciesController()
    {
        $currenciesService = new CurrenciesService($this->apiKey, $this->baseUrl);
        return new CurrenciesController($currenciesService);
    }

    public function createExchangeController()
    {
        $exchangeService = new ExchangeService($this->apiKey, $this->baseUrl);
        $translationService = new TranslationService($this->lang);

        return new ExchangeController($exchangeService, $translationService);
    }

    public function createOrderController()
    {
        $orderService = new OrderService($this->apiKey, $this->baseUrl);
        $translationService = new TranslationService($this->lang);
        $templateRenderer = new TemplateRenderer($this->config, $translationService);

        return new OrderController($orderService, $translationService, $templateRenderer);
    }
}
