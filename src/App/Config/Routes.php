<?php

declare(strict_types=1);

namespace App\Config;


use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use App\Middleware\AuthRequiredMiddleware;
use App\Middleware\GuestOnlyMiddleware;
use Framework\App;

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [RegisterController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [RegisterController::class, 'registerForm'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [RegisterController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [RegisterController::class, 'loginForm'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [RegisterController::class, 'logout'])->add(AuthRequiredMiddleware::class);
}
