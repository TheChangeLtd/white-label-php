<?php

namespace App\Renderers;

use App\Enums\TemplatesEnum;
use App\Enums\StatusEnum;
use Exception;

class TemplateRenderer
{
    private $translationService;
    private array $config;

    public function __construct(array $config, $translationService)
    {
        $this->translationService = $translationService;
        $this->config = $config;
    }

    public  function getTemplatePath(string $status): string
    {
        $template = TemplatesEnum::getTemplatePath($status) ?? 'failed.php';
        return "./templates/{$template}";
    }

    public function render(string $templatePath, array $data = []): void
    {
        if (!file_exists($templatePath)) {
            throw new Exception("Template not found: {$templatePath}");
        }
        $context = array_merge($data, [
            'trustpilot' => $this->config['trustpilot'],
            'translationService' => $this->translationService,
        ]);
        extract($context);
        include $templatePath;
    }

    public function renderStepsTemplate($status): void
    {
        $steps = [
            ['key' => 'create_order', 'label' => $this->translationService->trans('create_order')],
            ['key' => 'waiting_for_deposit', 'label' => $this->translationService->trans('waiting_for_deposit')],
            ['key' => 'waiting_for_confirm', 'label' => $this->translationService->trans('waiting_for_confirm')],
            ['key' => 'sending_funds', 'label' => $this->translationService->trans('sending_funds')],
        ];

        $statusMap = [
            StatusEnum::CREATE_ORDER => 0,
            StatusEnum::AWAITING_DEPOSIT => 1,
            StatusEnum::CONFIRMING_DEPOSIT => 2,
            StatusEnum::EXCHANGING => 2,
            StatusEnum::SENDING => 3,
            StatusEnum::COMPLETE => 4,
            StatusEnum::FAILED => null,
            StatusEnum::REFUND => null,
            StatusEnum::ACTION_REQUEST => null,
        ];

        $activeIndex = array_key_exists($status, $statusMap) ? $statusMap[$status] : null;
        $isErrorStatus = in_array($status, [StatusEnum::FAILED, StatusEnum::REFUND], true);
        $isActionRequest = ($status === StatusEnum::ACTION_REQUEST);

        $stepClasses = [];

        if (($isErrorStatus || $isActionRequest)) {
            foreach ($steps as $step) {
                $stepClasses[] = 'disabled';
            }
            $errorActive = $isErrorStatus ? 'active' : '';
        } elseif (isset($activeIndex)) {
            foreach ($steps as $index => $step) {
                if ($index < $activeIndex) {
                    $stepClasses[] = 'completed';
                } elseif ($index === $activeIndex) {
                    $stepClasses[] = 'active';
                } else {
                    $stepClasses[] = 'disabled';
                }
            }
            $errorActive = '';
        } else {
            foreach ($steps as $step) {
                $stepClasses[] = 'disabled';
            }
            $errorActive = '';
        }

        $templatePath = "./templates/status.php";
        $this->render($templatePath, [
            'steps' => $steps,
            'stepClasses' => $stepClasses,
            'errorActive' => $errorActive,
            'translationService' => $this->translationService,
        ]);
    }

    public function renderTemplateByStatus(string $status, array $data = []): void
    {
        $data = [
            "orderData"  => $data,
        ];
        $templatePath = $this->getTemplatePath($status);
        $this->render($templatePath, $data);
    }
}
