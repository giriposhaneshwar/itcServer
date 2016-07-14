<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');

// switched to new branch
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: *');

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: X-Requested-With');

// config db values
include './config.php';
include './libs/Database.php';

// loading main libraries
include './libs/Bootstrap.php';
include './libs/Controller.php';
include './libs/Model.php';

$start = new Bootstrap();
$start->init();
?>