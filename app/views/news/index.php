<?= $this->widget('\Micro\Widget\DetailViewWidget', [ 'data' => $model ]); ?>

<?= $this->widget('\Micro\Widget\GridViewWidget', ['data'=>\App\Models\Comments::findByAttributes(['news_id'=>$model->id])]) ?>
