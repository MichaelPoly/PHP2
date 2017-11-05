<?php
  require_once 'functions.php';

  $order_num = $_POST['order_num'];
  $adress = $_POST['adress'];
  
  include 'templates/header.tmpl';

  addAdress($order_num, $adress);

  include 'templates/footer.tmpl';
