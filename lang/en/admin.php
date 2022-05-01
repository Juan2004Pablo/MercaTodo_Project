<?php

return [
    'products' => [
        'fields' => [
            'id' => 'Id',
            'name' => 'Name',
            'price' => 'Price',
            'category' => 'Category',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'image' => 'Image',
            'description' => 'Description',
            'disable' => 'Disable',
            'created_at' => 'Created At',
        ],
        'titles' => [
            'title' => 'Products',
            'create' => 'Create a product',
            'adminProduct' => 'Administration of products',
            'update' => 'Update a product',
            'dates' => 'Product dates',
            'pricing' => 'Pricing Section',
            'descriptions' => 'Product descriptions',
            'addImage' => 'Add image',
            'cop' => 'COP',
        ],
        'options' => [
            'cancel' => 'Cancel',
            'show' => 'Show',
            'update' => 'Update',
        ],
    ],
    'categories' => [
        'fields' => [
            'id' => 'Id',
            'name' => 'Name',
            'description' => 'Description',
        ],
        'titles' => [
            'title' => 'Categories',
            'section' => 'Section of categories',
            'create' => 'Create',
            'adminCategory' => 'Administration of categories',
        ],
        'options' => [
            'cancel' => 'Cancel',
            'show' => 'Show',
            'update' => 'Update',
            'activate' => 'Activate',
            'inactive' => 'Inactive',
        ],
    ],
    'details' =>[
        'fields' => [
            'id' => 'N',
            'quantity' => 'Quantity',
            'product' => 'product',
            'price' => 'Price',
            'subtotal' => 'Subtotal',
        ],
    ],
    'orders' =>[
        'fields' => [
            'code' => 'Code',
            'status' => 'Status',
        ],
        'titles' => [
            'title' => 'Orders',
            'dates' => 'Order dates',
            'section' => 'Section of orders',
            'admin' => 'Administration of orders',
        ],
        'options' => [
            'cancel' => 'Cancel',
            'show' => 'Show',
            'update' => 'Update',
        ],
    ],
];
