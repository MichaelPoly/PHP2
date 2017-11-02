<?php
  require_once 'functions.php';
  $link = db_connect('inet_shop');
  if (!empty($_POST)){
    add_to_basket($link, $_POST['itemid'], $_POST['quantity'], $_POST['price'], $_POST['userid']);
    echo true;
    // header("Location: catalog.html");
  }
