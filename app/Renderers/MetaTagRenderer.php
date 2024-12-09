<?php

namespace App\Renderers;

use App\Services\TranslationService;

class MetaTagRenderer
{
    private TranslationService $translationService;
    private $locale;

    public function __construct(TranslationService $translationService, string $locale)
    {
        $this->translationService = $translationService;
        $this->locale = $locale;
    }

    public function getMetaTags(string $page, array $variables = []): string
    {
        $metaTranslations = $this->translationService->loadArrayTranslations('meta');
        $meta = $metaTranslations['meta'][$page] ?? null;

        if (empty($meta) || !is_array($meta)) {
            $meta = [
                'title' => 'Default Title',
                'description' => 'Default description for the page.',
                'image' => '/images/default.jpg',
                'site_name' => '%name%',
            ];
        }

        $meta['site_name'] = '%name%';

        $replacements = $this->translationService->getReplacements();

        $variables = array_merge($replacements, $variables);

        foreach ($meta as $key => $value) {
            $meta[$key] = $this->replaceVariables($value, $variables);
        }

        return $this->generateMetaTagsHtml($meta);
    }

    private function replaceVariables(string $text, array $variables): string
    {
        return strtr($text, $variables);
    }

    private function generateMetaTagsHtml(array $meta): string
    {
        $canonicalUrl = htmlspecialchars('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');
        $host = htmlspecialchars('https://' . $_SERVER['HTTP_HOST'], ENT_QUOTES, 'UTF-8');

        $mainImageUrl = htmlspecialchars($host . '/assets/images/meta/main-image.png', ENT_QUOTES, 'UTF-8');
        $fallbackImageUrl = htmlspecialchars($host . '/assets/images/meta/fallback-image.png', ENT_QUOTES, 'UTF-8');

        $ogLocale = $this->locale;

        return "
            <link rel=\"canonical\" href=\"$canonicalUrl\">
            <meta property=\"og:title\" content=\"{$meta['title']}\">
            <meta property=\"og:description\" content=\"{$meta['description']}\">
            <meta property=\"og:image\" content=\"$mainImageUrl\">
            <meta property=\"og:image:width\" content=\"1200\">
            <meta property=\"og:image:height\" content=\"630\">
            <meta property=\"og:image\" content=\"$fallbackImageUrl\">
            <meta property=\"og:image:width\" content=\"1000\">
            <meta property=\"og:image:height\" content=\"1000\">
            <meta property=\"og:image:alt\" content=\"{$meta['title']}\">
            <meta property=\"og:url\" content=\"$canonicalUrl\">
            <meta property=\"og:site_name\" content=\"{$meta['site_name']}\">
            <meta property=\"og:type\" content=\"website\">
            <meta property=\"og:locale\" content=\"{$ogLocale}\">
            <meta name=\"twitter:card\" content=\"summary_large_image\">
            <meta name=\"twitter:title\" content=\"{$meta['title']}\">
            <meta name=\"twitter:description\" content=\"{$meta['description']}\">
            <meta name=\"twitter:image\" content=\"$mainImageUrl\">
            <title>{$meta['title']}</title>
        ";
    }
}
