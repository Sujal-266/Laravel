<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public static function successResponse($data = [], $message = 'Success', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function errorResponse($message = 'Error', $code = 400, $errors = null): JsonResponse
    {
        $payload = [
            'status'  => false,
            'message' => $message,
        ];
        if (!is_null($errors)) {
            $payload['errors'] = $errors;   // <-- include field-wise errors
        }

        return response()->json($payload, $code);
    }
}