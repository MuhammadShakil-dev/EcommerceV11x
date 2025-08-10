<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Backend\AdminMiddleware;
use App\Http\Middleware\Frontend\UserMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
         // 'adminAuth' => \App\Http\Middleware\Backend\AdminMiddleware::class,
            'adminAuth' => AdminMiddleware::class,
            'userAuth' => UserMiddleware::class,

       ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
