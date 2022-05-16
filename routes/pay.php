<?php

Route::get('pay/createPay/{reference?}', [
    'as' => 'pay.createPay',
    'uses' => 'Admin\PayController@createPay',
]);

Route::get('pay/payAgain/{reference?}', [
    'as' => 'pay.payAgain',
    'uses' => 'Admin\PayController@payAgain',
]);

Route::get('pay/dataOfOrder', [
    'as' => 'pay.dataOfOrder',
    'uses' => 'Admin\PayController@dataOfOrder',
]);

Route::get('pay/dataOfOrderrejected', [
    'as' => 'pay.dataOfOrderrejected',
    'uses' => 'Admin\PayController@dataOfOrderrejected',
]);

Route::get('pay/consultPayment/{reference?}', [
    'as' => 'pay.consultPayment',
    'uses' => 'Admin\PayController@consultPayment',
]);

Route::get('pay/status', [
    'as' => 'pay.status',
    'uses' => 'Admin\PayController@status',
]);

Route::get('pay/updateDataOfPay', [
    'as' => 'pay.updateDataOfPay',
    'uses' => 'Admin\PayController@updateDataOfPay',
]);

Route::get('pay/show', [
    'as' => 'pay.show',
    'uses' => 'Admin\PayController@show',
]);

Route::get('pay/updateOrderStatus', [
    'as' => 'pay.updateOrderStatus',
    'uses' => 'Admin\PayController@updateOrderStatus',
]);

Route::get('pay/showAllOrders', [
    'as' => 'pay.showAllOrders',
    'uses' => 'Admin\PayController@showAllOrders',
]);

Route::get('pay/retryPayment', [
    'as' => 'pay.retryPayment',
    'uses' => 'Admin\PayController@retryPayment',
]);

Route::get('pay/redirection', [
    'as' => 'pay.redirection',
    'uses' => 'Admin\PayController@redirection',
]);
