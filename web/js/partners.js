(function ($, undefined) {
/**
 * @$blockCart  Корзина
 * @$content    Список товаров
 * @$butSearch  Поиск в СВИУ
 * @$productList Cписок товаров подгружаемый Ajax
 * @goodsInCart {array} Товары в корзине
 * @$nick Таблица плательщиков
 */
var $content = $('#content')
    , $butSearch = $('#but-search')
    , $butOrder = $('#but-order')
    , $goodsTable = $('#goods-table')
    , $blockCart = $('#block-cart')
    , $partnersList = $('#partners-list')
    , $partnersHtml = $('.partners-nick')
    , $nickTable = $('#nick-table')
    , $productList = $('#product-list')
    , $sumPrice = $('#all-sum-price')
    , $navTab = $('.nav-tabs')
    , $breadcrumb = $('.breadcrumb')
    , $infoOrder = $('.info-order')
    , $modal = $('#modal-shop')
    , goodsInCart = []
    , getNick = function () {
    return localStorage.getItem('nick');
};

//Навигация
$navTab.on('click', 'a', function () {
    var tabText = $(this).find('.nav-text').text(),
        $navActive = $breadcrumb.find('.active');
    $navActive.text(tabText);
});
//Список товаров по P/N или Наименованию
$butSearch.on('click', function () {
    var $search = $('#search-price')
        , $searchInput = $search.find('input')
        , searchText = $searchInput.serializeArray();
    $search.on('submit', function () {
        return false;
    });
    if ($searchInput.val()) {
        $.ajax({
            url: 'parsesearch.php',
            method: 'POST',
            data: searchText,
            dataType: 'html',
            success: function (serverData) {
                if (serverData.length) {
                    $goodsTable.removeClass('hidden');
                    $('.alert').addClass('hidden');
                    $('.alert-success').removeClass('hidden');
                }else{
                    $goodsTable.addClass('hidden');
                    $('.alert').addClass('hidden');
                    $('.alert-danger').removeClass('hidden');
                }
                $productList.empty().html(serverData);
            }
        });
    }
    return false;
});
//Плательщик
$partnersList.html = (function () {
    var partnerId = localStorage.getItem('partnersId');
    if (partnerId) partnersNicks(partnerId);
}());

$partnersHtml.on('click', 'input', function () {
    var idNick = $(this).val();
    localStorage.setItem('nick', idNick);
});


$content.on('click', '#svu-order-but', function () {
    var self = this;
    if (getNick()) {
        createOrder();
    }
    else {
        var nickModal = new createModal();
        nickModal
            .setTitle('Выберите плательщика')
            .setBody($nickTable)
            .setButton('Оформить заказ', function () {

                if (getNick()) {
                    $(self).trigger('click');
                }
                else {
                    $(this).addClass('disabled');
                    alert('Плательщик не выбран');
                }
                $(this).off('click');
            })
            .create();
    }
});

function createOrder() {
    //Добавляем количество к товарам
    for (var i = 0, n = goodsInCart.length; i < n; i++) {
        var id = goodsInCart[i].idGoods;
        var quantity = $("tr#" + id).find('.number input').val();
        goodsInCart[i].count = quantity;
    }

    $.ajax({
        url: 'basesvu.php',
        data: {
            ORDER: goodsInCart,
            NICK: localStorage.getItem('nick')
        },
        dataType: 'html',
        success: function (html_data) {
            $blockCart.html('<h2 class="text-center">' + html_data + '</h2>');

            reloadPage(3000);
        }
    });
}


function partnersNicks(partnerId) {
    var data_ser = {
        id: partnerId
    };
    $.ajax({
        url: 'nick.php',
        data: data_ser,
        dataType: 'json',
        success: function (json_data) {
            for (var i = 0, n = json_data.length; i < n; i++) {
                var partner = '<tr>' + '<td>' + json_data[i].NIKS_ID + '</td>' + '<td>' + json_data[i].NIKS + '</td>' + '<td><input type="radio" name="payer" value="' + json_data[i].NIKS_ID + '"></td></tr>';
                $partnersHtml.append(partner);
            }
        }
    });
}

/**
 * Корзина товаров
 * @goodsInCart {array} Товары в корзине
 * @$store Наличие товара
 */

$productList.on('click', '.store-hidden', function () {
    $(this).find('.all-store').fadeToggle('fast');
});
$productList.on('click', '.btn', function () {
    var idGoods = $(this).data('product-id')
        , partNumber = $(this).data('product-pn')
        , price = $(this).data('product-price')
        , goodTitle = $('#' + 'name_price_' + idGoods).text()
        , good
        , goodCount = 1
        , sum_product = 0;

    if ($(this).text() == 'Перейти в корзину') {
        $butOrder.trigger('click');
    }
    else {
        $(this).toggleClass('btn-danger btn-warning');
        $(this).text('Перейти в корзину');
        sum_product += price;
        $("#price").text(sum_product + ' руб.');
        good = new ProductCart(idGoods, partNumber, goodTitle, price, goodCount);
        goodsInCart.push(good);
        $butOrder.find('.count').text(goodsInCart.length);
    }
});
function ProductCart(idGoods, partNumber, goodTitle, price, goodCount) {
    this.idGoods = idGoods;
    this.partNumber = partNumber;
    this.goodTitle = goodTitle;
    this.price = price;
    this.count = goodCount;
}
$butOrder.click(function () {
    if (goodsInCart.length) {
        var
            cartModal,
            sum = 0,
            totalItems = '';

        for (var i = 0, n = goodsInCart.length; i < n; i++) {
            totalItems += '<tr id="' + goodsInCart[i].idGoods +
                '" data-partum="' + goodsInCart[i].partNumber +
                '" data-price="' + goodsInCart[i].price +
                '"><td>' + goodsInCart[i].partNumber +
                '</td><td>' + goodsInCart[i].goodTitle +
                '</td><td class="count-prod">' + goodsInCart[i].price +
                '<span class="ruble"> руб.</span>' +
                '</td><td>' +
                '<div class="input-group number">'+
                '<span class="input-group-btn minus">'+
                '<button class="btn btn-warning" type="button">-</button></span>'+

                '<input type="number" data-id="' + goodsInCart[i].idGoods +
                '" class="form-control var-input" value="1">'+
                '<span class="input-group-btn plus">'+
                '<button class="btn btn-warning" type="button">+</button></span></div>'+
                '</td><td><span class="sum-prod">' +
                goodsInCart[i].price + '</span><span class="ruble"> .руб</span></td></tr>';

            sum += goodsInCart[i].price;
        }
        $blockCart.find('tbody').html(totalItems);
        $sumPrice.text(sum);
    } else {
        cartModal = new createModal();
        cartModal
            .setTitle('Корзина')
            .setBody('Ваша корзина пуста')
            .create();
        return false;
    }
});
//Оформление заказа
$content.on('click', '.minus', function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
});
$content.on('click', '.plus', function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);

    $input.change();
    return false;
});

