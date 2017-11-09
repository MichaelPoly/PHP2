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
