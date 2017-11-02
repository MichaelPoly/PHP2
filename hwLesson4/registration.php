<?php
    require_once 'functions.php';

    $link = db_connect('inet_shop');
if (!empty($_POST)) {
  $user2 = login($link, $_POST["login"], $_POST["password"]);
  if ($user2 == false){
    $user1 = registration($link, $_POST["first_name"], $_POST["second_name"], $_POST["last_name"],
    $_POST["email"], $_POST["phone"], $_POST["login"], $_POST["password"]);
    echo json_encode($user1);
    return json_encode($user1);
  } else return false;
}
