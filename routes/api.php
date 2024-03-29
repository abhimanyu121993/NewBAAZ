<?php

use App\Http\Controllers\Admin\RazorpayController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user-login', [AuthController::class, 'userLogin']);

//User Routes
Route::post('show-profile', [UserController::class, 'showProfile']);
Route::post('update-profile', [UserController::class, 'updateProfile']);
Route::post('edit-profile', [UserController::class, 'editProfile']);
Route::post('edit-update-profile', [UserController::class, 'editUpdateProfile']);


//Home Routes
Route::post('fetch-brand', [HomeController::class, 'brand']);
Route::post('fetch-brand-model', [HomeController::class, 'brandModel']);
Route::post('fetch-fuel-type', [HomeController::class, 'fuelType']);
Route::post('fetch-category', [HomeController::class, 'category']);
Route::post('fetch-services', [HomeController::class, 'services']);
Route::post('fetch-newservices', [HomeController::class, 'newservices']);
Route::post('user-vehicle-map', [UserController::class, 'userVehicleMap']);
Route::post('fetch-vehicles', [UserController::class, 'userVehicles']);
Route::post('fetch-user-address', [UserController::class, 'fetchUserAddress']);
Route::post('update-user-address', [UserController::class, 'updateUserAddress']);

Route::post('fetch-home-slider', [HomeController::class, 'homeSlider']);
Route::post('fetch-offer-banner', [HomeController::class, 'offerBanner']);
Route::post('order-placed', [OrderController::class, 'orderPlaced']);
Route::post('order-history', [OrderController::class, 'orderHistory']);
Route::post('show-cart',[CartController::class,'showCart']);
Route::post('add-cart',[CartController::class,'addToCart']);
Route::post('remove-cart-item',[CartController::class,'removeCartItems']);

Route::post('fetch-slot', [HomeController::class, 'fetchSlot']);
Route::post('single-user-order-history', [OrderController::class, 'singleUserOrderHistory']);
Route::post('user-invoice-view', [OrderController::class, 'userInvoiceLink']);
// Route::post('razor-pay-callback', [OrderController::class, 'razorCallBack']);
// Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');


Route::post('create-order', [OrderController::class, 'create_order']);



//Testing Purpose
Route::post('register-testuser', [UserController::class, 'registerTestUser']);
Route::get('fetch-testuser/{id}', [UserController::class, 'fetchTestUser']);
Route::post('login-testuser', [UserController::class, 'loginTestUser']);



Route::get('footer-slider', [ApIController::class, 'Footer_Slider']);
