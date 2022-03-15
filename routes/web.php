<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;

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

//Route::put('/admin/crudUsers/{user}', [UserController::class, 'update']);

Route::resource('users', UserController::class)->middleware(['auth', 'auth.admin']);

Route::get('admin/users/{user}/toggle', [UserController::class, 'toggle'])->middleware(['auth', 'auth.admin'])->name('admin.users.toggle');

Route::resource('products', ProductController::class)->middleware(['auth', 'auth.admin']);

Route::get('admin/products/{product}/toggle', [ProductController::class, 'toggle'])->middleware(['auth'])->name('admin.products.toggle');