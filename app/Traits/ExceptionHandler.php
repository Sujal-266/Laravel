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
        if (request()->is('*api*')) {
            $exceptions->render(function (QueryException $e) {
                return ApiResponse::errorResponse($e->getMessage());
            });
            $exceptions->render(function (ValidationException $e) {
                return ApiResponse::errorResponse($e->getMessage());
            });
            $exceptions->render(function (ModelNotFoundException $e) {
                return ApiResponse::errorResponse($e->getMessage(), 404);
            });
            $exceptions->render(function (AuthenticationException $e) {
                return ApiResponse::errorResponse($e->getMessage(), 401);
            });
            $exceptions->render(function (MethodNotAllowedHttpException $e) {
                return ApiResponse::errorResponse($e->getMessage(), 405);
            });
            $exceptions->render(function (NotFoundHttpException $e) {
                return ApiResponse::errorResponse($e->getMessage(), 404);
            });
            $exceptions->render(function (HttpException $e) {
                return ApiResponse::errorResponse($e->getMessage());
            });
        }
    }
}
