<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {

            if (!auth()->check()) {
                return redirect()
                    ->route('auth.form')
                    ->with('error', 'Для доступа к этой странице необходимо войти в систему');
            }

            return response()->view('errors.403', [], 403);
        });

        $exceptions->renderable(function (Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e, $request) {

            return redirect()->route('auth.form')->with('error', 'Ошибка доступа');
        });
    })->create();
