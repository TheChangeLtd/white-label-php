<?php

namespace App\Renderers;

use App\Services\TranslationService;
use App\Renderers\MetaTagRenderer;

class PageRenderer
{
    private TranslationService $translationService;
    private MetaTagRenderer $metaTagRenderer;
    private array $config;
    private string $lang;

    public function __construct(TranslationService $translationService, MetaTagRenderer $metaTagRenderer, array $config, string $lang)
    {
        $this->translationService = $translationService;
        $this->metaTagRenderer = $metaTagRenderer;
        $this->config = $config;
        $this->lang = $lang;
    }

    public function render(string $translationKey, string $filePath, array $data = []): void
    {
        $this->translationService->loadTranslations('global');
        $this->translationService->loadTranslations($translationKey);

        $context = [
            'config' => $this->config,
            'lang' => $this->lang,
            'translationService' => $this->translationService,
            'metaTagsHtml' => $this->metaTagRenderer->getMetaTags($translationKey),
            'supportedLanguages' => $this->config['supported_languages'],
            'headerMenu' => $this->config['header_menu'],
            'footerMenu' => $this->config['footer_menu'],
        ];

        $data = array_merge($context, $data);
        extract($data);
        include $filePath;
    }
}
