<?php

return [

    'paths' => [
        'api/*',
    ],

    'allowed_origins' => [
        'https://vitrinelocal.labcct.net.br',
        'http://localhost:3000', // opcional (dev)
    ],

    'allowed_methods' => ['*'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,

];
