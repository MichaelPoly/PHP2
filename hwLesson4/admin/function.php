<?php
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','inet_shop');
define('DB_USER','root');
define('DB_PASS','');

function readOrders()
{
  try
  {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
    $db = new PDO($connect_str,DB_USER,DB_PASS);
    $result = $db->query("SELECT * FROM order_stat");
    $row1 = array();
    $i = 0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $row1[$i] = $row;
    $i++;
    }
    return $row1;
  }
  catch(PDOException $e)
  {
    die("Error: ".$e->getMessage());
  }
}
function readOrder($order_num)
{
  try
  {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
    $db = new PDO($connect_str,DB_USER,DB_PASS);
    $result = $db->query("SELECT * FROM orders INNER JOIN item ON orders.itemid=item.item_id WHERE order_num='$order_num'");
    $row1 = array();
    $i = 0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $row1[$i] = $row;
    $i++;
    }
    return $row1;
  }
  catch(PDOException $e)
  {
    die("Error: ".$e->getMessage());
  }
}
function readClientInfo($clientId)
{
  try
  {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
    $db = new PDO($connect_str,DB_USER,DB_PASS);
    $result = $db->query("SELECT * FROM clients WHERE id='$clientId'");
    $row1 = array();
    $i = 0;
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $row1[$i] = $row;
    $i++;
    }
    return $row1;
  }
  catch(PDOException $e)
  {
    die("Error: ".$e->getMessage());
  }
}
function chenge_order_state($order_num, $order_state)
{
  try
  {
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8';
    $db = new PDO($connect_str,DB_USER,DB_PASS);
    date_default_timezone_set('Europe/Moscow');
    $start_date = date('Y-m-d H:i');
    $row = $db->exec("UPDATE `orders` SET order_state='" . $order_state . "' WHERE order_num='" . $order_num . "'");
    $row1 = $db->exec("UPDATE `order_stat` SET order_state_o='" . $order_state . "' WHERE order_num_o='" . $order_num . "'");
  }
    catch(PDOException $e)
    {
    die("Error: ".$e->getMessage());
    }
}
