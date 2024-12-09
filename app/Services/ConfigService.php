<?php

namespace App\Services;

class ConfigService
{
    private static $config;
    
    private static function loadConfig()
    {
        if (self::$config === null) {
            self::$config = require './config.php';
        }
    }
    
    public static function get($key, $default = null)
    {
        self::loadConfig();
        return self::$config[$key] ?? $default;
    }
}
