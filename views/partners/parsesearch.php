<?php
require_once('ordersnick.php');

class findGoods extends Model
{
    protected $searchString;

    function __construct($search)
    {
        $this->searchString = $search;
    }

    public function searchCatalog()
    {
        $pattern = '/\w+/';
        $countMatch = preg_match_all($pattern, $this->searchString, $matches);
        $test = $matches;
        $currentMatch = $matches[0];

        $query = ("SELECT * FROM VW_INTERNETGOODS  WHERE  (LOWER(NAME) LIKE :search OR LOWER(PARTNUM) LIKE :partnum) AND PRICE IS NOT NULL    ORDER BY ID");
        for ($i = 0; $i < $countMatch; $i++) {
            $searchStr = strtolower($currentMatch[$i]);
            $searchRu = iconv("UTF-8", "CP1251", $searchStr);
            $like = "%$searchRu%";
            $findGoods = static::getQueryResult($query, array(':search' => $like, ':partnum' => $like));
            if ($findGoods) {
                if (count($findGoods) != $countMatch) {
                    for ($j = 0, $countResult = count($findGoods); $j < $countResult; $j++) {
                        $this->createGood($findGoods[$j]);
                    }
                } else {
                    $this->createGood($findGoods[$i]);
                }
            }
        }
    }

    private function createGood($arrGoodBase)
    {
        $result = $arrGoodBase;
        $stock = new Stock(
            $result->MAINSTOCK,
            $result->WEAK,
            $result->MONTH,
            $result->MOREMONTH);
        $good = new Goods(
            $result->ID,
            $result->PARTNUM,
            $result->NAME,
            $result->PRICE,
            null,
            $stock);
        require('views/Goods.tpl.php');
    }
}
//PrintTimeMem('Начало');//Первый вызов в начале скрипта инициализирует переменную $MTime
//$str = $_REQUEST['search_text'];
$str='ecola';
$findGood = new findGoods($str);
$findGood->searchCatalog();
//PrintTimeMem('Конец');



function PrintTimeMem($Status = ''){
    static $MTime = 0;
    static $Mem = 0;
    $Out = '<br>'.$Status;
    if($MTime > 0){
        $Out .= ' Time: '.(microtime(true) - $MTime);
    }
    $Out .= ' Memory: '.number_format(memory_get_usage(), '0', '.', ' ');
    if($Mem > 0){
        $Out .= ' ['.number_format(memory_get_usage() - $Mem, '0', '.', ' ').']';
    }
    $MTime = microtime(true);
    $Mem = memory_get_usage();
    echo $Out;
}


