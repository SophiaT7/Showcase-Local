<?php

return [
    'title' => 'Entrar',

    'heading' => 'Entrar na sua conta',

    'actions' => [
        'register' => [
            'before' => 'ou',
            'label' => 'crie uma conta',
        ],
    ],

    'form' => [
        'email' => [
            'label' => 'E-mail',
        ],
        'password' => [
            'label' => 'Senha',
        ],
        'remember' => [
            'label' => 'Lembrar de mim',
        ],
        'actions' => [
            'authenticate' => [
                'label' => 'Entrar',
            ],
        ],
    ],

    'messages' => [
        'failed' => 'Essas credenciais nao correspondem aos nossos registros.',
    ],

    'notifications' => [
        'throttled' => [
            'title' => 'Muitas tentativas de login',
            'body' => 'Tente novamente em :seconds segundos.',
        ],
    ],
];
