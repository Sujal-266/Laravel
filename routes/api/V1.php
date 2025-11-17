<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\SubCategoryController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\FileController;

Route::post('users/register', [AuthController::class, 'register']);
Route::post('users/login', [AuthController::class, 'login']);

// Protected route
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('subcategories', SubCategoryController::class);
    Route::post('users/logout', [AuthController::class, 'logout']);
    Route::post('files/upload', [FileController::class, 'uploadFile']);
    Route::delete('files/delete', [FileController::class, 'fileDestroy']);
    Route::post('categories/update/{id}', [CategoryController::class, 'update']);
    Route::post('subcategories/update/{id}', [SubCategoryController::class, 'update']);
    Route::post('category/like/{id}', [CategoryController::class, 'like']);
    Route::post('category/dislike/{id}', [CategoryController::class, 'dislike']);
    Route::post('subcategory/like/{id}', [SubCategoryController::class, 'like']);
    Route::post('subcategory/dislike/{id}', [SubCategoryController::class, 'dislike']);
});
