<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Controllers\Dkm\DkmAuthController;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'auth.dkm' => \App\Http\Middleware\DkmAuth::class,
        'auth.dkm.pin' => \App\Http\Middleware\VerifyDkmPin::class,
        'risnha.auth' => \App\Http\Middleware\RisnhaAuth::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
