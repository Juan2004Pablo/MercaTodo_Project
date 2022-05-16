<?php

return[
    'index' => [
        'title' => [
            'title' => 'Reports',
            'type' => 'Type of reports',
            'products_report' => 'Products report',
            'daily_sales_report' => 'Daily sales report',
            'sales_by_days_report' => 'Sales by days report',
            'monthly_sales_report' => 'Monthly sales report',
            'users_report' => 'Users report',
            'description_of_report' => 'Description of report',
            'fields_of_report' => 'Fields of report',
        ],
        'description' => [
            'description_products' => 'This report contains information about the products available',
            'description_daily' => 'This report contains information about daily sales',
            'description_salesdays' => 'This report contains information on sales by days',
            'description_monthly' => 'This report contains information on monthly sales',
            'description_users' => 'This report contains information about the users available',
        ],
        'fields' => [
            'title' => 'Fields...',
        ],
    ],
    'index_report' => [
        'title' => [
            'download' => 'Download report',
            'down' => 'Download',
        ],
        'fields' => [
            'initial' => 'Initial date',
            'end' => 'End date',
        ],
    ],
    'daily_sales_report' => [
        'title' => [
            'title' => 'Daily sales report',
        ],
        'fields' => [
            'date' => 'Date',
            'code' => 'Code',
            'status' => 'Status',
            'id' => '#',
            'total' => 'Total',
            'product_name' => 'Product name',
            'accumulated' => 'Accumulated',
        ],
    ],
    'monthly_sales_report' => [
        'title' => [
            'title' => 'Monthly sales report',
        ],
        'fields' => [
            'date' => 'Date',
            'quantity' => 'Quantity',
            'id' => '#',
            'total' => 'Total',
            'growth' => 'Growth',
            'previous' => '% vs. previous month',
        ],
    ],
    'products_report' => [
        'title' => [
            'title' => 'products report',
        ],
        'fields' => [
            'name' => 'Name',
            'date' => 'Created at',
            'quantity' => 'Quantity',
            'id' => '#',
            'price' => 'Price',
            'category' => 'Category',
            'description' => 'Description',
        ],
    ],
    'sales_by_days_report' => [
        'title' => [
            'title' => 'Sales by days report',
        ],
        'fields' => [
            'day' => 'Day',
            'date' => 'Date',
            'code' => 'Code',
            'id' => '#',
            'status' => 'Status',
            'total' => 'Total',
            'day_of_week' => 'Day of week',
            'accumulated' => 'Accumulated',
            'growth' => 'Growth',
            'previus' => '% vs. previous day',
        ],
    ],
    'users_report' => [
        'title' => [
            'title' => 'Users report',
        ],
        'fields' => [
            'role' => 'Role',
            'name' => 'Name',
            'surname' => 'Surname',
            'id' => '#',
            'identification' => 'Identification',
            'address' => 'Address',
            'email' => 'Email',
            'phone' => 'Phone',
            'date' => 'Created at',
        ],
    ],
];
