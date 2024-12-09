<?php

namespace App;

use App\Services\TranslationService;
use App\Services\LanguageService;
use Bramus\Router\Router;
use App\Routes\WebRoutes;
use App\Routes\ApiRoutes;
use App\Middleware\LanguageMiddleware;

class App
{
    private Router $router;
    private LanguageService $languageService;
    private TranslationService $translationService;
    private LanguageMiddleware $languageMiddleware;
    private array $config;
    private string $lang;

    public function __construct()
    {
        $this->config = require_once './config.php';

        $this->initializeServices();

        $this->router = new Router();
        $this->initializeMiddleware();
        $this->initializeRoutes();
    }

    private function initializeServices(): void
    {
        $supportedLanguages = $this->config['supported_languages'];
        $defaultLanguage = $this->config['lang'];

        $this->languageService = new LanguageService($supportedLanguages, $defaultLanguage);
        $this->lang = $this->languageService->detectLanguage();

        $replacements = [
            '%name%' => $this->config['name'],
            '%fee%' => $this->config['fee'],
        ];

        $this->translationService = new TranslationService($this->lang, $replacements);
    }

    private function initializeMiddleware(): void
    {
        $languageMiddleware = new LanguageMiddleware($this->router, $this->config, $this->lang);
        $this->router->before('GET|POST', '/.*', function () use ($languageMiddleware) {
            $languageMiddleware->initialize();
        });
    }

    private function initializeRoutes(): void
    {
        $webRoutes = new WebRoutes($this->router, $this->config, $this->lang, $this->translationService);
        $webRoutes->register();

        $apiRoutes = new ApiRoutes($this->router, $this->config, $this->lang, $this->translationService);
        $apiRoutes->register();
    }

    public function run(): void
    {
        $this->router->run();
    }
}
