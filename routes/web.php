<?php
use App\Http\Controllers\Auth\RedirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\DeparturerOrderController;
use App\Http\Controllers\Orders\DomesticOrder;

Route::get('/', function () {return view('welcome');});
Route::get('/redirect',[RedirectController::class,'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
//center

Route::middleware('auth','role:center')->group(function(){
    Route::get('/center/dashboard',[DomesticOrder::class,'dashboardview'])->name('centerdashboard');
    Route::resource('orders',OrdersController::class);
    Route::post('/orders/calculate',[DomesticOrder::class,'calculatecost'])->name('calculate');
    Route::post('/orders/create',[DomesticOrder::class,'createorder'])->name('createdomestic');
    Route::get('/center/domestic_neworders',[DomesticOrder::class,'domesticneworder'])->name('domesticnew');
    Route::get('/center/domestic_today',[DomesticOrder::class,'domestictoday'])->name('domestictoday');
    Route::post('/create/{oderid}',[DomesticOrder::class,'acceptorder'])->name('acceptdomestic');
    Route::post('/cancell/{oderid}',[DomesticOrder::class,'cancelorder'])->name('canceldomestic');
    Route::get('/centerorder/domestic',[DomesticOrder::class,'domestic'])->name('domesticorder');
    Route::get('/centerorder/regional',[OrdersController::class,'regional'])->name('regionalorder');
    Route::get('/centerorder/international',[OrdersController::class,'international'])->name('internationalorder');
});
#departurer
Route::middleware('auth','role:depaturer')->group(function(){
    Route::get('/depaturer/dashboard',function(){
        return view('departurer.dashboard');
    })->name('dptdashboard');
    Route::get('/depaturer/new_orders',[DeparturerOrderController::class,'neworder'])->name('departurenew');
    Route::get('/{oderid}/asignrider',[DeparturerOrderController::class,'deptview'])->name('departurerview');
    Route::post('/{oderid}/asignrider',[DeparturerOrderController::class,'asignrider'])->name('riderasign');
    Route::get('/depaturer/dpt_orders',[DeparturerOrderController::class,'deptorder'])->name('departurered');
    Route::get('/depaturer/inc_orders',[DeparturerOrderController::class,'incompleteorders'])->name('incdptdm');
    Route::get('/depaturer/orders_complete',[DeparturerOrderController::class,'completeorders'])->name('dmcomplete');
    Route::get('/depaturer/orders',[DeparturerOrderController::class,'domesticallorders'])->name('dmalldpt');
    Route::get('/manage/dpt_orders',[DeparturerOrderController::class,'managedeptorder'])->name('dptmanage');
    Route::post('/manage/{oderid}',[DeparturerOrderController::class,'cancelorder'])->name('incdomestic');
    Route::post('/complete/{oderid}',[DeparturerOrderController::class,'completeorder'])->name('compdomestic');
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
