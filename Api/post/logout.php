<?php
SESSION_START();

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config_file/db.php';
include_once '../../modules/login.php';

// instanciate db & connect
$database = new database();
$db = $database->connect();

// instantiate login
$login = new login($db);

$login->logout();