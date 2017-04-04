<?php
$ID = $_REQUEST['id'];

$dbh = new PDO("odbc:SVU");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $dbh->prepare('SELECT * FROM PARTNERSNICKS WHERE PARTNER_ID = :userId');
$stmt->execute(array(":userId"=>$ID));
$my_array = array();
foreach ($stmt as $partner):
    $firm_name = iconv("CP1251", "UTF-8", $partner['NICKFIRMNAME']);            //Название компании
    array_push($my_array, array(
        'NIKS_ID' => $partner['ID'],
        'NIKS' => $firm_name
    ));
endforeach;
echo json_encode($my_array);
