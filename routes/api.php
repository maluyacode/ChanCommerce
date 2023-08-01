<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cart/{id}/count', [CartController::class, 'countItemInCart']);

Route::get('/items', [ItemController::class, 'index']);
Route::get('/item/create', [ItemController::class, 'create']);
Route::post('/item/storeMedia', [ItemController::class, 'storeMedia'])->name('items.storeMedia');
Route::post('/item/store', [ItemController::class, 'store']);
Route::get('/item/{id}/edit', [ItemController::class, 'edit']);
Route::put('/item/{id}/update', [ItemController::class, 'update']);
Route::delete('/item/{id}/delete', [ItemController::class, 'destroy']);
Route::get('/item/media/{id}', [ItemController::class, 'getItemMedia']);
Route::post('/item/import', [ItemController::class, 'import']);


Route::post('/category/store', [CategoryController::class, 'store']);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit']);
Route::put('/category/{id}/update', [CategoryController::class, 'update']);
Route::delete('/category/{id}/delete', [CategoryController::class, 'destroy']);


Route::get('/get-orders', [OrderController::class, 'getOrders']);
Route::get('/update-to-shipped/{id}', [OrderController::class, 'Shipped']);
Route::get('/update-to-delivered/{id}', [OrderController::class, 'Delivered']);
Route::get('/update-to-for-delivery/{id}', [OrderController::class, 'ForDelivery']);
Route::get('/update-to-cancelled/{id}', [OrderController::class, 'Cancel']);

Route::resource('customers', CustomerController::class);
Route::post('/customers/storeMedia', [CustomerController::class, 'storeMedia'])->name('customers.storeMedia');
Route::get('/customer/media/{id}', [CustomerController::class, 'getCustomerMedia']);
Route::post('/customer/import', [CustomerController::class, 'import']);

Route::get('/payment-methods', [PaymentMethodController::class, 'index']);
Route::post('/payment-methods/store', [PaymentMethodController::class, 'store']);
Route::get('/payment-methods/{id}/edit', [PaymentMethodController::class, 'edit']);
Route::put('/payment-methods/{id}/update', [PaymentMethodController::class, 'update']);
Route::delete('/payment-methods/{id}/delete', [PaymentMethodController::class, 'destroy']);


Route::get('/shippers', [ShipperController::class, 'index']);
Route::post('/shippers/store', [ShipperController::class, 'store']);
Route::post('/shippers/storeMedia', [ShipperController::class, 'storeMedia'])->name('shippers.storeMedia');
Route::get('/shippers/{id}/edit', [ShipperController::class, 'edit']);
Route::put('/shippers/{id}/update', [ShipperController::class, 'update']);
Route::delete('/shippers/{id}/delete', [ShipperController::class, 'destroy']);
Route::get('/shipper/media/{id}', [ShipperController::class, 'getShipperMedia']);
Route::post('/shipper/import', [ShipperController::class, 'import']);

Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers', [SupplierController::class, 'store']);
Route::post('/suppliers/storeMedia', [SupplierController::class, 'storeMedia'])->name('suppliers.storeMedia');
Route::get('/suppliers/{id}/edit', [SupplierController::class, 'edit']);
Route::put('/suppliers/{id}/update', [SupplierController::class, 'update']);
Route::delete('/suppliers/{id}/delete', [SupplierController::class, 'destroy']);
Route::get('/supplier/media/{id}', [SupplierController::class, 'getSupplierMedia']);
Route::post('/supplier/import', [SupplierController::class, 'import']);


Route::get('/item/stocks', [StockController::class, 'index']);
Route::put('/item/update/{id}/stock', [StockController::class, 'update']);

Route::get('/product/sold', [ItemController::class, 'productSold']);
