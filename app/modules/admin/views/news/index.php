<?= \Micro\Web\Html\Html::href('Создать', '/admin/news/create') ?>

<?= $this->widget('\Micro\Widget\GridViewWidget', [
    'data' => $query,
    'page' => $page,
    'filters' => false,
    'tableConfig' => [
        'id',
        'user'=>[
            'value' => '$data->creator->login'
        ],
        'category'=>[
            'value' => '!empty($data->category) ? $data->catalog->name : null',
        ],
        'name',
        'slug',
        'created_at',
        ''=>[
            'class' => '\Micro\Widget\ActionsGridColumn',
            'link' => '/admin/news',
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
        'url' => '/admin/news/index?list=',
    ]
]); ?>
