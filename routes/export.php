<?php

Route::get('users/export/', [
    'as' => 'users.export',
    'uses' => 'Exports\ExportUserController@export',
]);

Route::get('roles/export/', [
    'as' => 'roles.export',
    'uses' => 'Exports\ExportRoleController@export',
]);

Route::get('products/export/', [
    'as' => 'products.export',
    'uses' => 'Exports\ExportProductController@export',
]);

Route::get('categories/export/', [
    'as' => 'categories.export',
    'uses' => 'Exports\ExportCategoryController@export',
]);
