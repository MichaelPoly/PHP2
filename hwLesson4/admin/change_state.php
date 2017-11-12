<?php
  require_once 'function.php';
  $newState = $_GET['state'];
  $order_num = $_GET['order_num'];
  chenge_order_state($order_num, $newState);
  // setcookie("log", "admin", time() + 200);
  // setcookie("pw", "admin", time() + 200);
  header('Location:order_control.php');

  // echo "$newState";
  // echo "$order_num";
