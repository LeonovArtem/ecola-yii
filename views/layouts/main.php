<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Google Web Font Embed -->
    <link
        href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Ecola',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О фирме', 'url' => ['/site/about']],
            ['label' => 'Каталог', 'url' => ['/site/catalogue']],
            ['label' => 'Где купить', 'url' => ['/site/where']],
            ['label' => 'Партнерам', 'url' => ['/partners/index']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">


        <?php if (isset($this->blocks['slider'])): ?>
            <?= $this->blocks['slider']; ?>
        <?php endif; ?>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <img src="/img/live-lighter.png">
                </div>
                <div class="col-lg-6 col-md-6 text-right">
                    <!--Search-->
                </div>
            </div>
        </div>
    </div>
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 foo-company">
                    Экола предлагает широкий ассортимент продукции
                    для создания современного экономичного освещения:<br>
                    энергосберегающие светодиодные лампы, светильники и прожекторы.<br>
                    Изделия предназначены для использования в жилых домах и квартирах,
                    офисных, производственных и других типах помещений, а также для подсветки
                    архитектурных объектов различного назначения.
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <ul class="menu-list-white">
                                <li><span class="glyphicon glyphicon-home"></span> <a href="/">Главная</a></li>
                                <li><span class="glyphicon glyphicon-briefcase"></span> <a href="">О фирме</a></li>
                                <li><span class="glyphicon glyphicon-phone-alt"></span> <a href="/site/mail">Контакты</a></li>
                                <li><span class="glyphicon glyphicon-user"></span> <?= Html::a('Партнерам',Url::to(['partners/index']))?></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <ul class="menu-list-white text-right">
                                <li><span class="glyphicon glyphicon-map-marker"></span> <a href="">Где купить?</a></li>
                                <li><span class="glyphicon glyphicon-comment"></span> <a href="">Новости</a></li>
                                <li><span class="glyphicon glyphicon-shopping-cart"></span> <a href="">Каталог</a></li>
                                <li><span class="glyphicon glyphicon-pencil"></span> <a href="">Статьи</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="text-center">&copy; Ecola <?= date('Y') ?></p>

            <!--            <p class="pull-right">--><? //= Yii::powered() ?><!--</p>-->
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

