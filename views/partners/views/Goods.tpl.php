<tr>
    <td>
        <span><?= $good->getPartnum()?></span>
        <div class="in-cart">
            <button type="button" class="btn btn-danger" data-product-id="<?= $good->getId() ?>"
                    data-product-pn=<?= $good->getPartnum() ?> data-product-price="<?= $good->getPrice() ?>">В корзину
            </button>
        </div>
    </td>
    <td id="name_price_<?= $good->getId() ?>"> <?= $good->getName() ?></td>
    <td class="ruble"><?= $good->getPrice() ?> руб.</td>
    <td>
        <div class="store-hidden" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"
             title="подробнее">
            <div class='circule store-Color-<?= $good->getStocks()->getColorStatus() ?>'></div>
            <span> <?= $good->getStocks()->getStatus() ?></span>
            <div class="all-store">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-9"><span class="text-info">Основной склад:</span></div>
                    <div class="col-lg-3 col-md-3 col-xs-3"><?= $good->getStocks()->getMain() ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="text-danger">Поступления</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-9">1-2 недели:</div>
                    <div class="col-lg-3 col-md-3 col-xs-3"><?= $good->getStocks()->getWeak() ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-9">3-4 недели:</div>
                    <div class="col-lg-3 col-md-3 col-xs-3"><?= $good->getStocks()->getMonth() ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-9">1-1.5 месяца:</div>
                    <div class="col-lg-3 col-md-3 col-xs-3"><?= $good->getStocks()->getMoreMonth() ?></div>
                </div>
            </div>
        </div>
    </td>
</tr>
<?= PHP_EOL ?>