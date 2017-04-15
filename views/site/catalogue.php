<?php
use yii\widgets\Menu;

?>
<?php foreach ($cataloge as $page): ?>
<?= Menu::widget([
    'items' => [
        ['label' => $page->TITLE, 'url' => ['site/index']],
    ],
//    'options' => [
//        'class' => 'nav nav-pills nav-stacked',
//        'style' => 'float: left; font-size: 16px;',
//        'data' => 'menu',
//    ],
//    'activeCssClass' => 'active',
//    'firstItemCssClass' => 'fist',
//    'lastItemCssClass' => 'last',
]);
?>
<?php endforeach; ?>

