<?= \Micro\Web\Html\Html::href('Создать', '/admin/comments/create') ?>

<?= $this->widget('\Micro\Widget\GridViewWidget', [
    'data' => $query,
    'page' => $page,
    'filters' => false,
    'tableConfig' => [
        'id',
        'news' => [
            'value' => '$data->news->name'
        ],
        'email',
        'text',
        ''=>[
            'class' => '\Micro\Widget\ActionsGridColumn',
            'link' => '/admin/comments',
            'buttons' => [
                'edit' => [
                    'link' => '/update/'
                ],
                'delete' => [
                    'link' => '/delete/'
                ]
            ]
        ]
    ],
    'attributes' => [
        'style' => 'width: 100%'
    ],
    'attributesCounter' => [
        'class' => 'data-summ'
    ],
    'paginationConfig' => [
        'url' => '/admin/comments/index?list=',
    ]
]); ?>
