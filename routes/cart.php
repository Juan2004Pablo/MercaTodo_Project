<?php

Route::get('cart/show', [
    'as' => 'cart.show',
    'uses' => 'Admin\CartController@show',
])->middleware('auth');

Route::get('cart/add/{id}', [
    'as' => 'cart.add',
    'uses' => 'Admin\CartController@add',
])->middleware('auth');

Route::get('cart/delete/{id}', [
    'as' => 'cart.delete',
    'uses' => 'Admin\CartController@delete',
]);

Route::get('cart/trash', [
    'as' => 'cart.trash',
    'uses' => 'Admin\CartController@trash',
]);

Route::get('cart/update/{id}/{quantity?}', [
    'as' => 'cart.update',
    'uses' => 'Admin\CartController@update',
]);

Route::post('cart/datesReceive', [
    'as' => 'cart.Datesreceive',
    'uses' => 'Admin\CartController@Datesreceive',
]);
