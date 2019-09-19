<?php
  // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // set ID to update
  $post->id = $data->id;

  $post->category = $data->category;
  $post->post = $data->post;

  // update post
  if($post->update()) {
      echo json_encode(
          array('message' => 'Post updated successfully')
      );
  } else {
    echo json_encode(
        array('message' => 'Error Post not updated')
    );
  }