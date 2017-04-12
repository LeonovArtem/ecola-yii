<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Свяжитесь с нами, если вы считаете, что это ошибка сервера. Спасибо.
    </p>
    <h3><span class="glyphicon glyphicon-earphone"></span> (495) 981-06-15 </h3>

</div>
