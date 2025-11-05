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

    public static function errorResponse($message, $code): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            ], $code);
        }
}
