<?= $this->widget('\Micro\Widget\DetailViewWidget', [ 'data' => $model, 'attributes' => ['class' => 'dl-horizontal'] ]); ?>

<?= $this->widget('\Micro\Widget\GridViewWidget', [
    'data'=>\App\Models\Comments::findByAttributes(['news_id'=>$model->id]),
    'filters' => false,
    'attributes' => [
        'style' => 'width: 100%'
    ],
    'attributesCounter' => [
        'class' => 'data-summ'
    ]
]) ?>
