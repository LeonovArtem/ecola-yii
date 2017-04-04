<?php
$dbh = new PDO("odbc:SVU");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_REQUEST['NICK']) {
    $insert_nick = $dbh->prepare('INSERT INTO  INTERNETORDERS(IDPARTNERSNICK,DOCDATE) VALUES (?,current_timestamp)');
    $insert_nick->execute(array($_REQUEST['NICK']));

    $stmt = $dbh->prepare("INSERT INTO  INTERNETORDERSITEMS(IDINTERNETORDER, PARTNUM, QUANTITY) VALUES((select max(ID) from INTERNETORDERS), :pn , :quantity )");
    $stmt->bindParam('pn', $part_num);
    $stmt->bindParam('quantity', $quantity);

    for ($i = 0, $n = count($_REQUEST['ORDER']); $i < $n; $i++):
        $part_num = $_REQUEST['ORDER'][$i]['partNumber'];
        $quantity = $_REQUEST['ORDER'][$i]['count'];
        $stmt->execute();
    endfor;
}
echo 'Заказ успешно создан!';

