<?php

Route::get('/admin', function () {
    return view('plantilla.admin');
})->name('admin');

Route::resource('admin/category', 'Admin\CategoryController')
    ->names('admin.category')->middleware('auth');

Route::resource('admin/product', 'Admin\ProductController')->names('admin.product')
    ->middleware('auth');

Route::post('restoreproduct/{id}', ['as' => 'admin.product.restore', 'uses' => 'Admin\ProductController@restore']);

Route::post('restorecategory/{id}', ['as' => 'admin.category.restore', 'uses' => 'Admin\CategoryController@restore']);

Route::get('product/{product}', ['as' => 'product', 'uses' => 'ShowProductController@show']);

Route::get('admin/order', ['as' => 'admin.order', 'uses' => 'Admin\OrderController@index']);

Route::get('order-detail', [
    'as' => 'order-detail',
    'uses' => 'Admin\CartController@orderDetail',
]);
