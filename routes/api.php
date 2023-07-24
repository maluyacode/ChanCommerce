<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;

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

Route::get('/items', [ItemController::class, 'index']);
Route::get('/item/create', [ItemController::class, 'create']);
Route::post('/item/storeMedia', [ItemController::class, 'storeMedia'])->name('items.storeMedia');
Route::post('/item/store', [ItemController::class, 'store']);
Route::get('/item/{id}/edit', [ItemController::class, 'edit']);
Route::put('/item/{id}/update', [ItemController::class, 'update']);
Route::delete('/item/{id}/delete', [ItemController::class, 'destroy']);


Route::post('/category/store', [CategoryController::class, 'store']);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit']);
Route::put('/category/{id}/update', [CategoryController::class, 'update']);
Route::delete('/category/{id}/delete', [CategoryController::class, 'destroy']);


Route::get('/get-orders', [OrderController::class, 'getOrders']);
Route::get('/update-to-shipped/{id}', [OrderController::class, 'Shipped']);
Route::get('/update-to-delivered/{id}', [OrderController::class, 'Delivered']);
Route::get('/update-to-for-delivery/{id}', [OrderController::class, 'ForDelivery']);
Route::get('/update-to-cancelled/{id}', [OrderController::class, 'Cancel']);

Route::get('/customers/lists', [CustomerController::class, 'index']);
