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
        // ALIAS MIDDLEWARE DEFAULT LARAVEL (DIBUTUHKAN UNTUK auth, guest, verified)
        // $middleware->alias([
        //     'auth' => \App\Http\Middleware\Authenticate::class,
        //     'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        //     'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        // ]);

        // ALIAS CUSTOM KAMU
        $middleware->alias([
            'displayOnly' => \App\Http\Middleware\EnsureDisplayUser::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
