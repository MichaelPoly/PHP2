<?php
  require_once 'functions.php';


  include 'templates/header.tmpl';
  $client_id_lk = $_POST['clientIdLk'];
  // echo "$client_id_lk";
  // print_r($_POST);
  $user_info = get_user_by_id($client_id_lk);
  print_r($user_info);
  echo "<br>";
  $first_name_lk = $user_info['first_name'];
  $second_name_lk = $user_info['second_name'];
  $last_name_lk = $user_info['last_name'];
  $phone_lk = $user_info['phone'];
  $email_lk = $user_info['email'];

  echo "$first_name_lk<br>";
  echo "$second_name_lk<br>";
  echo "$last_name_lk<br>";
  echo "$phone_lk<br>";
  echo "$email_lk<br>";
  require_once 'Twig/Autoloader.php';
  Twig_Autoloader::register();

  try {
    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    // подгружаем шаблон
    $template = $twig->loadTemplate('lk_info.tmpl');

    // передаём в шаблон переменные и значения
    // выводим сформированное содержание
    echo $template->render(array(
      'first_name' => $first_name_lk,
      'second_name' => $second_name_lk,
      'last_name' => $last_name_lk,
      'phone' => $phone_lk,
      'email' => $email_lk,
    ));

  } catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
  }
  include 'templates/footer.tmpl';
