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

  // post query
  $res = $post->read();
  // count row
  $num = $res->rowCount();

  // check if any post
  if($num > 0) {
    // post array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'category' => $category,
            'post' => html_entity_decode($post)
        );

        // push to 'data'
        array_push($posts_arr['data'], $post_item);
    }

    // turn to json & output
    echo json_encode($posts_arr);

  } else {
    // no post
    echo json_encode(
        array('message' => 'No posts found')
    );
  }