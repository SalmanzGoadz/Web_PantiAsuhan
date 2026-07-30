<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Redirect guest berdasarkan konteks URL
        // Admin guest → /admin/login, Donatur guest → /login
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            return route('donatur.login');
        });

        // Redirect user yang sudah login berdasarkan role
        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();
            if ($user && $user->isAdmin()) {
                return route('admin.dashboard');
            }
            return route('donatur.dashboard');
        });

        // Registrasi middleware alias 'role'
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
