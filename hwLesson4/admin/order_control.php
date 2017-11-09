<?php
  require_once 'function.php';
  // $link = db_connect('inet_shop');
  include 'templates/header.tmpl';

  $orders1 = readOrders();
  $j = 0;
  foreach ($orders1 as $key => $value) {
    foreach ($value as $key => $value) {
      $$key[$j] = $value;
    }
    $j++;
  }
  print_r($order_num);
  include 'templates/order_control.tmpl';
  include 'templates/footer.tmpl';
