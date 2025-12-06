<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Désactiver le middleware CORS par défaut de Laravel
        $middleware->remove(\Illuminate\Http\Middleware\HandleCors::class);
        // Utiliser notre middleware CORS custom en priorité
        $middleware->prepend(\App\Http\Middleware\Cors::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(fn() => true);
        $exceptions->dontFlash(['current_password', 'password', 'password_confirmation']);
    })->create();