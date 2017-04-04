<?php
/**
 * Запускаем db2admin.exe
 * И даем такую команду(Устанавливает utf-8 кодировку):
 * db2set -g db2codepage=1208
 */
return [
    'class' => 'edgardmessias\db\ibm\db2\Connection',
    'dsn' => 'odbc:SVU',
    'defaultSchema' => '',
    'isISeries'     => false

];