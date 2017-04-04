<?php

/**
 * DB connect
 */
$dbh = new PDO("odbc:SVU");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$company = htmlspecialchars($_REQUEST['company']);
$passwordUser = htmlspecialchars($_REQUEST['password']);



if (!empty($company) && !empty($passwordUser)) {
    authorization($dbh, $company, $passwordUser);
}

function authorization($base, $company, $password)
{

    $result = $base->prepare('SELECT PARTNER_ID,LOGIN,PASSWORD FROM PARTNERSINFO WHERE LOGIN=:company AND PASSWORD=:password');
    $result->execute(array(':company' => $company, ':password' => $password));
    
    foreach ($result as $login) {
        $partner_id=array('partnersId'=>$login['PARTNER_ID']);

        echo json_encode($partner_id);


    }
    return false;
}
function getPartnerNik($ID)
{
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM PARTNERSNICKS WHERE PARTNER_ID = :userId');
    $stmt->execute(array(":userId" => $ID));
    $my_array = array();
    foreach ($stmt as $partner):
        $firm_name = iconv("CP1251", "UTF-8", $partner['NICKFIRMNAME']);            //Название компании
        array_push($my_array, array(
            'NIKS_ID' => $partner['ID'],
            'NIKS' => $firm_name
        ));
    endforeach;
    return json_encode($my_array);
}


/**
 * @param $search {string}
 * @return string Строка в нижнем регистре с кодировкой CP1251
 */
function prepareLike($search)
{
    $search = trim(strtolower($search));                    //Преобразуем входные данные к нижнему регистру
    $searchConvertCP = iconv("UTF-8", "CP1251", $search);
    $like = "%$searchConvertCP%";
    return $like;
}





