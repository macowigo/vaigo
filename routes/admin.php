<?php

use App\Http\Controllers\Admin\AgentsController;
use App\Http\Controllers\Admin\CentersController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\StaffsController;
use App\Http\Controllers\Admin\VendorsController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth','role:admin')->group(function(){
    Route::get('/admin/dashboard',[OrdersController::class,'dashboardview'])->name('admindshboard');
    #centers
    Route::get('/admin/addcenter',[CentersController::class,'addcenterview'])->name('addcenter');
    Route::post('registercenter',[CentersController::class,'savecenters'])->name('registercenter');
    Route::get('/admin/centers',[CentersController::class,'centerslist'])->name('centerlist');
    Route::get('/admin/centers_manage',[CentersController::class,'centersmanage'])->name('centemanage');
    Route::delete('/admin/centers_manage/{centerid}',[CentersController::class,'deletecenter'])->name('deletecenter');
    Route::get('/centers_edit/{centerid}',[CentersController::class,'returncenter'])->name('editcenter');
    Route::post('/centers_update/{centerid}',[CentersController::class,'updatecenter'])->name('centerupdate');
    #vendors
    Route::get('/admin/addvendor',[VendorsController::class,'addvendorform'])->name('vendorform');
    Route::post('/admin/addvendor',[VendorsController::class,'registervendor'])->name('addvendor');
    Route::get('/admin/vendors',[VendorsController::class,'vendorslist'])->name('vendors');
    Route::get('/admin/vendors_manage',[VendorsController::class,'vendorsmanage'])->name('vendorsmanage');
    Route::delete('/admin/vendors_manage/{id}',[VendorsController::class,'deletevendor'])->name('deletevendor');
    Route::get('/{id}/vendor_edit',[VendorsController::class,'getvendor'])->name('editvendorview');
    Route::post('/{id}/vendor_edit',[VendorsController::class,'updatevendor'])->name('editvendor');
    #orders domestic
    Route::get('/admin/domestic_today',[OrdersController::class,'domestictoday'])->name('admdomestictoday');
    Route::get('/admin/domestic_pending',[OrdersController::class,'domesticpending'])->name('admdompending');
    Route::get('/admin/domestic_created',[OrdersController::class,'domesticcreated'])->name('admdomcreated');
    Route::get('/admin/domestic_cancelled',[OrdersController::class,'domesticcancelled'])->name('admdomcancelled');
    Route::get('/admin/domestic_deliver',[OrdersController::class,'domesticdeliver'])->name('admdomdeliver');
    Route::get('/admin/domestic_incomplete',[OrdersController::class,'domesticinc'])->name('admdominc');
    Route::get('/admin/domestic_complete',[OrdersController::class,'domesticcomp'])->name('admdomcomp');
    Route::get('/admin/domestic_orders',[OrdersController::class,'domestic'])->name('admdomestic');
    #orders regional
    Route::get('/admin/regional_today',[OrdersController::class,'regonaltoday'])->name('admregionaltoday');
    Route::get('/admin/regional_orders',[OrdersController::class,'regonalall'])->name('admregionalall');
    #staff
    Route::get('/admin/add_user',[StaffsController::class,'addform'])->name('staffform');
    Route::post('/admin/add_user',[StaffsController::class,'addstaff'])->name('staffadd');
    Route::get('/admin/users',[StaffsController::class,'stafflist'])->name('staff');
    Route::get('/admin/manage_users',[StaffsController::class,'usersmanage'])->name('manageusers');
    Route::delete('{id}',[StaffsController::class,'deleteuser'])->name('deleteuser');

    #agent
    Route::get('/vaigo/agents',[StaffsController::class,'vaigoagents'])->name('vaigoagents');
    Route::get('/add/agent_location',[AgentsController::class,'agentlocationform'])->name('locationform');
    Route::get('/admin/agentcenters',[AgentsController::class,'agentlocationlist'])->name('agentlocation');
    Route::post('/admin/addcenter',[AgentsController::class,'addagentlocation'])->name('addagentlocation');
    Route::get('/manage/agentcenter',[AgentsController::class,'centersmanage'])->name('manageagentlocation');

    #customers
    Route::get('/vaigo/addcustomers',[CustomersController::class,'addcustomerform'])->name('addcustomerform');
    Route::post('/vaigo/addcustomers',[CustomersController::class,'addcustomer'])->name('addcustomer');
    Route::get('/vaigo/customers',[CustomersController::class,'customerslist'])->name('customerslist');
    #sms
    Route::get('/sendsms/customers',[CustomersController::class,'customersmsform'])->name('groupsmsform');
    Route::post('/sendsms/customers',[CustomersController::class,'customersendsms'])->name('customersendsms');
    Route::get('/sendsms/individual',[CustomersController::class,'individualsmsform'])->name('individualsmsform');
    Route::post('/sendsms/individual',[CustomersController::class,'individualsendsms'])->name('individualsendsms');

});

