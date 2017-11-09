<?php
require_once 'functions.php';

$link = db_connect('inet_shop');
$userid = $_POST['userid'];
$orderItems = show_basket($link, $userid);

include 'templates/header.tmpl';
$i = 0;
foreach ($orderItems as $key => $value) {
  foreach ($value as $key => $value) {
    $$key[$i] = $value;
    // print_r($i);
    // echo " - ";
    // print_r($key);
    // echo " - ";
    // print_r($value);
    // echo "<br>";
    $i++;
  }
}
date_default_timezone_set('Europe/Moscow');
$dateNow = date('YmdHi');
$order_num = 'C'. $clientid[3] .'D'. $dateNow;
foreach ($id as $key => $value) {
  orderConfirm($order_num, $value);
}
$k = 0;
foreach ($price as $key => $value) {
  $tot_price[$k] = $value;
  $k++;
}
$n = 0;
foreach ($quantity as $key => $value) {
  $tot_quantity[$n] = $value;
  $n++;
}
$total_price = 0;
for ($nn=0; $nn < $n; $nn++) {
  $total_price = $total_price + (int)$tot_price[$nn] * (int)$tot_quantity[$nn];
}
add_new_order($order_num, $clientid[3], $total_price);
include 'templates/add_adress.tmpl';
include 'templates/footer.tmpl';
