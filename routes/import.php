<?php

Route::post('products/import/', [
    'as' => 'products.import',
    'uses' => 'Imports\ImportProductController@import',
]);
