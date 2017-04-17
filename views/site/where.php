<?php
use app\components\MyWidget;
use yii\widgets\LinkPager;

?>
<h3>Где можно приобрести энергосберегающие лампы Ecola (Экола)?</h3>

<!--<button class="btn btn-primary" id="btn">AJAX</button>-->
<!--<div id="ajax-text"></div>-->

<table id="where" class="table table-condensed table-bordered">
    <thead>
    <tr>
        <td>Название</td>
        <td>Город</td>
        <td>Адрес</td>
        <td>Телефон</td>
    </tr>
    </thead>
    <tbody id="vendor-list">
    <?php foreach ($row as $partner): ?>
        <tr>
            <td><?= $partner->title ?></td>
            <td><?= $partner->city ?></td>
            <td><?= $partner->address ?></td>
            <td><?= $partner->contact ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="text-center">
    <?= LinkPager::widget(['pagination' => $pages]) ?>
</div>





