<?php
//$this->registerJsFile('js/partners.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('js/login.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<?php if (!empty($goods)): ?>
    <div class="panel panel-default">
        <div class="panel-heading">

        </div>
        <table class="table-condensed table-bordered">
            <thead>
            <tr>
                <th>P/N</th>
                <th class="hidden-xs">Наименование товара</th>
                <th>Цена</th>
                <th>Наличие</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($goods as $good): ?>
                <tr>
                    <td><?= $good->ID ?></td>
                    <td><?= $good->NAME ?></td>
                    <td><?= $good->PRICE ?></td>
                    <td></td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center">
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
    </div>


<? endif; ?>

