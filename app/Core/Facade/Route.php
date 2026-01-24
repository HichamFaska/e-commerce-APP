<?php
    namespace App\Core\Facade;
    use App\Core\Router;

    class Route{
        private static Router $router;

        public static function setRouter(Router $router):void{
            self::$router = $router;
        }

        public static function get(string $path, array|callable $action, array $middleware = []):void{
            self::$router->add("GET", $path, $action, $middleware);
        }

        public static function post(string $path, array|callable $action, array $middleware = []):void{
            self::$router->add("POST", $path, $action, $middleware);
        }

        public static function put(string $path, array|callable $action, array $middleware = []):void{
            self::$router->add("PUT", $path, $action, $middleware);
        }

        public static function delete(string $path, array|callable $action, array $middleware = []):void{
            self::$router->add("DELETE", $path, $action, $middleware);
        }
    }