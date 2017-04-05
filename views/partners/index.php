<?php
//$this->title='Партнерам';
?>
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
                <tr>
                    <td><?= $good->PARTNUM ?></td>
                    <td class="hidden-xs"><?= $good->NAME ?></td>
                    <td class="ruble"><?= $good->PRICE ?> руб.</td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center">
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
    </div>


<? endif; ?>

