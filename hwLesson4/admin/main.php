<?php
include 'templates/header.tmpl';
if ($_POST) {
  if ($_POST['login'] == 'admin' && $_POST['pwd'] == 'admin') {
    include 'templates/main_stat.tmpl';
    include 'templates/footer.tmpl';
  } else {
    alert("Не верный логин или пароль");
    header('Location:index.php');
  }

} else if ($_COOKIE['log'] == 'admin' && $_COOKIE['pw'] == 'admin') {
    include 'templates/main_stat.tmpl';
    include 'templates/footer.tmpl';
} else {
      // header('Location:index.php');
      print_r($_COOKIE);
}
