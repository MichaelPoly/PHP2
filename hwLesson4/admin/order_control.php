<?php
  require_once 'function.php';
  // $link = db_connect('inet_shop');
  include 'templates/header.tmpl';

  $orders1 = readOrders();
  $j = 0;
  foreach ($orders1 as $key => $value) {
    foreach ($value as $key => $value) {
      $$key[$j] = $value;
    }
    $j++;
  }
for ($i=0; $i < $j; $i++) {
  $order[$i] = array( 'order_num' => $order_num_o[$i],
                  'client_id' => $client_id_o[$i],
                  'total_price' => $total_price[$i],
                  'adress' => $adress_o[$i],
                  'confirm_date' => $confirm_date[$i],
                  'order_state' => $order_state_o[$i],);
}
  print_r($order);
  require_once 'Twig/Autoloader.php';
  Twig_Autoloader::register();

  try {
    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');

    // инициализируем Twig
    $twig = new Twig_Environment($loader);

    // подгружаем шаблон
    $template = $twig->loadTemplate('order_control.tmpl');

    // передаём в шаблон переменные и значения
    // выводим сформированное содержание
    echo $template->render(array(
      'order' => $order,
    ));

  } catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
  }

  include 'templates/footer.tmpl';
