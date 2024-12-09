<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

use App\App;

$app = new App();
$app->run();

