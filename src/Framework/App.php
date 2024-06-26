<?php



namespace Framework;

class App
{
    private Router $router;
    private Container $container;

    public function __construct(string $containerDefinitionsPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();
        if ($containerDefinitionsPath) {
            $containerDefinitions = include $containerDefinitionsPath; //include the file since it returns an array of the definitions
            $this->container->addDefinitions($containerDefinitions);
        }
    }

    public function run(): void
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        $this->router->dispatch($path, $method, $this->container);
    }

    public function get(string $path, array $controller)
    {
        $this->router->add('GET', $path, $controller);

        return $this;
    }

    public function post(string $path, array $controller)
    {
        $this->router->add('POST', $path, $controller);

        return $this;
    }
    public function delete(string $path, array $controller)
    {
        $this->router->add('DELETE', $path, $controller);

        return $this;
    }
    public function addMiddleware(string $middleware)
    {
        $this->router->addMiddleware($middleware);
    }

    public function add(string $middleware)
    {
        $this->router->addRouteMiddleware($middleware);
    }
}
