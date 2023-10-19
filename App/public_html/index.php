<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


if(file_exists(__DIR__ . '/vendor/autoload.php'))
{
    require_once __DIR__ . '/vendor/autoload.php';
}
else
{
    echo 'autoload.php not found';
}

if (file_exists(__DIR__ . '/.env'))
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} else
{
    die('.env not found');
}

use App\Core\Router;

$router = new Router();
$router->route();