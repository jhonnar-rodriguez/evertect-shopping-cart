<?php

use App\Models\Access\User\User;
use App\Models\Business\Product\Product;

return [

    'access' => [
        'users' => [
            'model' => User::class,
            'table' => 'users',
        ],
    ],

    'core' => [
        'products' => [
            'model' => Product::class,
            'table' => 'products',
        ],
    ],

    'http_responses' => [

        'success' => [
            'text'  => 'Success',
            'code'  => 200
        ],

        'unauthorized' => [
            'text'  => 'Unauthorized',
            'code'  => 401
        ],

        'server_error' => [
            'text'  => 'Server_Error',
            'code'  => 500
        ],

    ],

];