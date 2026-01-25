<?php
    namespace App\Core;
    use App\Http\Request;

    class Router{
        private array $routes = [];
        private Container $container;

        public function __construct(Container $container){
            $this->container = $container;
        }

        public function add(string $method, string $path ,array|callable $action, array $middleware = []):void{
            $this->routes[] = compact("method", "path", "action", "middleware");
        }

        public function dispatch(Request $request):void{
            $method = $request->method();
            $path = $request->path();

            foreach($this->routes as $route){
                if(strtoupper($method) !== $route["method"]){
                    continue;
                }

                $regex = $this->convertRoutePathToRegex($route['path']);
                if(preg_match($regex, $path, $matches)){
                    array_shift($matches);

                    foreach($route['middleware'] as $middleware){

                        if(is_callable($middleware)){
                            $middlewareInstance = $middleware($this->container);
                            $middlewareInstance->handle($request);
                            continue;
                        }

                        $middlewareInstance = new $middleware();
                        $middlewareInstance->handle($request);
                    }

                    if(is_array($route['action'])){
                        [$controllerClass, $methodName] = $route['action'];
                        $controllerInstance = $this->container->make($controllerClass);
                        call_user_func_array([$controllerInstance, $methodName], $matches);
                        return;
                    }

                    if(is_callable($route['action'])){
                        call_user_func_array($route['action'], $matches);
                        return;
                    }
                }
            }
            $this->abort404();
        }

        private function convertRoutePathToRegex(string $routePath):string{
            $regex = preg_replace("#\{[a-zA-Z_]+\}#","([a-zA-Z0-9_-]+)", $routePath);
            return "#^$regex$#";
        }

        public function abort404(){
            http_response_code(404);
            view('errors/404');
        }
    }