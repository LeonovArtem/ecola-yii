<!doctype html>
<html lang="ru">
<head>
    <title>Партнерам</title>
    <meta charset="UTF-8">
    <!--Для мобильных устройств-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <script src="bower_components/jquery/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="bower_components/underscore/underscore-min.js"></script>
    <script src="scripts/cartadd.js" defer></script>
    <script src="scripts/orders.js" defer></script>

    <?php
    require_once('ordersnick.php');
    Model::getInstance();
    ?>
</head>
<body>


<div class="modal fade" id="modal-shop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalHeader">Название модали</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button id="modal-close" type="button" class="btn btn-info" data-dismiss="modal">Закрыть</button>
                <button id="modal-save" type="button" class="btn btn-primary hidden">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ol class="breadcrumb">
                <li><a href="#">Главная</a></li>
                <li><a href="#">Партнерам</a></li>
                <li class="active">Магазин</li>
            </ol>
            <div id="content">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#shop" data-toggle="tab">
                            <span class="nav-text">Магазин</span>
                        </a>
                    </li>
                    <li>
                        <a href="#nick" data-toggle="tab">
                            <span class="glyphicon glyphicon-user pull-right"></span>
                            <span class="nav-text">Выбор плательщика<span>
                        </a>
                    </li>
                    <li><a href="#order" data-toggle="tab">
                            <span class="glyphicon glyphicon-shopping-cart pull-right"></span>
                            <span class="nav-text">Текущие заказы</span>
                        </a>
                    </li>
                    <li><a id="but-order" href="#cart" data-toggle="tab"><span class="badge pull-right count">0</span>
                            <span class="nav-text">Моя корзина</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane  active" id="shop">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <!--Form Search-->
                                <form id="search-price" data-toggle="validator" role="form">
                                    <span class="text-primary">Поиск товаров:</span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="P/N или наименование"
                                               name="search_text" required>
                                        <span class="input-group-btn">
                                            <button id="but-search" class="btn btn-primary" type="submit">Найти</button>
                                        </span>
                                    </div>
                                </form>
                                <br>
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span
                                            aria-hidden="true">&times;</span><span
                                            class="sr-only">Close</span></button>
                                    <span class="glyphicon glyphicon-info-sign"></span> Можно вводить несколько<strong>
                                        артикулов (PN)</strong>, разделяя их <strong>пробелами, запятыми </strong> или
                                    другими разделительными знаками.
                                </div>
                                <div class="alert alert-success alert-dismissible hidden" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span
                                            aria-hidden="true">&times;</span><span
                                            class="sr-only">Close</span></button>
                                    <span class="glyphicon glyphicon-info-sign"></span> Узнать <strong>количество
                                        товаров</strong> можно 'кликнув' на соответствующее поле товара
                                </div>
                                <div class="alert alert-danger alert-dismissible hidden" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span
                                            aria-hidden="true">&times;</span><span
                                            class="sr-only">Close</span></button>
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    <strong>
                                        К сожалению, на ваш поисковый запрос ничего не найдено.
                                    </strong>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="goods-table" class="panel panel-default hidden">
                                    <div class="panel-heading">
                                        Список товаров
                                    </div>
                                    <div id="find-price" class="table-responsive ">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>P/N</th>
                                                <th>Наименование товара</th>
                                                <th>Цена</th>
                                                <th>Наличие</th>
                                            </tr>
                                            </thead>
                                            <tbody id="product-list">
                                            <!--Список товаров-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nick">
                        <h2>Выберите плательщика:</h2>
                        <table id="nick-table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID Плательщика</th>
                                <th>Плательщик</th>
                                <th>Выбрать</th>
                            </tr>
                            </thead>
                            <tbody class="partners-nick">
                            <!--Список товаров-->
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="order">
                        <? $partner = new Partner($_REQUEST['NICK']) ?>
                        <? $allOrder = count($partner->getOrders());
                        if ($allOrder):?>
                            <h3>Заказчик:<?= $partner->getCompanyName() ?></h3>
                            <? for ($i = 0; $i < $allOrder; ++$i): ?>
                                <? $order = $partner->getOrders()[$i]; ?>
                                <div class="panel panel-default info-order" id="<?= $order->getId() ?>">
                                    <div class="panel-heading number-order">
                                        Номер заказа: <span class="text-danger"><?= $order->getId() ?></span>
                                        <button type="button" class="btn btn-danger delete-order"
                                                data-id-order="<?= $order->getId() ?>">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удалить
                                        </button>
                                    </div>
                                    <div class="panel-body">
                                        <span class="glyphicon glyphicon-user"></span>
                                        Плательщик: <?= $order->getNickFirmName() ?>
                                        <div class="date-order"><span class="glyphicon glyphicon-calendar"></span> Дата
                                            создания: <?= $order->getDate() ?></div>
                                        <div class="goods-order">
                                            <span class="glyphicon glyphicon-th-list"></span> Список товаров в заказе:
                                        </div>
                                    </div>
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <th>PN</th>
                                            <th>Наименование товара</th>
                                            <th>Кол-во</th>
                                            <th>Цена</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <? /**
                                         * Cписок товаров в заказе
                                         */
                                        for ($j = 0, $num = count($order->getGoods()); $j < $num; $j++):
                                            $good = $order->getGoods()[$j];
                                            ?>
                                            <tr>
                                                <td><?= $good->getPartnum() ?></td>
                                                <td><?= $good->getName() ?></td>
                                                <td><?= $good->getQuantity() ?></td>
                                                <td class="ruble"><?= $good->getPrice() ?> руб.</td>
                                            </tr>
                                        <? endfor; ?>

                                        </tbody>
                                    </table>
                                    <div class="well text-right">
                                        <h4>Общая сумма: <span class="ruble"><?= $order->getSumOrder(); ?> руб.</span>
                                        </h4>
                                    </div>
                                </div>
                            <? endfor; ?>
                        <? else: ?>
                            <div class="jumbotron text-center">
                                <h3>У вас нет текущих заказов</h3>
                            </div>
                        <? endif; ?>
                    </div>
                    <div class="tab-pane fade" id="cart">
                        <div id="block-cart">
                            <!--Товары в корзине-->
                            <table class="table table-hover shopping_list">
                                <thead>
                                <tr class="warning">
                                    <th>P/N</th>
                                    <th>Наименование</th>
                                    <th>Цена</th>
                                    <th>Кол-во</th>
                                    <th>Сумма</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <hr>
                                    <div class="all-sum">
                                        <span>Итого:</span>
                                        <span id="all-sum-price"></span>
                                        <span class="ruble">руб.</span>
                                        <button id="svu-order-but" type="button" class="btn btn-danger">Оформить
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

