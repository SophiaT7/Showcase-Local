<?php

return [
    'single' => [
        'label' => 'Excluir',
        'modal' => [
            'heading' => 'Excluir :label',
            'actions' => [
                'delete' => [
                    'label' => 'Excluir',
                ],
            ],
            'description' => 'Tem certeza que deseja excluir? Esta acao nao pode ser desfeita.',
        ],
        'notifications' => [
            'deleted' => [
                'title' => 'Excluido',
            ],
        ],
    ],
    'multiple' => [
        'label' => 'Excluir selecionados',
        'modal' => [
            'heading' => 'Excluir :label selecionados',
            'actions' => [
                'delete' => [
                    'label' => 'Excluir',
                ],
            ],
            'description' => 'Tem certeza que deseja excluir os registros selecionados? Esta acao nao pode ser desfeita.',
        ],
        'notifications' => [
            'deleted' => [
                'title' => 'Excluidos',
            ],
        ],
    ],
];
