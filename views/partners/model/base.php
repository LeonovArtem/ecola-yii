<?php
$dbh = new PDO("odbc:SVU");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);