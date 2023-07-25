<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    PostCategoryController,
    PostController
};

Route::middleware('auth:sanctum')->group(static function () {
    Route::apiResource('categories', PostCategoryController::class)->parameter('categories', 'postCategory');
    Route::apiResource('posts', PostController::class);
});
