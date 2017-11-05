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
$order_num = 'C'. $clientid[2] .'D'. $dateNow;
foreach ($id as $key => $value) {
  orderConfirm($order_num, $value);
}

include 'templates/add_adress.tmpl';
include 'templates/footer.tmpl';
