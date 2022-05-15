<?php

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

Route::middleware('auth:sanctum')->get('api/user', function (Request $request) {
    return $request->user();
});

Route::post('api/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);

Route::post('api/register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);

Route::post('api/logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);

Route::get('api/products/index', [
    'as' => 'api.products.index',
    'uses' => 'Api\ApiProductController@index',
]);

Route::get('api/product/show/{product}', [
    'as' => 'api.product.show',
    'uses' => 'Api\ApiProductController@show',
]);

Route::post('api/product/store', [
    'as' => 'api.product.store',
    'uses' => 'Api\ApiProductController@store',
]);

Route::put('api/product/update/{product}', [
    'as' => 'api.product.update',
    'uses' => 'Api\ApiProductController@update',
]);

Route::get('api/product/delete/{product}', [
    'as' => 'api.product.delete',
    'uses' => 'Api\ApiProductController@destroy',
]);
