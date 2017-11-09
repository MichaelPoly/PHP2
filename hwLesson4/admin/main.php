<?php
include 'templates/header.tmpl';
if ($_POST) {
  if ($_POST['login'] == 'admin' && $_POST['pwd'] == 'admin') {
    include 'templates/main_stat.tmpl';
    include 'templates/footer.tmpl';
  } else {
    echo "Не верный логин или пароль";
    header('Location:index.php');
  }

}
