<?php
require_once 'functions.php';
$link = db_connect('inet_shop');
if (!empty($_POST)){
  del_from_basket($link, $_POST['orderid']);
  echo true;

}
