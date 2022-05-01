<?php

Route::post('products/import/', [
    'as' => 'products.import',
    'uses' => 'Imports\ImportProductController@import',
]);

Route::post('categories/import/', [
    'as' => 'categories.import',
    'uses' => 'Imports\ImportCategoryController@import',
]);
