<?php

$log = $_SERVER['SERVER_ADDR'];
$sr = $_SERVER['HTTP_HOST'];

// echo "Log : " . $log . " \n SR : " . $sr;
// echo "Server REMOTE_ADDR, HTTP_HOST : ".$sr." /// ".$log;
// echo "new line addes";
// local credentials
define("DB_TYPE", "mysql");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "itt");

// netword credentaials
// $log == "111.118.215.83") {
//    define("DB_TYPE", "mysql");
//    define("DB_HOST", "localhost");
//    define("DB_USER", "icsitxjx_itdc");
//    define("DB_PASS", "Netgear@28$");
//    define("DB_NAME", "icsitxjx_itdc");
?>
