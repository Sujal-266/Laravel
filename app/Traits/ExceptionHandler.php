<?php

namespace App\Traits;

use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Traits\ApiResponse;

trait ExceptionHandler
{
    /**
     * Handle API exceptions with custom JSON responses.
     */
    public static function handleApiException(Exceptions $exceptions)
    {
        // Only apply for API requests
        if (request()->is('api/*')) {
            $exceptions->render(function (ValidationException $e) {
                return ApiResponse::errorResponse('Validation failed', 422);
            });

            $exceptions->render(function (ModelNotFoundException $e) {
                return ApiResponse::errorResponse('Resource not found', 404);
            });

            $exceptions->render(function (NotFoundHttpException $e) {
                // If this 404 came from missing model (implicit binding), say "Resource not found"
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    return ApiResponse::errorResponse('Resource not found', 404);
                }

                // Real missing route
                return ApiResponse::errorResponse('Endpoint not found', 404);
            });

            $exceptions->render(function (MethodNotAllowedHttpException $e) {
                return ApiResponse::errorResponse('Method not allowed', 405);
            });

            $exceptions->render(function (AuthenticationException $e) {
                return ApiResponse::errorResponse('Unauthenticated', 401);
            });

            $exceptions->render(function (QueryException $e) {
                return ApiResponse::errorResponse('Database query error', 500);
            });

            $exceptions->render(function (HttpException $e) {
                return ApiResponse::errorResponse('Validation failed', 422);
            });
        }
    }
}
