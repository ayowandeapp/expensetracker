<?php

declare(strict_types=1);

namespace App\Config;


use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use App\Controllers\TransactionController;
use App\Controllers\UserController;
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
    $app->get('/transaction', [TransactionController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction', [TransactionController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction/{id}', [TransactionController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction/{id}', [TransactionController::class, 'edit'])->add(AuthRequiredMiddleware::class);
    $app->delete('/transaction/{id}', [TransactionController::class, 'delete'])->add(AuthRequiredMiddleware::class);

    $app->get('/view_profile', [UserController::class, 'viewProfile'])->add(AuthRequiredMiddleware::class);
    $app->get('/profile', [UserController::class, 'editProfile'])->add(AuthRequiredMiddleware::class);
    $app->post('/profile', [UserController::class, 'editProfile'])->add(AuthRequiredMiddleware::class);
}
