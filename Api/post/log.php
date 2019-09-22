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

    // login query
    $res = $login->login_user();
    
    // count row
    $num = $res->rowCount();

    if($num == 1) {
        if($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = $row['user'];
            echo json_encode(
                array('message' => 'Welcome Mr/Mrs ' . $_SESSION['user'])
            );
        }
    } else {
        echo json_encode(
            array('message' => 'Incorrect Username or Password')
        );
    }