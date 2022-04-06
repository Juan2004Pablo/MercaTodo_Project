<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\DetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('admin', [AdminController::class, 'index'])
    ->middleware(['auth.admin', 'auth'])
    ->name('admin.index');

Route::resource('users', UserController::class)->middleware(['auth', 'auth.admin']);

Route::get('admin/users/{user}/toggle', [UserController::class, 'toggle'])->middleware(['auth', 'auth.admin'])->name('admin.users.toggle');

Route::resource('admin/category', CategoryController::class)->name('admin.category')->middleware('auth');

Route::resource('products', ProductController::class)->middleware(['auth', 'auth.admin']);

Route::get('cancel/{ruta}', function ($ruta) {
    return redirect()->route($ruta)->with('cancel', 'Action Canceled!');
})->name('cancel');

Route::resource('/product', ShowProductController::class)->name('product');

Route::get('admin/products/{product}/toggle', [ProductController::class, 'toggle'])->middleware(['auth', 'product.disable'])->name('admin.products.toggle');

Route::resource('admin/order', OrderController::class)->name('admin.order');

Route::resource('admin/detail', DetailController::class)->name('admin.detail');

Route::get('cart/show', [CartController::class, 'show'])->name('cart.show')->middleware('auth');

Route::get('cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');

Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

Route::get('cart/trash', [CartController::class, 'trash'])->name('cart.trash');

Route::get('cart/update/{id}/{quantity?}', [CartController::class, 'update'])->name('cart.update');

Route::get('order-detail', [DetailController::class, 'update'])->name('order.detail');

Route::post('cart/datesReceive', [CartController::class, 'datesReceive'])->name('cart.Datesreceive');

Route::get('pay/createPay/{reference?}', [PayController::class, 'createPay'])->name('pay.createPay');

Route::get('pay/payAgain/{reference?}', [PayController::class, 'payAgain'])->name('pay.payAgain');

Route::get('pay/dataOfOrder', [PayController::class, 'dataOfOrder'])->name('pay.dataOfOrder');

Route::get('pay/dataOfOrderrejected', [PayController::class, 'dataOfOrderrejected'])->name('pay.dataOfOrderrejected');

Route::get('pay/consultPayment/{reference?}', [PayController::class, 'consultPayment'])->name('pay.consultPayment');

Route::get('pay/status', [PayController::class, 'status'])->name('pay.status');

Route::get('pay/updateDataOfPay', [PayController::class, 'updateDataOfPay'])->name('pay.updateDataOfPay');

Route::get('pay/show', [PayController::class, 'show'])->name('pay.show');

Route::get('pay/updateOrderStatus', [PayController::class, 'updateOrderStatus'])->name('pay.updateOrderStatus');

Route::get('pay/showAllOrders', [PayController::class, 'showAllOrders'])->name('pay.showAllOrders');

Route::get('pay/retryPayment', [PayController::class, 'retryPayment'])->name('pay.retryPayment');

Route::get('pay/redirection', [PayController::class, 'redirection'])->name('pay.redirection');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');