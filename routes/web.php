<?php

use App\Http\Controllers\Auth\RedirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CompanyCRUDController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/redirect',[RedirectController::class,'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//admin
Route::get('/admin/dashboard',function(){
    return view('admin.dashboard');
})->middleware(['auth'])->name('admindshboard');

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

Route::get('/centerorder/regional',[OrdersController::class,'regional'],function(){
    return view('centers.regional');
})->middleware(['auth'])->name('regionalorder');

Route::get('/centerorder/international',[OrdersController::class,'international'],function(){
    return view('centers.regional');
})->middleware(['auth'])->name('internationalorder');




Route::get('/map',function(){
    return view('admin.map');
});

Route::resource('companies', CompanyCRUDController::class);


require __DIR__.'/auth.php';
