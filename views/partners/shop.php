<?php
use app\components\MyWidget;
use yii\widgets\LinkPager;

?>
<?php $this->beginBlock('block1'); ?>
<h1>Заголовок</h1>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('slider'); ?>
<h3>Тут будет слайдер</h3>
<?php $this->endBlock(); ?>


<button class="btn btn-primary" id="btn">AJAX</button>
<div id="ajax-text">Ajax Before</div>
<?php if (!empty($goods)): ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h4>Список товаров</h4></div>
        <table class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>P/N</th>
                <th class="hidden-xs">Наименование товара</th>
                <th>Цена</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($goods as $good): ?>
                <?= MyWidget::widget(['title' => $good->NAME, 'pn' => $good->PARTNUM, 'price' => $good->PRICE]) ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center">
        <?= LinkPager::widget(['pagination' => $pages]) ?>
    </div>
<? endif; ?>

