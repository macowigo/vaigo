<?php

use App\Http\Controllers\Admin\CentersController;
use App\Http\Controllers\Auth\RedirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CompanyCRUDController;
use App\Http\Controllers\DeparturerOrderController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/redirect',[RedirectController::class,'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//center
Route::post('orders/create',[OrdersController::class,'calculatecost'],function(){
    return view('centers.create');
})->name('calculate');
Route::get('/center/dashboard',function(){
    return view('centers.dashboard');
})->middleware(['auth'])->name('centerdashboard');
Route::resource('orders',OrdersController::class)->middleware(['auth']);
Route::get('/centerorder/domestic',[OrdersController::class,'domestic'],function(){
    return view('centers.domesticorders');
})->middleware(['auth'])->name('domesticorder');
//domestic new order
Route::get('/center/domestic_neworders',[OrdersController::class,'domesticneworder']
)->middleware(['auth'])->name('domesticnew');

Route::get('/centerorder/regional',[OrdersController::class,'regional'],function(){
    return view('centers.regional');
})->middleware(['auth'])->name('regionalorder');

Route::get('/centerorder/international',[OrdersController::class,'international'],function(){
    return view('centers.regional');
})->middleware(['auth'])->name('internationalorder');

#depatirer
Route::middleware('auth')->group(function(){
    Route::get('/depaturer/dashboard',function(){
        return view('departurer.dashboard');
    })->name('dptdashboard');
    Route::get('/depaturer/new_orders',[DeparturerOrderController::class,'neworder'])->name('departurenew');
    Route::get('/{oderid}/depaturer/',[DeparturerOrderController::class,'deptview'])->name('departurerview');

});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
