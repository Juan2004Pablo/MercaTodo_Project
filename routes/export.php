<?php

Route::get('users/export/', [
    'as' => 'users.export',
    'uses' => 'ExportUserController@export',
]);

Route::get('roles/export/', [
    'as' => 'roles.export',
    'uses' => 'ExportRoleController@export',
]);

Route::get('products/export/', [
    'as' => 'products.export',
    'uses' => 'ExportProductController@export',
]);

Route::get('categories/export/', [
    'as' => 'categories.export',
    'uses' => 'ExportCategoryController@export',
]);
