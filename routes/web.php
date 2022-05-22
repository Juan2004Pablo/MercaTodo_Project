<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home')->middleware('verified')
    ->middleware('auth');

Route::resource('role', 'RoleController')->names('role');

Route::resource('user', 'UserController')->names('user')->middleware('disable');

Route::get('user/toggle/{user}', ['as' => 'user.toggle', 'uses' => 'UserController@toggle']);

Route::get('cancel/{ruta}', function ($ruta) {
    return redirect()->route($ruta)->with('cancel', 'Action Canceled!');
})->name('cancel');

Route::get('markAsRead', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');
