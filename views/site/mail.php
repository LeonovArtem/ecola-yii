<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

debug($model);
?>
<h3>Задать вопрос:</h3>
<?php $form = ActiveForm::begin(['options'=>['id'=>'mail-form']]); ?>
<?= $form->field($model, 'name')->label('Имя')?>
<?= $form->field($model, 'email')->input('email'); ?>
<?= $form->field($model, 'text')->label('Текст сообщения')->textarea(['rows' => 5]); ?>
<?= Html::submitButton('Отправить', ['class' => 'btn btn-warning']) ?>
<?php $form = ActiveForm::end(); ?>
