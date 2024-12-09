<?php
namespace App\Controllers;

class OrderController
{
    protected $orderService;
    protected $translationService;
    protected $templateRenderer;

    public function __construct($orderService, $translationService, $templateRenderer)
    {
        $this->orderService = $orderService;
        $this->translationService = $translationService;
        $this->templateRenderer = $templateRenderer;
    }

    public function placeOrder()
    {
        $this->translationService->loadTranslations('errors');

        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $send = $data['send'] ?? null;
        $sendNetwork = $data['sendNetwork'] ?? null;
        $receive = $data['receive'] ?? null;
        $receiveNetwork = $data['receiveNetwork'] ?? null;
        $amount = $data['amount'] ?? null;
        $receiveAddress = $data['receiveAddress'] ?? null;
        $payload = $data['payload'] ?? null;

        if (!$send || !$receive || !$amount || !$receiveAddress || !$sendNetwork || !$receiveNetwork || !$payload) {
            http_response_code(400);
            echo json_encode(['message' => $this->translationService->trans('missing')]);
            exit;
        }

        $response = $this->orderService->placeOrder($send, $receive, $amount, $receiveAddress, $sendNetwork, $receiveNetwork, $payload);

        if ($response['httpCode'] !== 200) {
            http_response_code($response['httpCode']);
            echo json_encode(['message' => $this->translationService->trans('internal_error')]);
            exit;
        }
        http_response_code(200);
        echo json_encode($response);
    }

    public function getOrderStatus($id)
    {
        $this->translationService->loadTranslations('order');
        $this->translationService->loadTranslations('errors');
        $orderData = $this->orderService->getOrderStatus($id);

        $httpCode = intval($orderData['httpCode']);

        $content = $orderData['content'];
        if(isset($content['status'])){
            $status = $content['status'];
        }

        if ($httpCode == 404) {
            http_response_code($httpCode);
            header('Content-Type: application/json');
            echo json_encode(['message' => $this->translationService->trans('order_not_found'), 'content' => $content]);
            exit;
        }

        header('Content-Type: application/json');

        if (!isset($_SESSION['order_status']) || !is_array($_SESSION['order_status'])) {
            $_SESSION['order_status'] = [];
        }

        $previousStatus = $_SESSION['order_status'][$id] ?? null;

        $statusChanged = ($status !== $previousStatus);

        if ($statusChanged) {
            $_SESSION['order_status'][$id] = $status;
        }

        if (!$statusChanged) {
            header('Content-Type: application/json');
            echo json_encode(
                [
                    'content' => [
                        'status' => $status,
                        'send' => $content['send'] ?? '',
                        'receive' => $content['receive'] ?? '',
                        'status_changed' => false,
                    ],
                ]
            );
            exit;
        }

        $templatePath = $this->templateRenderer->getTemplatePath($status);

        if (!file_exists($templatePath)) {
            http_response_code(500);
            echo json_encode(['message' => $this->translationService->trans('internal_error')]);
            exit;
        }

        ob_start();
        $context = [
            'orderData' => $content,
        ];
        $this->templateRenderer->render($templatePath, $context);
        $renderedHtml = ob_get_clean();

        http_response_code(200);
        echo json_encode([
            'content' => [
                'status' => $status,
                'send' => $content['send'] ?? '',
                'receive' => $content['receive'] ?? '',
                'html' => $renderedHtml,
                'status_changed' => true,
            ],
        ]);
    }
}
