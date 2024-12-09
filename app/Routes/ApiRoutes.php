<?php

namespace App\Routes;

use Bramus\Router\Router;
use App\Factories\ControllerFactory;
use App\Services\TranslationService;
use App\Utils\QRCode;

class ApiRoutes
{
    private Router $router;
    private $config;
    private ControllerFactory $controllerFactory;

    public function __construct(Router $router, array $config, string $lang, TranslationService $translationService)
    {
        $this->router = $router;
        $this->config = $config;
        $this->controllerFactory = new ControllerFactory($this->config, $lang);
    }

    function register(): void
    {
        $this->router->mount('/api', function () {
            $factory = $this->controllerFactory;

            $this->router->post('/address/validate', fn() => $factory->createAddressController()->validate());
            $this->router->get('/currencies', fn() => $factory->createCurrenciesController()->fetchAll());
            $this->router->get('/exchange/rate', fn() => $factory->createExchangeController()->validateAmount());
            $this->router->get('/exchange/pair', fn() => $factory->createExchangeController()->validatePairSettings());
            $this->router->post('/order', fn() => $factory->createOrderController()->placeOrder());
            $this->router->get('/order/{id}', function ($id) use ($factory) {
                $OrderController = $factory->createOrderController();
                $OrderController->getOrderStatus($id);
            });
        });
    }
}
