<?php

use App\Http\Controllers\Admin\CentersController;
use App\Http\Controllers\Admin\VendorsController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth')->group(function(){
    Route::get('/admin/dashboard',function(){
        return view('admin.dashboard');
    })->name('admindshboard');
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
});

