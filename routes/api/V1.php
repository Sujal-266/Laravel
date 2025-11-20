<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\SubCategoryController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\FileController;
use App\Http\Controllers\Api\V1\MailController;


// Public routes
Route::post('users/register', [AuthController::class, 'register']);
Route::post('users/login', [AuthController::class, 'login']);
Route::get('/test-error-log', function () {
    \App\Traits\ErrorManager::registerError('Test error', __FILE__, __LINE__, __FILE__);
    return 'Error log tested';
});

// Protected route
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('subcategories', SubCategoryController::class);
    Route::post('users/logout', [AuthController::class, 'logout']);

    // File management routes
    Route::post('files/upload', [FileController::class, 'uploadFile']);
    Route::delete('files/delete', [FileController::class, 'fileDestroy']);

    // Categories routes
    Route::post('category/{id}/update', [CategoryController::class, 'update']);
    Route::post('category/{id}/like', [CategoryController::class, 'like']);
    Route::post('category/{id}/dislike', [CategoryController::class, 'dislike']);
    Route::post('category/{id}/comment', [CategoryController::class, 'comment']);
    
    // SubCategories routes
    Route::post('subcategory/{id}/update', [SubCategoryController::class, 'update']);
    Route::post('subcategory/{id}/like', [SubCategoryController::class, 'like']);
    Route::post('subcategory/{id}/dislike', [SubCategoryController::class, 'dislike']);
    Route::post('subcategory/{id}/comment', [SubCategoryController::class, 'comment']);

});
