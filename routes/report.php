<?php

Route::get('report/index', [
    'as' => 'report.index',
    'uses' => 'Report\ReportController@index',
]);

Route::get('products/report/index', [
    'as' => 'products.report.index',
    'uses' => 'Report\ProductsReportController@index',
]);

Route::post('products/report/generate', [
    'as' => 'products.report.generate',
    'uses' => 'Report\ProductsReportController@generate',
]);

Route::get('daily/sales/report/index', [
    'as' => 'dailySales.report.index',
    'uses' => 'Report\DailySalesReportController@index',
]);

Route::post('dailySales/report/generate', [
    'as' => 'dailySales.report.generate',
    'uses' => 'Report\DailySalesReportController@generate',
]);

Route::get('salesByDays/report/index', [
    'as' => 'salesByDays.report.index',
    'uses' => 'Report\salesByDaysReportController@index',
]);

Route::post('salesByDays/report/generate', [
    'as' => 'salesByDays.report.generate',
    'uses' => 'Report\salesByDaysReportController@generate',
]);

Route::get('monthly/sales/report/index', [
    'as' => 'monthlySales.report.index',
    'uses' => 'Report\MonthlySalesReportController@index',
]);

Route::post('monthlySales/report/generate', [
    'as' => 'monthlySales.report.generate',
    'uses' => 'Report\MonthlySalesReportController@generate',
]);

Route::get('users/report/index', [
    'as' => 'users.report.index',
    'uses' => 'Report\UsersReportController@index',
]);

Route::post('users/report/generate', [
    'as' => 'users.report.generate',
    'uses' => 'Report\UsersReportController@generate',
]);
