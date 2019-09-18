<?php
  // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config_file/db.php';
  include_once '../../modules/post.php';

  // instanciate db & connect
  $database = new database();
  $db = $database->connect();

  // instantiate post
  $post = new post($db);

  // get id
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // get single post
  $post->read_single();

  //create array
  $post_arr = array(
      'id' => $post->id,
      'category' => $post->category,
      'post' => $post->post
  );

  // turn to json format
  print_r(json_encode($post_arr));