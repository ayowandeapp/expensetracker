<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use App\Config\Paths;
use Dotenv\Dotenv;
use Framework\App;

use function App\Config\registerMiddleware;
use function App\Config\registerRoutes;



$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app); //out source the route to a function, you may use static class instead
registerMiddleware($app);

return $app;
