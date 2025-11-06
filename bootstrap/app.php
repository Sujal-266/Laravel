<?php

use App\Traits\ApiVersion;
use App\Traits\ApiResponse;
use App\Traits\ExceptionHandler;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: ApiVersion::configureApiVersioning()
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(SetLocale::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        ExceptionHandler::handleApiException($exceptions);
        $exceptions->render(function (ValidationException $e) {
    return ApiResponse::errorResponse(__('messages.validation_failed'), 422, $e->errors());
});
    })->create();
