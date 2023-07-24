<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SupplierController;
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
// Route::middleware([UserMiddleware::class])->group(function () {


//     Route::post('/addcart/{id}', [App\Http\Controllers\CartController::class,'addcart'])->name('addcart');
//     Route::get('/shoppingcart/{id}', [App\Http\Controllers\CartController::class, 'shoppingcart'])->name('shoppingcart');
//     Route::get('/increment/{id}', [App\Http\Controllers\CartController::class, 'increment'])->name('increment');
//     Route::get('/decrement/{id}', [App\Http\Controllers\CartController::class, 'decrement'])->name('decrement');
//     Route::get('/delete/{id}', [App\Http\Controllers\CartController::class, 'deletecart'])->name('delete');
//     Route::post('/checkout/{id}', [App\Http\Controllers\CartController::class,'checkout'])->name('checkout');
//     Route::get('customerscreate', [App\Http\Controllers\CustomerController::class, 'customerscreate'])->name('customerscreate');
//     Route::get('customersedit/{id}', [App\Http\Controllers\CustomerController::class, 'customersedit'])->name('customersedit');
//     Route::get('userprofile/{id}', [App\Http\Controllers\CustomerController::class, 'userprofile'])->name('userprofile');
//     Route::put('/profupdate/{id}', [App\Http\Controllers\CustomerController::class, 'userupdate'])->name('profupdate');
//     Route::get('getProcessing', [App\Http\Controllers\OrderController::class, 'getProcessing'])->name('getProcessing');
//     Route::get('/cancelled/{id}', [App\Http\Controllers\CustomerController::class, 'Cancelled'])->name('cancelled');
//     Route::get('/confirmed', function () {
//         return view('transact.confirmed');
//     });
//     Route::get('/success', function () {
//         return view('transact.success');
//     });
// });



// Route::post('/addcart/{id}', [App\Http\Controllers\CartController::class,'addcart'])->name('addcart');
// Route::get('/shoppingcart/{id}', [App\Http\Controllers\CartController::class, 'shoppingcart'])->name('shoppingcart');
// Route::get('/increment/{id}', [App\Http\Controllers\CartController::class, 'increment'])->name('increment');
// Route::get('/decrement/{id}', [App\Http\Controllers\CartController::class, 'decrement'])->name('decrement');
// Route::get('/delete/{id}', [App\Http\Controllers\CartController::class, 'deletecart'])->name('delete');
// Route::post('/checkout/{id}', [App\Http\Controllers\CartController::class,'checkout'])->name('checkout');
// Route::get('customerscreate', [App\Http\Controllers\CustomerController::class, 'customerscreate'])->name('customerscreate');
// Route::get('customersedit/{id}', [App\Http\Controllers\CustomerController::class, 'customersedit'])->name('customersedit');
// Route::get('userprofile/{id}', [App\Http\Controllers\CustomerController::class, 'userprofile'])->name('userprofile');
// Route::put('/profupdate/{id}', [App\Http\Controllers\CustomerController::class, 'userupdate'])->name('profupdate');
// Route::get('getProcessing', [App\Http\Controllers\OrderController::class, 'getProcessing'])->name('getProcessing');
// Route::get('/cancelled/{id}', [App\Http\Controllers\CustomerController::class, 'Cancelled'])->name('cancelled');
// Route::get('/confirmed', function () {
//     return view('transact.confirmed');
// });
// Route::get('/success', function () {
//     return view('transact.success');
// });


// Route::get('/redirect', [App\Http\Controllers\HomeController::class, 'redirect'])->name('redirect');
// Route::resource('items','App\Http\Controllers\ItemController');
// Route::resource('customers','App\Http\Controllers\CustomerController');
// Route::resource('suppliers','App\Http\Controllers\SupplierController');
// Route::resource('shippers','App\Http\Controllers\ShipperController');
// Route::resource('stocks','App\Http\Controllers\StockController');
// Route::resource('categories','App\Http\Controllers\CategoryController');
// Route::resource('paymentmethods','App\Http\Controllers\PaymentMethodController');
// Route::resource('orders','App\Http\Controllers\OrderController');
// Route::get('updatestatus', [App\Http\Controllers\OrderController::class, 'getOrders'])->name('updatestatus');
// Route::get('shippedorders', [App\Http\Controllers\OrderController::class, 'ShippedOrders'])->name('shippedorders');
// Route::get('show', [App\Http\Controllers\OrderController::class, 'show'])->name('show');
// Route::get('/delivered/{id}', [App\Http\Controllers\OrderController::class, 'Delivered'])->name('delivered');
// Route::get('/fordelivery/{id}', [App\Http\Controllers\OrderController::class, 'ForDelivery'])->name('fordelivery');
// Route::get('/shipped/{id}', [App\Http\Controllers\OrderController::class, 'Shipped'])->name('shipped');

