<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AuthUserController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\FuelTypeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\OrderHistoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\WorkshopController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Middleware\AuthLogin;
use Illuminate\Support\Facades\Artisan;


// Admin Routes

Route::get('/',[AdminController::class,'admin'])->name('admin');
Route::post('adminlogin',[AdminController::class,'login'])->name('login');

Route::group(['prefix'=>'Backend','as'=>'Backend.'],function(){
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('logout',[AdminController::class,'logout'])->name('logout');

    Route::resource('brand',BrandController::class);
    Route::resource('model',ModelController::class);
    Route::resource('fueltype',FuelTypeController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('service',ServiceController::class);
    Route::resource('homeslider',HomeSliderController::class);
    Route::resource('orderhistory',OrderHistoryController::class);
    Route::resource('role',RoleController::class);
    Route::resource('country',CountryController::class);
    Route::resource('zone',ZoneController::class);
    Route::resource('area',AreaController::class);
    Route::resource('city',CityController::class);
    Route::resource('authuser',AuthUserController::class);
    Route::resource('workshop',WorkshopController::class);
    Route::resource('permission',PermissionController::class);
    Route::get('user-permission',[PermissionController::class,'userPermission'])->name('userPermission');
    Route::post('assign-permission',[PermissionController::class,'assignPermission'])->name('assignPermission');
    Route::get('roles-has-permission',[PermissionController::class,'roleHasPermission'])->name('roleHasPermission');
    Route::get('view-role/{id}',[RoleController::class,'viewRole'])->name('viewRole');

    Route::get('customer-list',[AdminController::class,'userList'])->name('customerList');
    //Route::post('assign-role',[RoleController::class,'assignUserRole'])->name('assignUserRole');

    //Orders
    Route::get('pending-orders',[OrderHistoryController::class,'pendingOrders'])->name('pendingOrders');
    Route::get('confirmed-orders',[OrderHistoryController::class,'confirmedOrders'])->name('confirmedOrders');
});


Route::get('/optimize', function(){
    Artisan::call('optimize');
});
Route::get('/optimize-clear', function(){
    Artisan::call('optimize:clear');
});
