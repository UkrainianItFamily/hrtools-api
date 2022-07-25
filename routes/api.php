<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/status/{serviceName?}', [StatusController::class, 'status']);
Route::post('/mail', [StatusController::class, 'mail']);
Route::post('/broadcast', [StatusController::class, 'event']);

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('register', [RegistrationController::class, 'register']);
        Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
        Route::post('reset', [AuthController::class, 'reset'])->name('reset-password');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('email')->group(function () {
        Route::post('verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('resend/{id}', [VerificationController::class, 'resend'])->name('verification.resend');
        Route::post('verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('resend/{id}', [VerificationController::class, 'resend'])->name('verification.resend');
    });
});
