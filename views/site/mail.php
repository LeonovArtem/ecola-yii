<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\MyWidget;
use app\components\NewWidget;
?>
<?NewWidget::begin() ?>
   <h3>привет</h3>
<?NewWidget::end() ?>



<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
    <h3>Задать вопрос:</h3>
<?php $form = ActiveForm::begin(['options' => ['id' => 'mail-form']]); ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'email')->input('email'); ?>
<?= $form->field($model, 'text')->textarea(['rows' => 5]); ?>
<?= Html::submitButton('Отправить', ['class' => 'btn btn-warning']) ?>
<?php $form = ActiveForm::end(); ?>

<?= MyWidget::widget(['title' => 'Gx53','pn' => 'PDSDSD23','price' => 320]) ?>
