<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    public function render($request, Throwable $e)
    {
        // Handle Model not found
        if ($e instanceof ModelNotFoundException) {
            return $this->errorResponse('Resource not found', 404);
        }

        // Handle 404 route not found
        if ($e instanceof NotFoundHttpException) {
            return $this->errorResponse('Endpoint not found', 404);
        }

        // Handle validation errors
        if ($e instanceof ValidationException) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        }

        // Handle unauthenticated access
        if ($e instanceof AuthenticationException) {
            return $this->errorResponse('Unauthenticated', 401);
        }

        // Default fallback
        return $this->errorResponse($e->getMessage(), 500);
    }
}