$content.on('change', '.var-input', function () {
    var prod_id = $(this).data('id')
        , tr_data = $('#' + prod_id)
        , //Строка товара
        $sumProd = $('.sum-prod')
        , price = tr_data.data('price')
        , quantity = $(this).val()
        , sum = price * quantity
        , all_sum = 0
        , prod_sum = 0
        , currentSum = 0
        , i = 0;
    tr_data.find('.sum-prod').text(sum);
    for (; i < $sumProd.length; ++i) {
        prod_sum = $sumProd[i].innerText;
        currentSum = parseInt(prod_sum);
        all_sum += currentSum;
        $sumPrice.text(all_sum);
    }
});
/**
 * Вкладка текущие заказы партнера
 */
$infoOrder.on('click', '.delete-order', function () {
    var idOrder = $(this).data('id-order'),
        $tableOrder=$('#'+ idOrder);
    $.ajax({
        url: 'ordersnick.php',
        type: 'POST',
        data:{'deleteOrder':idOrder},
        dataType: 'html',
        success: function (message) {
            var delOrder = new createModal();
            delOrder
                .setTitle('Омена заказа')
                .setBody(message)
                .setButton('Ок')
                .create();
            $tableOrder.detach();
        },
        error: function () {
            alert('При попытке удаления заказа произошла ошибка, повторите запрос позже');
        }
    });
});


/**
 * Modal - Builder returns an object created from a template
 * obj = new createModal()
 * obj.setTitle() {string}
 * obj.setBody()  {string}
 *
 * obl.setButton(string: textButton,function: callback)
 *
 * obj.create() {return object getModal}
 */

function getModal(title, message, buttonModal) {
    var $modalHeader = $('#modalHeader'),
        $modalBody = $('.modal-body'),
        $butClose = $('#modal-close'),
        $butSave = $('#modal-save');
    $modalHeader.text(title);
    $modalBody.html(message);
    if (buttonModal) {
        $butClose.text(buttonModal.text);
        $butClose.on('click', buttonModal.callFunction);
    }
    $modal.modal();
}
function createModal() {
    var self = this;
    this.modalBody = '';
    this.modalTitle = '';
    this.butClose = null;
    this.setBody = function (modalBody) {
        self.modalBody = modalBody;
        return self;
    };
    this.setTitle = function (modalTitle) {
        self.modalTitle = modalTitle;
        return self;
    };
    this.setButton = function (textButton, callback) {
        self.butClose = {
            'text': textButton,
            'callFunction': callback
        };
        return self;
    };
    this.create = function () {
        return new getModal(self.modalTitle, self.modalBody, self.butClose)
    }
}
function reloadPage(delay) {
    setTimeout(function () {
        location.reload();
    }, delay);
}


})(jQuery);
