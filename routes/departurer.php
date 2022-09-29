<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeparturerOrderController;
use App\Http\Controllers\Orders\DeparturerRegionalOrders;

Route::middleware('auth','role:depaturer')->group(function(){
    #domestic
    Route::get('/depaturer/dashboard',[DeparturerOrderController::class,'dashboardview'])->name('dptdashboard');
    Route::get('/depaturer/new_orders',[DeparturerOrderController::class,'neworder'])->name('departurenew');
    Route::get('/{oderid}/asignrider',[DeparturerOrderController::class,'deptview'])->name('departurerview');
    Route::post('/{oderid}/asignrider',[DeparturerOrderController::class,'asignrider'])->name('riderasign');
    Route::get('/depaturer/cancelled_orders',[DeparturerOrderController::class,'cancelledtorder'])->name('domcancelled');
    Route::get('/depaturer/dpt_orders',[DeparturerOrderController::class,'deptorder'])->name('departurered');
    Route::get('/depaturer/inc_orders',[DeparturerOrderController::class,'incompleteorders'])->name('incdptdm');
    Route::get('/depaturer/orders_complete',[DeparturerOrderController::class,'completeorders'])->name('dmcomplete');
    Route::get('/depaturer/orders',[DeparturerOrderController::class,'domesticallorders'])->name('dmalldpt');
    Route::get('/manage/dpt_orders',[DeparturerOrderController::class,'managedeptorder'])->name('dptmanage');
    Route::post('/manage/{oderid}',[DeparturerOrderController::class,'cancelorder'])->name('incdomestic');
    Route::post('/complete/{oderid}',[DeparturerOrderController::class,'completeorder'])->name('compdomestic');
    #regional
    Route::get('/depaturer/regionalneworders',[DeparturerRegionalOrders::class,'neworder'])->name('regionalnew');
});
