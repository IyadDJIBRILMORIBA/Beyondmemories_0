<?php

return [

    'paths' => [
        'api/*',
        'sanctum/csrf-cookie',
        'storage/*',  // Très important pour les images
    ],

    'allowed_methods' => ['*'],

    // Comme tu es en local, * est ok
    'allowed_origins' => [
        'http://localhost:5173',
        'http://127.0.0.1:5173',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
