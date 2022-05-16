<?php

return [
    'user' => [
        'title' => [
            'title' => 'Users',
            'required_data' => 'Required data',
            'list_of_users' => 'List of users',
        ],
        'options' => [
            'import' => 'Import',
            'export' => 'Export',
            'show' => 'Show',
            'update' => 'Update',
            'back' => 'Back',
        ],
        'fields' => [
            'id' => '#',
            'name' => 'Name',
            'email' => 'Email',
            'identification' => 'Identification',
            'role' => 'Role',
            'disable_at' => 'Disable At',
        ],
    ],
    'role' => [
        'title' => [
            'title' => 'Roles',
            'name' => 'Name',
            'permission_list' => 'Permission List',
            'list_of_roles' => 'List of Roles',
        ],
        'options' => [
            'back' => 'Back',
            'import' => 'Import',
            'export' => 'Export',
            'create' => 'Create',
            'show' => 'Show',
            'update' => 'Update',
            'delete' => 'Delete',
        ],
        'fields' => [
            'id' => '#',
            'name' => 'Name',
        ],
    ],
];
