<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRoleMiddleware;
use \App\Http\Middleware\LocaleMiddleware;
use \App\Http\Middleware\SetCurrency;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/client.php'
        ],
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => CheckRoleMiddleware::class,
            'locale' => LocaleMiddleware::class,
            'currency' => SetCurrency::class,
        ]);

        $middleware->web(append: [
            LocaleMiddleware::class,
            SetCurrency::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
