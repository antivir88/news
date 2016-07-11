<?php
/** @var \Micro\Mvc\Models\IModel $model */
/** @var \Micro\Form\Form $form */
$form = $this->beginWidget('\Micro\Widget\FormWidget', [ 'method' => 'post' ]);
?>


<?= $form->textFieldRow($model, 'name', ['label'=>['style'=>'min-width: 120px;display: inline-block;']]); ?>

<?= $form->dropDownListFieldRow($model, 'category', [ 'elements' => array_merge([[]],$model->getCategories()),'label'=>['style'=>'min-width: 120px;display: inline-block;'] ]); ?>


<?= \Micro\Web\Html\Html::openTag('div') ?>
<?= \Micro\Web\Html\Html::submitButton($model->isNewRecord() ? 'Создать' : 'Сохранить'); ?>
<?= \Micro\Web\Html\Html::closeTag('div') ?>

<?php $this->endWidget('\Micro\Widget\FormWidget') ?>
