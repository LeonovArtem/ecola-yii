<tr>
    <td><?= $row['PARTNUM'] ?>
        <div class="in-cart">
            <button type="button" class="btn btn-danger" data-product-id="<?= $row['ID'] ?>"
                    data-product-pn=<?= $row['PARTNUM'] ?> data-product-price="<?= $PRICE ?>">В корзину
            </button>
        </div>
    </td>
    <td id="name_price_<?= $row['ID'] ?>"> <?= iconv("CP1251", "UTF-8", $row['NAME']) ?></td>
    <td class="ruble"><?= $PRICE ?> руб.</td>
    <td>
        <?
        $sum = $row['WEAK'] + $row['MONTH'] + $row['MOREMONTH'];
        if ($row['MAINSTOCK'] == 0)
            $m_store = $sum > 0 ? "<div class='circule store-Color-1'></div>Ожидает поступления" : "<div class='circule store-Color-2'></div>Нет в наличии";
        else
            $m_store = "<div class='circule store-Color-3'></div><span>В наличии</span>"
        ?>
        <div class="store-hidden" data-toggle="tooltip" data-placement="bottom" data-trigger="hover"
             title="подробнее">
            <?= $m_store ?>
            <div class="all-store">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-9"><span class="text-info">Основной склад:</span></div>
                    <div class="col-lg-3 col-md-3 col-xs-3"><?= $row['5'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="text-danger">Поступления</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-9">1-2 недели:</div>
                    <div class="col-lg-3 col-md-3 col-xs-3"><?= $row['6'] ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-9">3-4 недели:</div>
                    <div class="col-lg-3 col-md-3 col-xs-3"><?= $row['7'] ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-9">1-1.5 месяца:</div>
                    <div class="col-lg-3 col-md-3 col-xs-3"><?= $row['8'] ?></div>
                </div>
            </div>
        </div>
    </td>
</tr>