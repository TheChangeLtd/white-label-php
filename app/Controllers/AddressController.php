<?php

namespace App\Controllers;

class AddressController
{
    protected $addressService;
    protected $translationService;

    public function __construct($addressService, $translationService)
    {
        $this->addressService = $addressService;
        $this->translationService = $translationService;
    }

    public function validate()
    {
        $this->translationService->loadTranslations('errors');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["message" => $this->translationService->trans('missing')]);
            exit;
        }
        $inputData = json_decode(file_get_contents('php://input'), true);
        $currency = $inputData['currency'] ?? null;
        $address = $inputData['address'] ?? null;
        $network = $inputData['network'] ?? null;

        if (!$address) {
            http_response_code(400);
            echo json_encode(["message" => $this->translationService->trans('missing')]);
            exit;
        }

        if (!$currency ) {
            http_response_code(400);
            echo json_encode(["message" => $this->translationService->trans('missing')]);
            exit;
        }

        $response = $this->addressService->validateAddress($currency, $address, $network);

        if ($response['httpCode'] == 400) {
            http_response_code($response['httpCode']);
            echo json_encode(['message' => $this->translationService->trans('not_valid_address'), 'content' => $response['content']]);
            exit;
        }
        
        http_response_code(200);
        echo json_encode($response['content']);
        exit;
    }
}
