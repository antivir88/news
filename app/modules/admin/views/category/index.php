<?= \Micro\Web\Html\Html::href('Создать', '/admin/category/create') ?>

<?= $this->widget('\Micro\Widget\GridViewWidget', [
    'data' => $query,
    'page' => $page,
    'filters' => false,
    'tableConfig' => [
        'id',
        'category'=>[
            'value' => '!empty($data->category) ? $data->parent->name : null',
        ],
        'name',
        ''=>[
            'class' => '\Micro\Widget\ActionsGridColumn',
            'link' => '/admin/category',
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
        'url' => '/admin/category/index?list=',
    ]
]); ?>
