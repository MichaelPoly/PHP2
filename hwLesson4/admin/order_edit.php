<?php
  require_once 'function.php';
  include 'templates/header.tmpl';
  $order_num1 = $_GET['numId'];
echo "$order_num1";
  $items = readOrder($order_num1);
  $clientId = $items[0]['clientid'];
  $orderState = $items[0]['order_state'];
  $numRows = count($items);
  $j = 0;
  foreach ($items as $key => $value) {
    foreach ($value as $key => $value) {
      $$key[$j] = $value;
    }
    $j++;
  }
  for ($i=0; $i < $numRows; $i++) {
    $order[$i] = array( 'item_name' => $item_name[$i],
                      'quantity' => $quantity[$i],
                      'price' => $price[$i] * $quantity[$i],
                  );
  }
  $client = readClientInfo($clientId);
  $firstName = $client[0]['first_name'];
  $secondName = $client[0]['second_name'];
  $lastName = $client[0]['last_name'];
  $phone = $client[0]['phone'];
  $email = $client[0]['email'];
  $adress = $adress[0];
  // print_r($items);
  // echo "<br>";
  // print_r($client);
  // echo "<br>";
  // echo "$firstName";
  // echo "<br>";
  // echo "$secondName";
  // echo "<br>";
  // echo "$lastName";
  // echo "<br>";
  // echo "$phone";
  // echo "<br>";
  // echo "$email";
  // echo "<br>";
  // echo "$adress";
  // echo "<br>";
  require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
  // указывае где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('templates');

  // инициализируем Twig
  $twig = new Twig_Environment($loader);

  // подгружаем шаблон
  $template = $twig->loadTemplate('order_info.tmpl');

  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  echo $template->render(array(
    'items' => $order,
    'orderNum' => $order_num1,
    'firstName' => $firstName,
    'secondName' => $secondName,
    'lastName' => $lastName,
    'phone' => $phone,
    'email' => $email,
    'adress' => $adress,
    'order_state' => $orderState,
  ));

} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}


  include 'templates/footer.tmpl';
