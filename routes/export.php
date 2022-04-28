<?php

use App\Http\Controllers\ExportProductController;

//Route::get('products/export/', [ExportProductController::class, 'export']);

Route::get('products/export/', [
    'as' => 'products.export',
    'uses' => 'ExportProductController@export',
]);

/*Route::get('pay/payAgain/{reference?}', [
    'as' => 'pay.payAgain',
    'uses' => 'Admin\AdminPayController@payAgain',
]);*/
