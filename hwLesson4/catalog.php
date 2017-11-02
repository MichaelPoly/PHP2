<?php
  require_once 'functions.php';

  $link = db_connect('inet_shop');
  $limit = $_POST['limit'];
  $table_items = get_table($link, 'item', $limit);
  echo json_encode($table_items);
  mysqli_close($link);
