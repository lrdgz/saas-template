<?php

use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
    'namespace' => 'Api',
    'as' => 'auth.'
], static function () {
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
    Route::post('me', [AuthenticationController::class, 'me'])->middleware('auth:sanctum')->name('me');
});

Route::get(
    uri: '/email/verify/{id}/{hash}',
    action: [AuthenticationController::class, 'verifyEmail']
)->middleware(['signed'])->name('verification.verify');

Route::post(
    uri: '/email/verification-notification',
    action: [AuthenticationController::class, 'resendVerificationEmail']
)->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

Route::post(
    uri: '/forgot-password',
    action: [AuthenticationController::class, 'forgotPassword']
)->middleware('guest')->name('password.email');

Route::get('/reset-password\{token}', static function (string $token) {
    return response()->json(['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post(
    uri: '/reset-password',
    action: [AuthenticationController::class, 'updatePassword']
)->middleware('guest')->name('password.update');
