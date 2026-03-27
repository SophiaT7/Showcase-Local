<?php

return [
    'columns' => [
        'tags' => [
            'more' => 'e mais :count',
        ],
        'text' => [
            'actions' => [
                'collapse_list' => 'Mostrar :count menos',
                'expand_list' => 'Mostrar mais :count',
            ],
            'more_list_items' => 'e mais :count',
        ],
    ],

    'actions' => [
        'disable_reordering' => [
            'label' => 'Finalizar reordenacao',
        ],
        'enable_reordering' => [
            'label' => 'Reordenar',
        ],
        'filter' => [
            'label' => 'Filtrar',
        ],
        'group' => [
            'label' => 'Agrupar',
        ],
        'open_bulk_actions' => [
            'label' => 'Acoes em lote',
        ],
        'toggle_columns' => [
            'label' => 'Alternar colunas',
        ],
    ],

    'empty' => [
        'heading' => 'Nenhum registro encontrado',
        'description' => 'Crie um registro para comecar.',
    ],

    'filters' => [
        'actions' => [
            'apply' => [
                'label' => 'Aplicar filtros',
            ],
            'remove' => [
                'label' => 'Remover filtro',
            ],
            'remove_all' => [
                'label' => 'Remover todos os filtros',
            ],
            'reset' => [
                'label' => 'Redefinir filtros',
            ],
        ],
        'heading' => 'Filtros',
        'indicator' => 'Filtros ativos',
        'multi_select' => [
            'placeholder' => 'Todos',
        ],
        'select' => [
            'placeholder' => 'Todos',
        ],
        'trashed' => [
            'label' => 'Registros excluidos',
            'only_trashed' => 'Somente excluidos',
            'with_trashed' => 'Com excluidos',
            'without_trashed' => 'Sem excluidos',
        ],
    ],

    'grouping' => [
        'fields' => [
            'group' => [
                'label' => 'Agrupar por',
                'placeholder' => 'Agrupar por',
            ],
            'direction' => [
                'label' => 'Direcao',
                'options' => [
                    'asc' => 'Crescente',
                    'desc' => 'Decrescente',
                ],
            ],
        ],
    ],

    'reorder_indicator' => 'Arraste e solte para reordenar.',

    'selection_indicator' => [
        'selected_count' => ':count selecionado(s)',
        'actions' => [
            'select_all' => [
                'label' => 'Selecionar todos (:count)',
            ],
            'deselect_all' => [
                'label' => 'Desmarcar todos',
            ],
        ],
    ],

    'sorting' => [
        'fields' => [
            'column' => [
                'label' => 'Ordenar por',
            ],
            'direction' => [
                'label' => 'Direcao',
                'options' => [
                    'asc' => 'Crescente',
                    'desc' => 'Decrescente',
                ],
            ],
        ],
    ],

    'summary' => [
        'heading' => 'Resumo',
        'subheadings' => [
            'all' => 'Todos :label',
            'group' => 'Resumo de :group',
            'page' => 'Esta pagina',
        ],
        'summarizers' => [
            'average' => [
                'label' => 'Media',
            ],
            'count' => [
                'label' => 'Quantidade',
            ],
            'sum' => [
                'label' => 'Soma',
            ],
        ],
    ],
];
