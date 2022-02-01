<?php
require_once("config.php");
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$dbname = DB_NAME;
global $db;
setlocale(LC_ALL,"ru_RU.UTF8");
$db = new mysqli($host, $user, $pass, $dbname, 3306);
$db->set_charset('utf8mb4');
if ($db->connect_errno) {

    echo "Не удалось подключиться к MySQL: (" . $db->connect_errno . ") " . $db->connect_error;

    exit;

}
