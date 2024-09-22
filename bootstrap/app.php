<?php

use App\Http\Middleware\MiddlewareAuth;
use App\Http\Middleware\MiddlewareAuthenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\StorePreviousUrl;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'check' => MiddlewareAuth::class,
            'very' => MiddlewareAuthenticate::class,
            // 'admin' => AdminMiddleware::class,
            // 'client' => ClientMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
