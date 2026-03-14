<?php

return [
    'statuses' => [
        'index' => [
            'create_button' => 'Create Status',
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'actions' => 'Actions',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
        'create' => [
            'submit' => 'Create',
        ],
        'edit' => [
            'header' => 'Edit Status',
            'submit' => 'Update',
        ],
    ],
    'tasks' => [
        'index' => [
            'header' => 'Tasks',
            'create_button' => 'Create Task',
            'filter_status' => 'Status',
            'filter_author' => 'Author',
            'filter_executor' => 'Executor',
            'apply' => 'Apply',
        ],
        'create' => [
            'header' => 'Create Task',
            'description' => 'Description',
            'status' => 'Status',
            'executor' => 'Executor',
            'labels' => 'Labels',
        ]
    ],
];