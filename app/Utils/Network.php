<?php
namespace App\Utils;

class Network
{
    public static function getClientIP()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            return $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        return $_SERVER["REMOTE_ADDR"];
    }
    public static function getClientOrigin() {
        $scheme = 'http://';
        if (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
            ($_SERVER['SERVER_PORT'] ?? '') == 443
        ) {
            $scheme = 'https://';
        }

        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return $scheme . $host;
    }
}