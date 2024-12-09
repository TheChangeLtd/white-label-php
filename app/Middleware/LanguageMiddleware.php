<?php

namespace App\Middleware;

class LanguageMiddleware
{
    protected $router;
    protected $supportedLanguages;
    protected $defaultLanguage;
    protected $requestUri;
    protected $currentLang;
    private $cookieLifeTime = 86400 * 30;

    public function __construct($router, array $config, string $currentLang)
    {
        $this->router = $router;
        $this->supportedLanguages = $config['supported_languages'];
        $this->defaultLanguage = $config['lang'];
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this->currentLang = $currentLang;
    }

    public function initialize()
    {
        if ($this->isRootRequest()) {
            $this->handleRootRequest();
        } elseif ($this->isLanguageRoute()) {
            $this->handleLanguageRoute();
        } elseif ($this->isApiRoute()) {
            $this->router->setBasePath('');
        } else {
            $this->router->setBasePath('');
        }
    }

    protected function isRootRequest()
    {
        return $this->requestUri === '/';
    }

    protected function isLanguageRoute()
    {
        $languageCodes = array_keys($this->supportedLanguages);
        return preg_match('#^/(' . implode('|', $languageCodes) . ')(/|$)#', $this->requestUri, $matches);
    }

    protected function isApiRoute()
    {
        return preg_match('#^/api/#', $this->requestUri);
    }

    protected function handleRootRequest()
    {
        if ($this->currentLang === $this->defaultLanguage) {
            $this->router->setBasePath('');
        } else {
            setcookie('lang', $this->defaultLanguage, time() + ($this->cookieLifeTime), '/');
            header("Location: /{$this->defaultLanguage}");
            exit;
        }
    }

    protected function handleLanguageRoute()
    {
        $languageCodes = array_keys($this->supportedLanguages);
        preg_match('#^/(' . implode('|', $languageCodes) . ')(/|$)#', $this->requestUri, $matches);
        $urlLang = $matches[1];

        if ($urlLang === $this->defaultLanguage) {
            if ($this->requestUri === "/{$this->defaultLanguage}" || $this->requestUri === "/{$this->defaultLanguage}/") {
                header("Location: /", true, 301);
                exit;
            }

            $newPath = substr($this->requestUri, strlen("/{$this->defaultLanguage}"));
            if ($newPath === '') {
                $newPath = '/';
            }
            header("Location: $newPath", true, 301);
            exit;
        }

        $this->router->setBasePath("/$urlLang");

        if (!isset($_COOKIE['lang']) || $_COOKIE['lang'] !== $urlLang) {
            setcookie('lang', $urlLang, time() + ($this->cookieLifeTime), '/');
        }
    }
}
