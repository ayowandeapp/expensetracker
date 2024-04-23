<?php

declare(strict_types=1);

namespace Framework;


class Router
{
    private array $routes = []; //store thr list of routes in the system
    private array $middlewares = [];

    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath(path: $path);

        $regPath = preg_replace('#{[^/]+}#', '([^/]+)', $path);

        //a single route will need several information
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller,
            'middlewares' => [],
            'regPath' => $regPath
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);

        return $path;
    }

    //send it to a destination (match controller and method)
    public function dispatch(string $path,  string $method, Container $container = null)
    {

        $path = $this->normalizePath($path);
        $method = strtoupper($_POST['_METHOD'] ?? $method);

        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['regPath']}$#", $path, $paramValues) ||
                $route['method'] !== $method
            ) { //force an exact match using regular expressions
                continue;
            }
            // echo 'route found';

            array_shift($paramValues);
            preg_match_all('#{([^/]+)}#', $route['path'], $paramKeys);
            $paramKeys = $paramKeys[1];

            $params = array_combine($paramKeys, $paramValues);

            [$class, $function] = $route['controller']; //extract the array into variables by distructuring

            //instantiate the class with string
            $controllerInit = $container ? $container->resolve($class) : new $class;

            $action = fn () => $controllerInit->{$function}($params);

            $allMiddleware = [...$route['middleware'], ...$this->middlewares];

            foreach ($allMiddleware as $middleware) {
                $middlewareInit = $container ? $container->resolve($middleware) : new $middleware;
                $action = fn () => $middlewareInit->process($action);
            }

            $action();
            return;
        }
    }

    public function addMiddleware(string $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function addRouteMiddleware(string $middleware)
    {
        $lastRouteKey = array_key_last($this->routes);
        $this->routes[$lastRouteKey]['middleware'][] = $middleware;
    }
}
