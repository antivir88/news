<?php
/** @var \Micro\Mvc\Models\IModel $model */
/** @var \Micro\Form\Form $form */
$form = $this->beginWidget('\Micro\Widget\FormWidget', [ 'method' => 'post' ]);
?>

<?= $form->dropDownListFieldRow($model, 'news_id', [ 'elements' => array_merge([[]],(new \App\Models\News)->getNews()) ]); ?>

<?= $form->emailFieldRow($model, 'email'); ?>

<?= $form->textAreaFieldRow($model, 'text'); ?>


<?= \Micro\Web\Html\Html::openTag('div'); ?>
<?= \Micro\Web\Html\Html::submitButton($model->isNewRecord() ? 'Создать' : 'Сохранить'); ?>
<?= \Micro\Web\Html\Html::closeTag('div'); ?>

<?php $this->endWidget('\Micro\Widget\FormWidget'); ?>
