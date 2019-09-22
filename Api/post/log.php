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

    // get raw user info
    $data = json_decode(file_get_contents("php://input"));

    // login details
    $login->user = $data->user;
    $login->pass = $data->pass;

    $login->login_user();