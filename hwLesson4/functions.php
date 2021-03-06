<?php
function createDb($dbName){
  define('MYSQL_SERVER', 'localhost');
  define('MYSQL_USER', 'root');
  define('MYSQL_PASSWORD', '');
  $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD)
          or die("Error: ".mysqli_error($link));
          if (!mysqli_set_charset($link, "utf8")){
            printf("Error: ".mysqli_error($link));
          }
  $query = "CREATE DATABASE $dbName CHARACTER SET utf8 COLLATE utf8_general_ci";
  $result = mysqli_query($link, $query);
  if ($result) echo "База данных создана";
  mysqli_close($link);
}
function db_connect($dbName)
{
  define('MYSQL_SERVER', 'localhost');
  define('MYSQL_USER', 'root');
  define('MYSQL_PASSWORD', '');
  define('MYSQL_DB', "$dbName");
  $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
    or die("Error: ".mysqli_error($link));
    if (!mysqli_set_charset($link, "utf8")){
      printf("Error: ".mysqli_error($link));
    }
return $link;
}

function get_table($link, $table, $limit)
{
  $query = "SELECT * FROM $table LIMIT $limit";
  $result = mysqli_query($link, $query);
  if (!$result) die(mysqli_error($link));
  $table_items = array();
  $n = mysqli_num_rows($result);
  if ($n >= (int)$limit) {
    $m = $limit;
  } else {
    $m = $n;
  }

  for ($i=0; $i < $m; $i++) {
    $row = mysqli_fetch_assoc($result);
    $table_items[] = $row;
  }
  return $table_items;
}
function tableCreate($link, $tableName)
{
  $query = "CREATE TABLE $tableName";
  $result = mysqli_query($link, $query);
  if ($result) echo "Таблица успешно создана";
  echo "<br>";
}
function add_item($link, $articul, $item_name, $quantity_stock, $price, $main_photo, $describtion, $img_folder)
{
  $item = "INSERT INTO item(articul, item_name, quantity_stock, price, main_photo, describtion, img_folder) VALUES('%s', '%s', '%d', '%d', '%s', '%s', '%s')";
  $query = sprintf($item, mysqli_real_escape_string($link, $articul), mysqli_real_escape_string($link, $item_name),
  mysqli_real_escape_string($link, $quantity_stock), mysqli_real_escape_string($link, $price),
  mysqli_real_escape_string($link, $main_photo), mysqli_real_escape_string($link, $describtion), mysqli_real_escape_string($link, $img_folder));
  $result = mysqli_query($link, $query);
  if (!$result) die(mysqli_error($link));
  return true;
}
function add_client($link, $first_name, $second_name, $last_name, $phone, $email, $login, $password)
{
    $client = "INSERT INTO clients(first_name, second_name, last_name, phone, email, login, password) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s')";
    $query = sprintf($client, mysqli_real_escape_string($link, $first_name), mysqli_real_escape_string($link, $second_name), mysqli_real_escape_string($link, $last_name),
    mysqli_real_escape_string($link, $phone), mysqli_real_escape_string($link, $email), mysqli_real_escape_string($link, $login), mysqli_real_escape_string($link, $password));
    $result = mysqli_query($link, $query);
    if (!$result) die(mysqli_error($link));
    return true;
}
function login($link, $login, $password){
  $login = trim($login);
  $password = trim($password);
  if ($login == '' || $password == ''){
    return false;
  } else {
    $query = sprintf("SELECT * FROM clients WHERE login='%s'", $login);
    $result = mysqli_query($link, $query);
    if (!$result) die(mysqli_error($link));
    $user = mysqli_fetch_assoc($result);
    if ($user['login'] == $login && $user['password'] == $password) {
      return $user;
    } else return false;
  }
}
function registration($link, $name, $second_name, $last_name, $e_mail, $phone, $login, $password)
{
  if ($second_name == '') $second_name = NULL;
  if ($last_name == '') $last_name = NULL;
  if ($phone == '') $phone = NULL;
  $q = "INSERT INTO clients(first_name, second_name, last_name, email, phone, login, password) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s')";
  $query = sprintf($q, mysqli_real_escape_string($link, $name), mysqli_real_escape_string($link, $second_name),
  mysqli_real_escape_string($link, $last_name), mysqli_real_escape_string($link, $e_mail), mysqli_real_escape_string($link, $phone),
  mysqli_real_escape_string($link, $login), mysqli_real_escape_string($link, $password));
  $result = mysqli_query($link, $query);
  if (!$result) die(mysqli_error($link));
  $query1 = sprintf("SELECT * FROM clients WHERE login='%s'", $login);
  $result1 = mysqli_query($link, $query1);
  if (!$result1) die(mysqli_error($link));
  $user3 = mysqli_fetch_assoc($result1);
  return $user3;
}
function add_to_basket($link, $item, $quantity, $price, $userid)
{
  date_default_timezone_set('Europe/Moscow');
  $dateNow = date('Y-m-d');
  $userid = (int)$userid;
  $q = "INSERT INTO orders(itemid, clientid, quantity, price, confirmed, payed, order_state, `date`)
  VALUES('%d', '%d', '%d', '%d', '%s', '%s', '%s', '%s')";
  $query = sprintf($q, mysqli_real_escape_string($link, $item), mysqli_real_escape_string($link, $userid),
  mysqli_real_escape_string($link, $quantity), mysqli_real_escape_string($link, $price),
  mysqli_real_escape_string($link, false), mysqli_real_escape_string($link, false),
  mysqli_real_escape_string($link, 'new'), mysqli_real_escape_string($link, $dateNow));
  $result = mysqli_query($link, $query);
  if (!$result) die(mysqli_error($link));
}
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','inet_shop');
define('DB_USER','root');
define('DB_PASS','');
function orderConfirm($order_num, $orderId)
{
  try
  {
  	$connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
  	$db = new PDO($connect_str,DB_USER,DB_PASS);
    $num_rows = $db->exec("UPDATE `orders` SET order_num='" . $order_num . "' WHERE id='" . $orderId . "'");
    $num_rows1 = $db->exec("UPDATE `orders` SET order_state='in_progress' WHERE id='" . $orderId . "'");
    $num_rows2 = $db->exec("UPDATE `order_stat` SET order_state_o='in_progress' WHERE order_num_o='" . $order_num . "'");
  }
  catch(PDOException $e)
  {
  	die("Error: ".$e->getMessage());
  }
}
function addAdress($order_num, $adress)
{
  try
  {
  	$connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
  	$db = new PDO($connect_str,DB_USER,DB_PASS);
    $num_rows1 = $db->exec("UPDATE `orders` SET adress='" . $adress . "' WHERE order_num='" . $order_num . "'");
    $num_rows2 = $db->exec("UPDATE `order_stat` SET adress_o='" . $adress . "' WHERE order_num_o='" . $order_num . "'");
  }
  catch(PDOException $e)
  {
  	die("Error: ".$e->getMessage());
  }
}
function add_user_history($clientid)
{
  try
  {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
    $db = new PDO($connect_str,DB_USER,DB_PASS);
    $rows = $db->exec("INSERT INTO `user_history` (`client_id_h`, `item_id1`, `item_id2`, `item_id3`, `item_id4`, `item_id5`) VALUES
    ('$clientid', null, null, null, null, null)
    ");
  }
  catch(PDOException $e)
  {
    die("Error: ".$e->getMessage());
  }
}
function add_new_order($order_num, $clientid, $total_price)
{
  try
  {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
    $db = new PDO($connect_str,DB_USER,DB_PASS);
    date_default_timezone_set('Europe/Moscow');
    $start_date = date('Y-m-d H:i');
    $rows = $db->exec("INSERT INTO `order_stat` (`order_num_o`, `client_id_o`, `total_price`, `confirm_date`, `order_state_o`) VALUES
    ('$order_num', '$clientid', '$total_price', '$start_date', 'in_progress')
    ");
    $num_rows = $db->exec("UPDATE `orders` SET confirmed='true' WHERE order_num='" . $order_num . "'");
  }
    catch(PDOException $e)
    {
    die("Error: ".$e->getMessage());
    }
}
function readHistory($clientid)
{
  try
  {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
    $db = new PDO($connect_str,DB_USER,DB_PASS);
    $result = $db->query("SELECT * FROM user_history WHERE client_id_h='$clientid'");
    while($row = $result->fetch(PDO::FETCH_ASSOC));
    return $row;
  }
  catch(PDOException $e)
  {
    die("Error: ".$e->getMessage());
  }
}
function show_basket($link, $userid)
{
  $query = sprintf("SELECT * FROM orders INNER JOIN item ON orders.itemid=item.item_id WHERE clientid='%d' AND order_state='%s'", $userid, 'new');
  $result = mysqli_query($link, $query);
  if (!$result) die(mysqli_error($link));
  $basket_items = array();
  $n = mysqli_num_rows($result);
  for ($i=0; $i < $n; $i++) {
    $row = mysqli_fetch_assoc($result);
    $basket_items[] = $row;
  }
  return $basket_items;
}
  function del_from_basket($link, $id)
  {
    $id = (int)$id;
    $query = sprintf("DELETE FROM orders WHERE id=%d", $id);
    $result = mysqli_query($link, $query);
    if (!$result) die(mysqli_error($link));
    return mysqli_affected_rows($link);
  }
  function get_user_by_order($order_num)
  {
    try
    {
      $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
      $db = new PDO($connect_str,DB_USER,DB_PASS);
      $result = $db->query("SELECT `client_id_o` FROM order_stat WHERE order_num_o='$order_num'");
      $row = $result->fetch(PDO::FETCH_ASSOC);
      return $row;
    }
    catch(PDOException $e)
    {
      die("Error: ".$e->getMessage());
    }
  }
  function get_user_by_id($client_id)
  {
    try
    {
      $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
      $db = new PDO($connect_str,DB_USER,DB_PASS);
      $result = $db->query("SELECT * FROM clients WHERE id='$client_id'");
      $row = $result->fetch(PDO::FETCH_ASSOC);
      return $row;
    }
    catch(PDOException $e)
    {
      die("Error: ".$e->getMessage());
    }
  }
