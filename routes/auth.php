<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
Route::middleware('guest')->group(function () {
    Route::get('/',[AuthenticatedSessionController::class, 'create']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgotpassword',[AuthenticatedSessionController::class,'forgotview'])
    ->name('passforgot');
    Route::post('forgotpassword',[AuthenticatedSessionController::class,'sendtoken'])
    ->name('sendtoken');
});

Route::middleware('auth')->group(function () {
    Route::get('verify',[AuthenticatedSessionController::class,'verifyview'])
    ->name('verifytoken');
    Route::post('verify',[AuthenticatedSessionController::class,'verifycode'])
    ->name('tokenverify');
    Route::get('changepassword',[AuthenticatedSessionController::class,'changepassview'])
    ->name('changepassword');
    Route::post('changepassword',[AuthenticatedSessionController::class,'changepassword'])
    ->name('changepassword');
});
