<?php

class Model
{
    static protected $base = NULL;

    static function getInstance()
    {
        if (self::$base) {
            return self::$base;
        }
        self::$base = new PDO('odbc:SVU');
        return self::$base;
    }

    function getQueryResult($query, $parameters = '', $fetchMode = PDO::FETCH_OBJ)
    {
        $base = self::$base;
        if ($parameters) {
            $sth = $base->prepare($query);
            $sth->execute($parameters);
        } else {
            $sth = $base->query($query);
        }

        $result = $sth->fetchAll($fetchMode);
        return $result;
    }

    private function __construct()
    {
    }

    static function convertString($str)
    {
        return iconv("CP1251", "UTF-8", $str);
    }

}

class Partner extends Model
{
    public $idPartner;
    public $companyName;
    private $orders;

    function __construct($idPartner)
    {
        $this->idPartner = $idPartner;
        $this->setCompanyName();
        $this->setOrderPartner();
    }

    /**
     * @return array
     */
    public function getOrders()
    {
        return $this->orders;
    }

    private function setOrderPartner()
    {
        $query = "SELECT ID,IDPARTNERSNICK,TO_CHAR(DOCDATE,'DD.MM.YYYY') as DOCDATE,DELETED,PARTNER_ID,NICKFIRMNAME,FIRMNAME FROM VW_ORDERNICK WHERE PARTNER_ID=:id";
        $result = self::getQueryResult($query, array(':id' => $this->idPartner));
        for ($i = 0, $n = count($result); $i < $n; $i++) {
            $row = $result[$i];
            $this->orders[] = new Orders($row->ID, $row->IDPARTNERSNICK, $row->DOCDATE, $row->NICKFIRMNAME);
        }
    }


    function getCompanyName()
    {
        return $this->companyName;
    }

    private function setCompanyName()
    {
        $query = "SELECT  FIRMNAME FROM PARTNERS WHERE ID=:id";
        $result = self::getQueryResult($query, array(':id' => $this->idPartner));
        $this->companyName = self::convertString($result[0]->FIRMNAME);
    }
}


class Orders extends Model
{
    private $id;
    private $idPartnersNick;
    private $date;
    private $nickFirmName;
    private $goods = [];
    private $sumOrder;


    function __construct($id, $idPartnersNick, $date, $nickFirmName)
    {
        $this->id = $id;
        $this->idPartnersNick = $idPartnersNick;
        $this->date = $date;
        $this->nickFirmName = $this->convertString($nickFirmName);
        $this->setGoods();

    }

    function getSumOrder()
    {
        for ($i = 0, $n = count($this->goods); $i < $n; $i++) {
            $good = $this->goods[$i];
            $sum += ($good->getQuantity()) * ($good->getPrice());
        }
        return $sum;
    }

    public function setGoods()
    {
        $query = 'SELECT * FROM VW_INTERNETORDERSDETAIL WHERE IDINTERNETORDER=:id';
        $result = $this->getQueryResult($query, array(':id' => $this->id));
        for ($i = 0, $n = count($result); $i < $n; $i++) {
            $row = $result[$i];
            $this->goods[] = new Goods($row->ID, $row->PARTNUM, $row->NAME, $row->PRICE, $row->QUANTITY);
        }

    }

    function getId()
    {
        return $this->id;
    }

    function getIdPartnersNick()
    {
        return $this->idPartnersNick;
    }

    function getNickFirmName()
    {
        return $this->nickFirmName;
    }

    function getDate()
    {
        return $this->date;
    }

    function getGoods()
    {
        return $this->goods;
    }

}

class Goods extends Model
{
    private $id;
    private $partnum;
    private $name;
    private $quantity;
    private $price;
    private $stocks;

    function __construct($id, $partnum, $name, $price, $quantity = null, $stock = null)
    {
        $this->id = $id;
        $this->partnum = $partnum;
        $this->name = $this->convertString($name);
        if ($quantity) {
            $this->quantity = $quantity;
        }

        if ($stock) {
            $this->stocks = $stock;
        }
        $this->price = $this->getFloat($price);
    }

    public
    function getStocks()
    {
        return $this->stocks;
    }

    function getId()
    {
        return $this->id;
    }

    function getPartnum()
    {
        return $this->partnum;
    }

    function getName()
    {
        return $this->name;
    }

    function getPrice()
    {
        return $this->price;
    }

    function getQuantity()
    {
        return $this->quantity;
    }

    private
    function getFloat($st)
    {
        if (strlen($st) == 0)
            return 0;
        $st[strpos($st, ',')] = '.';            //Позиция +
        $price_st = NULL;                       //Преобразованная строка
        for ($i = 0, $n = strlen($st); $i < $n; $i++):
            if ($st[$i])                        //Можно так $st[$i]?$price_st.=$st[$i]:false;
                $price_st .= $st[$i];
        endfor;
        return (float)$price_st;
    }


}

class Stock
{

    private $status = 'Нет в наличии';
    private $colorStatus = 2;
    private $main;
    private $weak;
    private $month;
    private $moreMonth;

    function __construct($main, $weak, $month, $moreMonth)
    {
        $this->main = $main;
        $this->weak = $weak;
        $this->month = $month;
        $this->moreMonth = $moreMonth;
        $this->setStatus();
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function getColorStatus()
    {
        return $this->colorStatus;
    }

    public function getMain()
    {
        return $this->main;
    }

    public function getWeak()
    {
        return $this->weak;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getMoreMonth()
    {
        return $this->moreMonth;
    }

    /**
     * Устанавливает наличие на складе.
     */
    private function setStatus()
    {
        $sumReceipts = $this->weak + $this->month + $this->moreMonth;
        if ($this->main) {
            $this->status = 'В наличии';
            $this->colorStatus = 3;
        } elseif ($sumReceipts > 0) {
            $this->status = 'Ожидает поступления';
            $this->colorStatus = 1;
        }
    }
}

class ChangeOrder extends Model
{
    private $idOrder;
    public $message;

    function __construct($idOrder)
    {
        $this->idOrder = $idOrder;
        if ($this->idOrder) {
            $this->deleteOrder();
        }
    }

    function getMessage()
    {
        echo $this->message;
    }

    function deleteOrder()
    {
        $query = "SELECT * FROM INTERNETORDERS WHERE ID=:id";
        $result = self::getQueryResult($query, array(':id' => $this->idOrder));
        if ($result[0]->IDGOODSORDERS) {
            $this->message = 'Заказ находится в обработке, для его удаления обратитесь к своему менеджеру';

        } else {
            $this->deleteSuccess();
            $this->message = 'Заказ успешно удален!';
        }
        return $this;
    }

    private function deleteSuccess()
    {
        $db = self::$base;
        $db->query('DELETE  FROM INTERNETORDERSITEMS WHERE IDINTERNETORDER=' . $this->idOrder);
        $db->query('DELETE FROM INTERNETORDERS WHERE ID=' . $this->idOrder);
    }

}

Model::getInstance();
if ($_REQUEST['deleteOrder']) {
    $orderDel = new ChangeOrder($_REQUEST['deleteOrder']);
    $orderDel->getMessage();
}

class Pagination
{
    private $countPage;
    private $countElement;

    function __construct($countPage, $countElement)
    {
        $this->countPage = $countPage;
        $this->countElement = $countElement;
    }

    function run($countPage, $countElement)
    {
        for ($i = 0, $pages = 0; $i < $countPage; $i++) {
            if ($i % $countElement == 0) {
                $pages++;
                
            }
        }
    }
}






