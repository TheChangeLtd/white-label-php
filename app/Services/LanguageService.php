<?php

namespace App\Services;

class LanguageService
{
    private array $supportedLanguages;
    private string $defaultLanguage;

    public function __construct(array $supportedLanguages, string $defaultLanguage)
    {
        $this->supportedLanguages = $supportedLanguages;
        $this->defaultLanguage = $defaultLanguage;
    }

    public function detectLanguage(): string
    {
        $languageCodes = array_keys($this->supportedLanguages);
        $languagePattern = implode('|', $languageCodes);

        if (preg_match("#^/($languagePattern)/#", $_SERVER['REQUEST_URI'], $matches)) {
            $this->setLanguageCookie($matches[1]);
            return $matches[1];
        }

        if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $languageCodes)) {
            return $_COOKIE['lang'];
        }

        if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $acceptedLanguages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
            foreach ($acceptedLanguages as $acceptedLanguage) {
                $lang = substr($acceptedLanguage, 0, 2);
                if (in_array($lang, $languageCodes)) {
                    $this->setLanguageCookie($lang);
                    return $lang;
                }
            }
        }

        $this->setLanguageCookie($this->defaultLanguage);
        return $this->defaultLanguage;
    }

    private function setLanguageCookie(string $lang): void
    {
        setcookie('lang', $lang, time() + (86400 * 30), '/');
    }
}



