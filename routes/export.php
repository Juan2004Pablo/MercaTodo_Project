<?php

Route::get('products/export/', [
    'as' => 'products.export',
    'uses' => 'ExportProductController@export',
]);

Route::get('users/export/', [
    'as' => 'users.export',
    'uses' => 'ExportUserController@export',
]);
