<?php

Route::get('pay/createPay/{reference?}', [
    'as' => 'pay.createPay',
    'uses' => 'Admin\AdminPayController@createPay',
]);

Route::get('pay/payAgain/{reference?}', [
    'as' => 'pay.payAgain',
    'uses' => 'Admin\AdminPayController@payAgain',
]);

Route::get('pay/dataOfOrder', [
    'as' => 'pay.dataOfOrder',
    'uses' => 'Admin\AdminPayController@dataOfOrder',
]);

Route::get('pay/dataOfOrderrejected', [
    'as' => 'pay.dataOfOrderrejected',
    'uses' => 'Admin\AdminPayController@dataOfOrderrejected',
]);

Route::get('pay/consultPayment/{reference?}', [
    'as' => 'pay.consultPayment',
    'uses' => 'Admin\AdminPayController@consultPayment',
]);

Route::get('pay/status', [
    'as' => 'pay.status',
    'uses' => 'Admin\AdminPayController@status',
]);

Route::get('pay/updateDataOfPay', [
    'as' => 'pay.updateDataOfPay',
    'uses' => 'Admin\AdminPayController@updateDataOfPay',
]);

Route::get('pay/show', [
    'as' => 'pay.show',
    'uses' => 'Admin\AdminPayController@show',
]);

Route::get('pay/updateOrderStatus', [
    'as' => 'pay.updateOrderStatus',
    'uses' => 'Admin\AdminPayController@updateOrderStatus',
]);

Route::get('pay/showAllOrders', [
    'as' => 'pay.showAllOrders',
    'uses' => 'Admin\AdminPayController@showAllOrders',
]);

Route::get('pay/retryPayment', [
    'as' => 'pay.retryPayment',
    'uses' => 'Admin\AdminPayController@retryPayment',
]);

Route::get('pay/redirection', [
    'as' => 'pay.redirection',
    'uses' => 'Admin\AdminPayController@redirection',
]);
