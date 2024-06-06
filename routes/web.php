<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\vendorController;
use App\Http\Controllers\customerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(url('/login'));
});

Auth::routes();

Route::get('/index', [HomeController::class, 'index'])->name('home');


// //admin
// Route::get('/restaurant', [adminController::class, 'view_restaurant'])->name('view_restaurant');

Route::get('/getVendorAllData', [vendorController::class, 'allData'])->name('get.vendor.all.data');
Route::post('/getVendorAvailableData', [vendorController::class, 'available'])->name('get.vendor.available.data');
Route::post('/getMenuVendorData', [vendorController::class, 'menu'])->name('get.vendor.menu.data');
Route::post('/updateVendor', [vendorController::class, 'update'])->name('update.vendor');

// restaurant
Route::post('/makeOrder', [customerController::class, 'order'])->name('make.order');
Route::get('/getPoint', [customerController::class, 'point'])->name('get.point');
Route::get('/getoverallS', [customerController::class, 'overallS'])->name('get.overallS');
Route::get('/getTodayS', [customerController::class, 'todayS'])->name('get.todayS');

//customer
Route::post('/getOrderData', [adminController::class, 'orderData'])->name('get.order.data');
Route::post('/changeOrderStatus', [adminController::class, 'changeStatus'])->name('change.status.order');
Route::get('/session', [adminController::class, 'session'])->name('session');
Route::get('/success', [adminController::class, 'success'])->name('success');
Route::get('/cancel', [adminController::class, 'cancel'])->name('cancel');



