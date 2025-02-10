<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware Groups
        $middleware->group('web', [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // تأكد من أن هذا الميدلوير مضاف
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        ]);
        // Middleware الخاص بعرض حالة المستخدمين لتسجيل اخر نشاط لهم
        $middleware->alias([
            'update_last_activity_middleware' => \App\Http\Middleware\UpdateLastActivity::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
