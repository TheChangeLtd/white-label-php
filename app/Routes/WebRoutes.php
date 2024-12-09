<?php

namespace App\Routes;

use Bramus\Router\Router;
use App\Renderers\PageRenderer;
use App\Services\TranslationService;
use App\Renderers\MetaTagRenderer;
use App\Renderers\TemplateRenderer;

class WebRoutes
{
    private Router $router;
    private array $config;
    private PageRenderer $pageRenderer;
    private TemplateRenderer $templateRenderer;

    public function __construct(Router $router, array $config, string $lang, TranslationService $translationService)
    {
        $this->router = $router;
        $this->config = $config;

        $metaTagRenderer = new MetaTagRenderer($translationService, $config['supported_languages'][$lang]);
        $this->pageRenderer = new PageRenderer($translationService, $metaTagRenderer, $config, $lang);
        $this->templateRenderer = new TemplateRenderer($this->config,$translationService);
    }

    function register(): void
    {
        $this->router->set404(function () {
            header('HTTP/1.1 404 Not Found');
            $this->pageRenderer->render('404', './pages/error.php');
        });

        $this->router->get('/', fn() => $this->pageRenderer->render('home', './pages/home.php' ));
        $this->router->get('/order', fn() => $this->pageRenderer->render('order', './pages/order/index.php', [
            'templateRenderer' => $this->templateRenderer,
        ]));
        $this->router->get('/order/{id}', fn($id) => $this->pageRenderer->render('order', './pages/order/id.php', [
            'id' => $id,
            'templateRenderer' => $this->templateRenderer,
        ]));
        $this->router->get('/faq', fn() => $this->pageRenderer->render('faq', './pages/faq.php'));
        $this->router->get('/service-policy', fn() => $this->pageRenderer->render('service-policy', './pages/service-policy.php'));
        $this->router->get('/privacy-policy', fn() => $this->pageRenderer->render('privacy-policy', './pages/privacy-policy.php'));
        $this->router->get('/aml-policy', fn() => $this->pageRenderer->render('aml-policy', './pages/aml-policy.php'));
        $this->router->get('/contacts', fn() => $this->pageRenderer->render('contacts', './pages/contacts.php', [
            'contacts' => $this->config['contacts'],
        ]));
    }
}
