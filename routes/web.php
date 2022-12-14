<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AuthUserController;
use App\Http\Controllers\Admin\BatteryTypeController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\FuelTypeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DemandingServiceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\JobcardController;
use App\Http\Controllers\Admin\ModelServiceMapController;
use App\Http\Controllers\Admin\OrderHistoryController;
use App\Http\Controllers\Admin\OtherProductController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RazorpayController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceChargeController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\WorkshopController;
use App\Http\Controllers\Admin\WorkshopOrderController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Middleware\AuthLogin;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FooterSliderController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Artisan;


// Admin Routes

Route::get('/',[AdminController::class,'admin'])->name('admin');
Route::post('adminlogin',[AdminController::class,'login'])->name('login');

Route::group(['prefix'=>'Backend','as'=>'Backend.', 'middleware' => 'auth'],function(){
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

    Route::resource('demandingservice',DemandingServiceController::class);
    Route::resource('servicecharge',ServiceChargeController::class);
    Route::resource('otherproduct',OtherProductController::class);

    Route::post('allot-workshop',[WorkshopController::class,'allotWorkshop'])->name('allotWorkshop');
    Route::resource('modelservicemap',ModelServiceMapController::class);

    Route::get('edit-model/{id}', [ModelServiceMapController::class, 'Edit_model'])->name('edit-model');
     Route::Post('update-model/{id}', [ModelServiceMapController::class, 'Updatedit_model'])->name('update-model');

    Route::resource('batterytype',BatteryTypeController::class);

    Route::resource('slot',SlotController::class);
    Route::resource('jobcard',JobcardController::class);
    // Route::get('jobcard/{id}',[OrderHistoryController::class,'jobcard'])->name('jobcard');
    // Route::post('order-jobcard',[OrderHistoryController::class,'orderJobcard'])->name('orderJobcard');

    Route::get('order-service-detail/{id}',[WorkshopOrderController::class,'orderServiceDetail'])->name('orderServiceDetail');

    Route::post('addworkshoporder',[WorkshopOrderController::class, 'addWorkshopOrder'])->name('addWorkshopOrder');
    Route::post('addworkshoplabour',[WorkshopOrderController::class, 'addWorkshopLabour'])->name('addWorkshopLabour');
    Route::post('addworkshopspare',[WorkshopOrderController::class, 'addWorkshopSpare'])->name('addWorkshopSpare');

    Route::get('del-service/{id}',[WorkshopOrderController::class, 'delService'])->name('delService');
    Route::get('edp-work',[WorkshopOrderController::class, 'edpWork'])->name('edpWork');
    Route::get('invoice/{id}',[WorkshopOrderController::class, 'invoice'])->name('invoice');
    Route::get('baaz-invoice/{id}',[WorkshopOrderController::class, 'baazInvoice'])->name('baazInvoice');
    Route::get('change-password',[AuthUserController::class, 'changePassword'])->name('authuser.changepassword');
    Route::post('update-profile',[AuthUserController::class, 'updateProfile'])->name('authuser.updateProfile');
    Route::post('update-password',[AuthUserController::class, 'updatePassword'])->name('authuser.updatePassword');

    Route::get('custom-Notification',[NotificationController::class, 'Notification'])->name('custom-Notification');
    Route::Post('add-notification',[NotificationController::class, 'Add_Notification'])->name('add-notification');
    Route::get('custom-Notification',[NotificationController::class, 'Notification_list'])->name('custom-Notification');
    Route::get('send-notification', [NotificationController::class, 'SendNotification'])->name('send-notification');
    Route::get('/edit-notification/{id}', [NotificationController::class, 'Edit_Notification'])->name('edit-notification ');
    Route::post('/update-notifation/{id}',[NotificationController::class, 'Update_Notification'])->name('update-notifation');
    Route::get('/delete/{id}', [NotificationController::class, 'delete'])->name('delete');

    Route::post('/update-order-remark',[OrderHistoryController::class, 'updateOrderRemark'])->name('updateOrderRemark');

    Route::resource('slider',FooterSliderController::class);
});



// Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name('payment');
// Route::get('opayment', [OrderController::class, 'create_order']);

Route::get('/optimize', function(){
    Artisan::call('optimize');
});
Route::get('/optimize-clear', function(){
    Artisan::call('optimize:clear');
});
