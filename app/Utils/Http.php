<?php

namespace App\Utils;

use App\Utils\Network;

class Http
{
    public static function makeRequest($url, $method, $payload = '', $headers = [])
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        $headers[] = "X-Forwarded-For: " . Network::getClientIP();
        $headers[] = "Origin: " . Network::getClientOrigin();
        
        switch (strtoupper($method)) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

                if (!in_array('Content-Type: application/json', $headers)) {
                    $headers[] = 'Content-Type: application/json';
                }
                break;

            case 'GET':
                curl_setopt($curl, CURLOPT_HTTPGET, true);
                break;

            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                break;
        }

        if (!empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE) ?: 500;
            curl_close($curl);
            return [
                'httpCode' => $httpCode,
                'error' => 'cURL error: ' . $error,
                'content' => null
            ];
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $decodedResponse = json_decode($response, true);

        if ($decodedResponse === null && json_last_error() !== JSON_ERROR_NONE) {
            $jsonError = json_last_error_msg();
            curl_close($curl);
            return [
                'httpCode' => $httpCode,
                'error' => 'JSON decode error: ' . $jsonError,
                'content' => $response,
            ];
        }

        curl_close($curl);

        if ($httpCode !== 200) {
            $errorMessage = isset($decodedResponse['message']) ? $decodedResponse['message'] : 'HTTP error';
            return [
                'httpCode' => $httpCode,
                'error' => $errorMessage,
                'content' => $decodedResponse
            ];
        }

        return [
            'httpCode' => $httpCode,
            'content' => $decodedResponse
        ];
    }
}

