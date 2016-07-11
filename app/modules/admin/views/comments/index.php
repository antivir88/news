<?= \Micro\Web\Html\Html::href('Создать', '/admin/comments/create') ?>

<?= $this->widget('\Micro\Widget\GridViewWidget', [
    'data' => $query,
    'page' => $page,
    'filters' => false,
    'attributesCounter' => [
        'class' => 'data-summ'
    ],
    'paginationConfig' => [
        'url' => '/admin/comments/index?list=',
    ]
]); ?>
