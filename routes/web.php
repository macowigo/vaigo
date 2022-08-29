<?php
use App\Http\Controllers\Auth\RedirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\DeparturerOrderController;

Route::get('/', function () {return view('welcome');});
Route::get('/redirect',[RedirectController::class,'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
//center
Route::middleware('auth')->group(function(){
    Route::get('/center/dashboard',function(){
        return view('centers.dashboard');
    })->name('centerdashboard');
    Route::resource('orders',OrdersController::class);
    Route::post('/orders/create',[OrdersController::class,'calculatecost'])->name('calculate');
    Route::get('/center/domestic_neworders',[OrdersController::class,'domesticneworder'])->name('domesticnew');
    Route::post('/create/{oderid}',[OrdersController::class,'acceptorder'])->name('acceptdomestic');
    Route::post('/cancell/{oderid}',[OrdersController::class,'cancelorder'])->name('canceldomestic');
    Route::get('/centerorder/domestic',[OrdersController::class,'domestic'])->name('domesticorder');
    Route::get('/centerorder/regional',[OrdersController::class,'regional'])->name('regionalorder');
    Route::get('/centerorder/international',[OrdersController::class,'international'])->name('internationalorder');
});
#departurer
Route::middleware('auth')->group(function(){
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
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
