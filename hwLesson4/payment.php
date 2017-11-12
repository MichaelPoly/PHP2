<?php
  require_once 'functions.php';

  $order_num = $_POST['order_num'];
  $adress = $_POST['adress'];

  include 'templates/header.tmpl';

  addAdress($order_num, $adress);
  $userId = get_user_by_order($order_num);
  $ui = $userId['client_id_o'];
  setcookie("ui", "$ui", time() + 200);
  print_r($userId);
  include 'templates/payment_box.tmpl';

  include 'templates/footer.tmpl';
