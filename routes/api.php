<?php

use App\Http\Controllers\Api\UserLogin;
use App\Http\Controllers\Api\VendorOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('calculate',[VendorOrders::class,'calculatecost']);
Route::post('createorder',[VendorOrders::class,'store']);
Route::post('login',[UserLogin::class,'login']);
Route::get('myorder/{id}',[VendorOrders::class,'getorder']);
