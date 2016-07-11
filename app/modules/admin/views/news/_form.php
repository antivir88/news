<?php
/** @var \Micro\Mvc\Models\IModel $model */
/** @var \Micro\Form\Form $form */
$form = $this->beginWidget('\Micro\Widget\FormWidget', [ 'method' => 'post' ]);
?>


<?= $form->textFieldRow($model, 'name'); ?>
<?= $form->textFieldRow($model, 'slug'); ?>

<?= $form->dropDownListFieldRow($model, 'category', [ 'elements' => array_merge([[]],(new \App\Models\Categories)->getCategories()) ]); ?>
<?= $form->dropDownListFieldRow($model, 'user', [ 'elements' => array_merge([[]],(new \App\Models\Users)->getUsers()) ]); ?>

<?= $form->textAreaFieldRow($model, 'announce'); ?>
<?= $form->textAreaFieldRow($model, 'content'); ?>

<?= $form->textFieldRow($model, 'created_at'); ?>


<?= \Micro\Web\Html\Html::openTag('div') ?>
<?= \Micro\Web\Html\Html::submitButton($model->isNewRecord() ? 'Создать' : 'Сохранить'); ?>
<?= \Micro\Web\Html\Html::closeTag('div') ?>

<?php $this->endWidget('\Micro\Widget\FormWidget') ?>
