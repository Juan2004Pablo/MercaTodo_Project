<?php

return [
    'product_report' =>[
        'values' => ['Id', 'Name', 'Description', 'Category', 'Price', 'Quantity', 'Created at', 'Updated at'],
    ],

    'daily_sales_report' => [
        'values' => ['Date', 'Quantity', 'Product name', 'Total'],
    ],

    'weekly_sales_report' => [
        'values' => ['Date', 'Quantity', 'Product name', 'Total', 'Growth', '% vs. previous week'],
    ],

    'monthly_sales_report' => [
        'values' => ['Date', 'Quantity', 'Product name', 'Total', 'Growth', '% vs. previous month'],
    ],
];
