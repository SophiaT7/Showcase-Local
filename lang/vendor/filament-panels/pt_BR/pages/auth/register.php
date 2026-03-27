<?php

return [
    'title' => 'Criar conta',

    'heading' => 'Crie sua conta',

    'actions' => [
        'login' => [
            'before' => 'ou',
            'label' => 'entre na sua conta',
        ],
    ],

    'form' => [
        'name' => [
            'label' => 'Nome',
        ],
        'email' => [
            'label' => 'E-mail',
        ],
        'password' => [
            'label' => 'Senha',
        ],
        'password_confirmation' => [
            'label' => 'Confirmar senha',
        ],
        'actions' => [
            'register' => [
                'label' => 'Criar conta',
            ],
        ],
    ],

    'notifications' => [
        'throttled' => [
            'title' => 'Muitas tentativas de registro',
            'body' => 'Tente novamente em :seconds segundos.',
        ],
    ],
];
