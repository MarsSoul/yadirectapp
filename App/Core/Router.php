<?php

namespace App\Core;

use App\Core\Routes;


class Router
{
    private static $controllerNamespace = 'App\\Controllers\\';
    public static function route() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        $routes = Routes::$routes;

        foreach ($routes as $route) {
            list($method, $url, $action) = $route;

            if ($method === $requestMethod ) {
                if (preg_match("#^$url$#", $requestUri, $matches)) {
                    array_shift($matches);
                    self::callAction($action, $matches);
                    return;
                }
            }
        }

        http_response_code(404);
        self::callAction('Error404Controller@index', ['Неправильный маршрут' . $requestMethod . $requestUri]);
    }

    private static function callAction($action, $params) {
        list($controllerMethod, $methodName) = explode('@', $action);
        $controllerClass = self::$controllerNamespace . $controllerMethod;
        $controller = new $controllerClass();
        call_user_func_array([$controller, $methodName], $params);
    }
}