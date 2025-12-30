<?php

namespace Nex;

class Router {
    protected static array $routes = [];
    protected static Request $request;
    protected static Response $response;

    public static function get($path, $callback) {
        self::$routes['get'][$path] = $callback;
    }

    public static function post($path, $callback) {
        self::$routes['post'][$path] = $callback;
    }

    public static function run() {
        self::$request = new Request();
        self::$response = new Response();
        
        $method = self::$request->getMethod();
        $uri = self::$request->getPath();
        $uri = '/' . trim($uri, '/');

        $routesToSearch = self::$routes[$method] ?? [];

        foreach ($routesToSearch as $path => $callback) {
            $pattern = "@^" . preg_replace('/\[([a-zA-Z0-9\_\-]+)\]/', '(?P<$1>[a-zA-Z0-9\_\-]+)', $path) . "$@";
            
            if (preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                // Parametrelerin başına Request ve Response nesnelerini ekliyoruz
                // Böylece Controller'da bunları kullanabileceğiz
                $args = [self::$request, self::$response, ...array_values($params)];
                
                $responseContent = null;

                if (is_callable($callback)) {
                    $responseContent = call_user_func_array($callback, $args);
                } 
                elseif (is_string($callback) && strpos($callback, '@') !== false) {
                    list($controllerName, $methodName) = explode('@', $callback);
                    $fullControllerPath = "App\\Controllers\\" . $controllerName;
                    
                    if (class_exists($fullControllerPath)) {
                        $instance = new $fullControllerPath();
                        $responseContent = call_user_func_array([$instance, $methodName], $args);
                    }
                }

                // Çıktıyı yönet
                if (is_array($responseContent) || is_object($responseContent)) {
                    self::$response->json($responseContent);
                } else {
                    echo $responseContent;
                }
                return;
            }
        }

        self::$response->setStatusCode(404);
        echo "404 - Sayfa Bulunamadı!";
    }
}