<?php

use App\Http\Controllers\Admin\CentersController;
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
Route::get('/admin/addcenter',[CentersController::class,'addcenterview'])->middleware(['auth'])->name('addcenter');
Route::post('registercenter',[CentersController::class,'savecenters'])->middleware(['auth'])->name('registercenter');
Route::get('/admin/centers',[CentersController::class,'centerslist'])->middleware(['auth'])->name('centerlist');
Route::get('/admin/centers_manage',[CentersController::class,'centersmanage'])->middleware(['auth'])->name('centemanage');
Route::delete('/admin/centers_manage/{centerid}',[CentersController::class,'deletecenter'])->middleware(['auth'])->name('deletecenter');
Route::get('/centers_edit/{centerid}',[CentersController::class,'returncenter'])->middleware(['auth'])->name('editcenter');
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




Route::get('/map',function(){
    return view('admin.map');
});

Route::resource('companies', CompanyCRUDController::class);


require __DIR__.'/auth.php';