Route::get('/redirect', [App\Http\Controllers\HomeController::class, 'redirect'])->name('redirect');
Route::get('/redirectadmin', [App\Http\Controllers\HomeController::class, 'redirectadmin'])->name('redirectadmin');
Route::get('/backadmin', [App\Http\Controllers\HomeController::class, 'backadmin'])->name('backadmin');
Route::get('/', [App\Http\Controllers\ItemController::class, 'getItems']);
Route::get('/search', [App\Http\Controllers\ItemController::class, 'search'])->name('search');
Route::get('/search2', [App\Http\Controllers\ItemController::class, 'search2'])->name('search2');
Route::get('/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category');
Route::get('/success', function () {
    return view('transact.success');
});
Route::get('/check-availability/{itemId}', [\App\Http\Controllers\ItemController::class, 'checkAvailability']);

Route::middleware([AdminMiddleware::class])->group(function () {

    // Route::resource('items','App\Http\Controllers\ItemController'); in api
    Route::view('/items', 'items.index')->name('items.index');

    // Route::resource('customers', 'App\Http\Controllers\CustomerController'); // in api
    Route::view('/customers', 'customers.index')->name('customer.list');
    // Route::resource('suppliers', 'App\Http\Controllers\SupplierController'); in api
    Route::view('/suppliers', 'suppliers.index')->name('suppliers.index');
    // Route::resource('shippers', 'App\Http\Controllers\ShipperController'); // api
    Route::view('shippers', 'shippers.index')->name('shippers.index');
    Route::resource('stocks', 'App\Http\Controllers\StockController');
    Route::resource('categories', 'App\Http\Controllers\CategoryController');
    // Route::resource('paymentmethods', 'App\Http\Controllers\PaymentMethodController');
    Route::view('paymentmethods', 'paymentmethods.index')->name('paymentmethods.index');
    Route::resource('orders', 'App\Http\Controllers\OrderController');
    // Route::view('/orders/list', 'orders.index')->name('orders.index'); in api
    Route::view('updatestatus', 'orders.updatestatus')->name('updatestatus'); //in api
    Route::get('shippedorders', [App\Http\Controllers\OrderController::class, 'ShippedOrders'])->name('shippedorders');
    Route::get('show', [App\Http\Controllers\OrderController::class, 'show'])->name('show');
    //  Route::get('/delivered/{id}', [App\Http\Controllers\OrderController::class, 'Delivered'])->name('delivered'); in api
    Route::get('/fordelivery/{id}', [App\Http\Controllers\OrderController::class, 'ForDelivery'])->name('fordelivery');
    ///Route::get('/shipped/{id}', [App\Http\Controllers\OrderController::class, 'Shipped'])->name('shipped');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::post('/addcart/{id}', [App\Http\Controllers\CartController::class, 'addcart'])->name('addcart');
    Route::get('/shoppingcart/{id}', [App\Http\Controllers\CartController::class, 'shoppingcart'])->name('shoppingcart');
    Route::get('/increment/{id}', [App\Http\Controllers\CartController::class, 'increment'])->name('increment');
    Route::get('/decrement/{id}', [App\Http\Controllers\CartController::class, 'decrement'])->name('decrement');
    Route::get('/delete/{id}', [App\Http\Controllers\CartController::class, 'deletecart'])->name('delete');
    Route::post('/checkout/{id}', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
    Route::get('customerscreate', [App\Http\Controllers\CustomerController::class, 'customerscreate'])->name('customerscreate');
    Route::post('/userstore', [App\Http\Controllers\CustomerController::class, 'userstore'])->name('userstore');
    Route::get('customersedit/{id}', [App\Http\Controllers\CustomerController::class, 'customersedit'])->name('customersedit');
    Route::get('userprofile/{id}', [App\Http\Controllers\CustomerController::class, 'userprofile'])->name('userprofile');
    Route::put('/profupdate/{id}', [App\Http\Controllers\CustomerController::class, 'userupdate'])->name('profupdate');
    Route::get('getProcessing', [App\Http\Controllers\OrderController::class, 'getProcessing'])->name('getProcessing');
    Route::get('/cancelled/{id}', [App\Http\Controllers\CustomerController::class, 'Cancelled'])->name('cancelled');
    Route::get('/confirmed', function () {
        return view('transact.confirmed');
    });

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
