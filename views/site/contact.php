<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $name ?></h1>
<div class="site-contact">
    <h2>Компания ECOLA (Экола). Как с нами связаться</h2>
    <p><strong>Электронный адрес для корреспонденции:</strong> info@ecola.ru</p>
    <p><strong>Адрес нашего сайта в интернете:</strong> www.ecola.ru</p>
    <p><strong>Почтовый адрес для корреспонденции:</strong> 115280, г. Москва, а/я 115</p>
    <p><strong>Фактический адрес:</strong> 115280, г. Москва, ул. Мастеркова, д. 4, 16 этаж</p>
    <p><strong>Телефон/факс:</strong> (495) 981-06-15 (многоканальный)</p>
    <div class="alert alert-info text-center" role="alert">
       <span class="glyphicon glyphicon-question-sign"></span> Если у Вас возникли вопросы по выбору и приобретению, применению и эксплуатации светодиодных,
        энергосберегающих ламп и светильников - <strong>звоните нам с 10-00 до 19-00</strong>. Будем рады Вам помочь!
    </div>
    <div class="alert alert-success text-center" role="alert">
        <span class="glyphicon glyphicon-user"></span> Бизнес-партнерам предоставляются значительные скидки.
    </div>
    <h3>Как к нам проехать:</h3>
    <div class="row">
        <div class="col-lg-7 col-md-7">
            <p><strong class="text-danger">На метро: </strong>
                Ст. <strong>м. Автозаводская</strong>, последний вагон из центра, под землей в переходе налево, выход к Обувному
                центру.
                Справа от Обувного центра - ворота с надписью <strong>"Бизнес-центр - отель Панорама"</strong>, входите и
                примерно через 10 метров попадаете на проходную высотного здания.
                На охране говорите, что идете в компанию Экола. Проходите к лифтам и поднимаетесь на <strong>16-й этаж.</strong>
            </p>

            <p><strong class="text-danger">На машине: </strong></p>

            <p><strong>При движении по внутренней стороне ТТК: </strong>
                поворот на ул. Велозаводская - центр.
                При выезде на Велозаводскую сразу повернуть налево, под стрелку светофора, на улицу Автозаводская. Доехать до
                следующего светофора, повернуть направо на улицу Мастеркова.
            </p>
            <p><strong>При движении по внешней стороне ТТК: </strong>
                съезд под указатель "Мастеркова ул." После светофора второй поворот налево.
            </p>
            <p><strong>При движении по ул. Велозаводская из центра: </strong>
                за 300 метров до развязки с ТТК повернуть направо, под указатель Автозаводская улица. На следующем светофоре
                повернуть направо на улицу Мастеркова.
            </p>
            <div class="alert alert-warning text-center" role="alert">
                <span class="glyphicon glyphicon-warning-sign"></span><strong> Внимание!</strong>
                Рядом <strong>платная городская парковка</strong> на Автозаводской площади (как правило, мест достаточно). Номер городской парковки 3019.
                Бесплатной парковки на ул. Мастеркова и в окресностях нет.
                Заезд на автомобиле на территорию бизнес-центра возможен только по предварительной заявке для разгрузки-погрузки на краткое время до получаса.
                Заезд осуществляется с 3-его Автозаводского проезда, шлагбаум недалеко от пересечения с ул. Ленинская слобода.
            </div>
        </div>
        <div class="col-lg-5 col-md-5">
            <img src="/img/map.png" alt="map.png" style="width: 100%;height: auto">
            <div class="alert alert-info">
                <a href="/where">Где можно купить светодиодные и энергосберегающие лампы компании ECOLA?</a>
            </div>
        </div>
    </div>

<!--    <h3>--><?//= Html::encode($this->title) ?><!--</h3>-->
<!--    --><?php //if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
<!---->
<!--        <div class="alert alert-success">-->
<!--            Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.-->
<!--        </div>-->
<!---->
<!--        <p>-->
<!--            Note that if you turn on the Yii debugger, you should be able-->
<!--            to view the mail message on the mail panel of the debugger.-->
<!--            --><?php //if (Yii::$app->mailer->useFileTransport): ?>
<!--                Because the application is in development mode, the email is not sent but saved as-->
<!--                a file under <code>--><?//= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?><!--</code>.-->
<!--                                                                                                    Please configure the-->
<!--                <code>useFileTransport</code> property of the <code>mail</code>-->
<!--                application component to be false to enable email sending.-->
<!--            --><?php //endif; ?>
<!--        </p>-->
<!---->
<!--    --><?php //else: ?>
<!---->
<!--        <p>-->
<!--            Если у вас есть деловые вопросы или другие вопросы, заполните следующую форму, чтобы связаться с нами.-->
<!--            Спасибо.-->
<!--        </p>-->
<!---->
<!--        <div class="row">-->
<!--            <div class="col-lg-5">-->
<!---->
<!--                --><?php //$form = ActiveForm::begin(['id' => 'contact-form']); ?>
<!---->
<!--                --><?//= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
<!---->
<!--                --><?//= $form->field($model, 'email') ?>
<!---->
<!--                --><?//= $form->field($model, 'subject') ?>
<!---->
<!--                --><?//= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
<!---->
<!--                --><?//= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
//                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
//                ]) ?>
<!---->
<!--                <div class="form-group">-->
<!--                    --><?//= Html::submitButton('Отправить', ['class' => 'btn btn-warning', 'name' => 'contact-button']) ?>
<!--                </div>-->
<!---->
<!--                --><?php //ActiveForm::end(); ?>
<!---->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    --><?php //endif; ?>
</div>
