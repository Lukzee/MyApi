<?php
  // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config_file/db.php';
  include_once '../../modules/post.php';

  // instanciate db & connect
  $database = new database();
  $db = $database->connect();

  // instantiate post
  $post = new post($db);

  // get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $post->category = $data->category;
  $post->post = $data->post;

  // create post
  if($post->create()) {
      echo json_encode(
          array('message' => 'Post created successfully')
      );
  } else {
    echo json_encode(
        array('message' => 'Error Post not created')
    );
  }