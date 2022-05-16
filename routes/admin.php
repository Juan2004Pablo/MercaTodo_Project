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

Route::resource('/product', 'ShowProductController')->names('product');

Route::resource('admin/order', 'Admin\OrderController')->names('admin.order');

Route::get('order-detail', [
    'as' => 'order-detail',
    'uses' => 'Admin\CartController@orderDetail',
]);
