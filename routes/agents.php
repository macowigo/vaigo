<?php

use App\Http\Controllers\Agents\OrdersController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth','role:agent')->group(function(){
    Route::get('agent/dashboard',[OrdersController::class,'dashboardview'])->name('agentdshboard');
    Route::get('agent/createorder',[OrdersController::class,'createorderview'])->name('agentcreateorderview');
    Route::get('agent/todayorders',[OrdersController::class,'todayregionalorders'])->name('agenttodayorders');
    Route::post('agent/createorder',[OrdersController::class,'createregionalorder'])->name('createorderregional');
    Route::get('agent/monthlyorders',[OrdersController::class,'monthlyregionalorders'])->name('agentmonthlyorders');
    
});

