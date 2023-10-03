<?php

namespace App\Core;

use App\Core\Routes;

//TODO 404

class Router {

    private static $controllerNamespace = 'App\\Controllers\\';
    public static function route() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        $routes = Routes::$routes;

        foreach ($routes as $route) {
            list($method, $url, $action) = $route;

//            if (($method === $requestMethod) || ($method === 'GET' && preg_match("^(HEAD|GET)$^", $requestMethod))) {
            if ($method === $requestMethod ) {
                if (preg_match("#^$url$#", $requestUri, $matches)) {
                    array_shift($matches);
                    self::callAction($action, $matches);
                    return;
                }
            }
        }
        
        echo "404";
    }

    private static function callAction($action, $params) {
        list($controllerMethod, $methodName) = explode('@', $action);
        $controllerClass = self::$controllerNamespace . $controllerMethod;
        $controller = new $controllerClass();
        call_user_func([$controller, $methodName], $params);
    }
}