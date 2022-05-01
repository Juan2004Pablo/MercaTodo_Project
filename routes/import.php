<?php

Route::post('products/import/', [
    'as' => 'products.import',
    'uses' => 'Imports\ImportProductController@import',
]);

Route::post('categories/import/', [
    'as' => 'categories.import',
    'uses' => 'Imports\ImportCategoryController@import',
]);

Route::post('roles/import/', [
    'as' => 'roles.import',
    'uses' => 'Imports\ImportRoleController@import',
]);
