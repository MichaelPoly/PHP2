<?php

require_once 'functions.php';

  $link = db_connect('inet_shop');
  if (!empty($_POST)) {
  $user = login($link, $_POST["login"], $_POST["password"]);
  echo json_encode($user);
  return json_encode($user);
  }
