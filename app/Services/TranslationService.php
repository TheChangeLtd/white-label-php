<?php

namespace App\Services;

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\PhpFileLoader;

class TranslationService
{
    private Translator $translator;
    private string $lang;
    private array $config;

    public function __construct(string $lang, array $config = [])
    {
        $this->lang = $lang;
        $this->config = $config;
        $this->translator = new Translator($lang);
        $this->translator->addLoader('php', new PhpFileLoader());
    }

    public function loadTranslations(string $page): void
    {
        $translationFile = "./translations/{$this->lang}/{$page}.php";
        $this->translator->addResource('php', $translationFile, $this->lang);

        $this->translator->getCatalogue($this->lang);
    }

    public function trans(string $key, array $parameters = []): string
    {
        $parameters = array_merge($this->config, $parameters);

        return $this->translator->trans($key, $parameters);
    }
    
    public function loadArrayTranslations(string $page): array
    {
        $translationFile = "./translations/{$this->lang}/{$page}.php";
        if (file_exists($translationFile)) {
            return include $translationFile;
        }
        return [];
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function localePath(string $path)
    {
        return "/{$this->lang}{$path}";
    }

    public function getReplacements(): array
    {
        return $this->config;
    }
}
