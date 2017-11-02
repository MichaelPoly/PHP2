<?php
require_once 'functions.php';
$link = db_connect('inet_shop');
if (!empty($_POST)){
  $basket = show_basket($link, $_POST['userid']);
  echo json_encode($basket);
  return json_encode($basket);
}
