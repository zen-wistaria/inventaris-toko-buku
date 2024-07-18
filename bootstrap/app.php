<?php

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
            'auth0' => \App\Http\Middleware\IsAuth0::class,
            'auth1' => \App\Http\Middleware\IsAuth1::class,
            'auth2' => \App\Http\Middleware\IsAuth2::class,
        ]);
        // $middleware->append(\App\Http\Middleware\IsAuth0::class);
        // $middleware->append(\App\Http\Middleware\IsAuth1::class);
        // $middleware->append(\App\Http\Middleware\IsAuth2::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
