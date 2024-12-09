<?php

namespace App\Controllers;

class ExchangeController
{
    protected $exchangeService;
    protected $translationService;

    public function __construct($exchangeService, $translationService)
    {
        $this->exchangeService = $exchangeService;
        $this->translationService = $translationService;
    }

    public function validatePairSettings()
    {
        $this->translationService->loadTranslations('errors');
        $send = $_GET['send'] ?? null;
        $receive = $_GET['receive'] ?? null;
        $sendNetwork = $_GET['sendNetwork'] ?? null;
        $receiveNetwork = $_GET['receiveNetwork'] ?? null;

        if (!$send || !$receive || !$sendNetwork || !$receiveNetwork) {
            http_response_code(400);
            echo json_encode(['message' => $this->translationService->trans('missing')]);
            exit;
        }

        $pairData = $this->exchangeService->getPair($send, $receive, $sendNetwork, $receiveNetwork);
        $httpCode = $pairData['httpCode'];

        if ($httpCode == 400) {
            http_response_code($httpCode);
            echo json_encode(['message' => $this->translationService->trans('unavailable'), 'content' => $pairData ?? 'Unknown error']);
            exit;
        }

        if ($httpCode !== 200) {
            http_response_code($httpCode);
            echo json_encode(['message' => $this->translationService->trans('internal_error'), 'content' => $pairData]);
            exit;
        }

        http_response_code(200);
        echo json_encode(['httpCode' => 200, 'content' => $pairData['content']]);
    }

    public function validateAmount()
    {
        $this->translationService->loadTranslations('errors');
        $send = $_GET['send'] ?? null;
        $receive = $_GET['receive'] ?? null;
        $amount = $_GET['amount'] ?? null;
        $sendNetwork = $_GET['sendNetwork'] ?? null;
        $receiveNetwork = $_GET['receiveNetwork'] ?? null;

        if (!$send || !$receive || !$amount || !$sendNetwork || !$receiveNetwork) {
            http_response_code(400);
            echo json_encode(['message' => $this->translationService->trans('missing')]);
            exit;
        }

        $rateData = $this->exchangeService->getRate($send, $receive, $amount, $sendNetwork, $receiveNetwork);
        $httpCode = $rateData['httpCode'];

        if ($httpCode == 400) {
            http_response_code($httpCode);
            echo json_encode(['message' => $this->translationService->trans('not_allowed_amount'), 'content' => $rateData ?? 'Unknown error']);
            exit;
        }

        if ($httpCode !== 200) {
            http_response_code($httpCode);
            echo json_encode(['message' => $this->translationService->trans('internal_error'), 'content' => $rateData ?? 'Unknown error']);
            exit;
        }

        http_response_code(200);
        echo json_encode(['httpCode' => 200, 'content' => $rateData['content']]);
    }
}
