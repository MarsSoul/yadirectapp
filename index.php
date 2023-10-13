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


use App\Core\Router;

$router = new Router();
$router->route();