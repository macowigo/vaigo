<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ChangePassword;
use App\Http\Controllers\Auth\RedirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Orders\DomesticOrder;

Route::get('/redirect',[RedirectController::class,'index']);
#center
Route::middleware('auth','role:center')->group(function(){
    Route::get('/center/dashboard',[DomesticOrder::class,'dashboardview'])->name('centerdashboard');
    Route::resource('orders',OrdersController::class);
    Route::post('/orders/calculate',[DomesticOrder::class,'calculatecost'])->name('calculate');
    Route::post('/orders/create',[DomesticOrder::class,'createorder'])->name('createdomestic');
    Route::get('/center/domestic_neworders',[DomesticOrder::class,'domesticneworder'])->name('domesticnew');
    Route::get('/center/domestic_today',[DomesticOrder::class,'domestictoday'])->name('domestictoday');
    Route::get('/center/domestic_created',[DomesticOrder::class,'createddomestic'])->name('domesticcreated');
    Route::get('/center/domestic_cancelled',[DomesticOrder::class,'cancelleddomestic'])->name('domesticancelled');
    Route::get('/center/domestic_delivering',[DomesticOrder::class,'deliverdomestic'])->name('domesticdelivering');
    Route::get('/center/domestic_incomplete',[DomesticOrder::class,'incompletedomestic'])->name('domesticincomplete');
    Route::get('/center/domestic_complete',[DomesticOrder::class,'completedomestic'])->name('domesticcomplete');
    Route::post('/create/{oderid}',[DomesticOrder::class,'acceptorder'])->name('acceptdomestic');
    Route::post('/cancell/{oderid}',[DomesticOrder::class,'cancelorder'])->name('canceldomestic');
    Route::get('/centerorder/domestic',[DomesticOrder::class,'domestic'])->name('domesticorder');
    Route::get('/centerorder/regional',[OrdersController::class,'regional'])->name('regionalorder');
    Route::get('/centerorder/international',[OrdersController::class,'international'])->name('internationalorder');
});
#departurer

#change password
Route::middleware('auth')->group(function(){
    Route::get('auth/changepassword',function(){
        return view('admin.changepassword');
    })->name('changepass');
    Route::post('auth/changepassword',[ChangePassword::class,'changepassword'])->name('changepassword');
    Route::any('auth/logout',[AuthenticatedSessionController::class,'logout'])->name('logout');
    Route::any('auth/notauthenticated',[AuthenticatedSessionController::class,'notauthenticated'])->name('notauth');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/agents.php';
require __DIR__.'/departurer.php';

