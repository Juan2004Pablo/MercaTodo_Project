<?php

Route::get('cart/show', [
    'as' => 'cart.show',
    'uses' => 'Admin\AdminCartController@show'
])->middleware('auth');

Route::get('cart/add/{id}', [
    'as' => 'cart.add',
    'uses' => 'Admin\AdminCartController@add'
])->middleware('auth');

Route::get('cart/delete/{id}', [
    'as' => 'cart.delete',
    'uses' => 'Admin\AdminCartController@delete'
]);

Route::get('cart/trash', [
    'as' => 'cart.trash',
    'uses' => 'Admin\AdminCartController@trash'
]);

Route::get('cart/update/{id}/{quantity?}', [
    'as' => 'cart.update',
    'uses' => 'Admin\AdminCartController@update'
]);

Route::post('cart/datesReceive', [
    'as' => 'cart.Datesreceive',
    'uses' => 'Admin\AdminCartController@Datesreceive'
]);