<?php

echo $this->widget('\Micro\Widget\ListViewWidget', [
    'data' => $sql,
    'page' => $page,
    'pathView' => __DIR__ . '/_view.php',
    'paginationConfig' => [
        'url' => '/news/'
    ],
    'counterText' => 'Summ: ',
    'attributesCounter' => ['class' => 'data-summ'],
    'attributesEmpty' => ['class' => 'data-empty'],
]);