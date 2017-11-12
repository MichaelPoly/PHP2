<?php
require_once 'functions.php';

$dbName = 'inet_shop';
createDb($dbName);
$link = db_connect($dbName);
$tableName = "clients(id INT NOT NULL AUTO_INCREMENT,
              first_name VARCHAR(30) NOT NULL,
              second_name VARCHAR(30) NOT NULL,
              last_name VARCHAR(30) NOT NULL,
              phone VARCHAR(30) NOT NULL,
              email VARCHAR(30) NOT NULL,
              login VARCHAR(30) NOT NULL,
              password VARCHAR(30) NOT NULL,
              PRIMARY KEY (`id`))";
tableCreate($link, $tableName);
add_client($link, "Новый Посетитель", "Новый", "Новый", "", "newuser@newuser.ru", "newuser", "1");


$tableName11 = "user_history(id INT NOT NULL AUTO_INCREMENT,
              client_id_h INT NOT NULL,
              item_id1 INT NULL,
              item_id2 INT NULL,
              item_id3 INT NULL,
              item_id4 INT NULL,
              item_id5 INT NULL,
              PRIMARY KEY (`id`))";
tableCreate($link, $tableName11);
$query = "ALTER TABLE user_history ADD FOREIGN KEY(`client_id_h`) REFERENCES clients(`id`) ON UPDATE CASCADE ON DELETE CASCADE";
mysqli_query($link, $query);
$tableName12 = "order_stat(order_num_o VARCHAR(30) NOT NULL,
              client_id_o INT NOT NULL,
              total_price INT NOT NULL,
              adress_o VARCHAR(1024) NOT NULL,
              confirm_date DATETIME NOT NULL,
              send_date DATETIME NULL,
              deliver_date DATETIME NULL,
              end_date DATETIME NULL,
              order_state_o VARCHAR(30) NULL,
              PRIMARY KEY (`order_num_o`))";
tableCreate($link, $tableName12);
$query = "ALTER TABLE order_stat ADD FOREIGN KEY(`client_id_o`) REFERENCES clients(`id`) ON UPDATE CASCADE ON DELETE CASCADE";
mysqli_query($link, $query);

$tableName1 = "item(item_id INT NOT NULL AUTO_INCREMENT,
              articul VARCHAR(30) NOT NULL,
              item_name VARCHAR(30) NOT NULL,
              quantity_stock INT NOT NULL,
              price INT NOT NULL,
              main_photo VARCHAR(225) NOT NULL,
              describtion VARCHAR(1024) NOT NULL,
              img_folder varchar(225),
              PRIMARY KEY (`item_id`))";
tableCreate($link, $tableName1);
add_item($link, "TN001", "Товар1", "50", "2990", "elefant1.png", "Описание товара номер 1\nхарактеристики товара номер 1", "img/TN001/");
add_item($link, "TN002", "Товар2", "35", "3990", "elefant1.png", "Описание товара номер 2\nхарактеристики товара номер 2", "img/TN002/");
add_item($link, "TN003", "Товар3", "20", "3190", "elefant1.png", "Описание товара номер 3\nхарактеристики товара номер 3", "img/TN003/");
add_item($link, "TN004", "Товар4", "60", "4090", "elefant1.png", "Описание товара номер 4\nхарактеристики товара номер 4", "img/TN004/");
add_item($link, "TN005", "Товар5", "90", "3490", "elefant1.png", "Описание товара номер 5\nхарактеристики товара номер 5", "img/TN005/");
add_item($link, "TN006", "Товар6", "2", "5690", "elefant1.png", "Описание товара номер 6\nхарактеристики товара номер 6", "img/TN006/");
add_item($link, "TN007", "Товар7", "4", "990", "elefant1.png", "Описание товара номер 7\nхарактеристики товара номер 7", "img/TN007/");
add_item($link, "TN008", "Товар8", "7", "1290", "elefant1.png", "Описание товара номер 8\nхарактеристики товара номер 8", "img/TN008/");
add_item($link, "TN009", "Товар9", "9", "1990", "elefant1.png", "Описание товара номер 9\n характеристики товара номер 9", "img/TN009/");
add_item($link, "TN010", "Товар10", "15", "5990", "elefant1.png", "Описание товара номер 10\nхарактеристики товара номер 10", "img/TN010/");
add_item($link, "TN011", "Товар11", "20", "2990", "elefant1.png", "Описание товара номер 11\nхарактеристики товара номер 11", "img/TN011/");
add_item($link, "TN012", "Товар12", "22", "1990", "elefant1.png", "Описание товара номер 12\nхарактеристики товара номер 12", "img/TN012/");
add_item($link, "TN013", "Товар13", "22", "1390", "elefant1.png", "Описание товара номер 13\nхарактеристики товара номер 13", "img/TN013/");
add_item($link, "TN014", "Товар14", "22", "4390", "elefant1.png", "Описание товара номер 14\nхарактеристики товара номер 14", "img/TN014/");
add_item($link, "TN015", "Товар15", "22", "3390", "elefant1.png", "Описание товара номер 15\nхарактеристики товара номер 15", "img/TN015/");
add_item($link, "TN016", "Товар16", "22", "1390", "elefant1.png", "Описание товара номер 16\nхарактеристики товара номер 16", "img/TN016/");
add_item($link, "TN017", "Товар17", "22", "1290", "elefant1.png", "Описание товара номер 17\nхарактеристики товара номер 17", "img/TN017/");
add_item($link, "TN018", "Товар18", "22", "1890", "elefant1.png", "Описание товара номер 18\nхарактеристики товара номер 18", "img/TN018/");
add_item($link, "TN019", "Товар19", "92", "1990", "elefant1.png", "Описание товара номер 19\nхарактеристики товара номер 19", "img/TN019/");
add_item($link, "TN020", "Товар20", "92", "2990", "elefant1.png", "Описание товара номер 20\nхарактеристики товара номер 20", "img/TN020/");
add_item($link, "TN021", "Товар21", "92", "2290", "elefant1.png", "Описание товара номер 21\nхарактеристики товара номер 21", "img/TN021/");
add_item($link, "TN022", "Товар22", "22", "2190", "elefant1.png", "Описание товара номер 22\nхарактеристики товара номер 22", "img/TN022/");
add_item($link, "TN023", "Товар23", "22", "3190", "elefant1.png", "Описание товара номер 23\nхарактеристики товара номер 23", "img/TN023/");
add_item($link, "TN024", "Товар24", "42", "3490", "elefant1.png", "Описание товара номер 24\nхарактеристики товара номер 24", "img/TN024/");
add_item($link, "TN025", "Товар25", "42", "2490", "elefant1.png", "Описание товара номер 25\nхарактеристики товара номер 25", "img/TN025/");
add_item($link, "TN026", "Товар26", "62", "1490", "elefant1.png", "Описание товара номер 26\nхарактеристики товара номер 26", "img/TN026/");
add_item($link, "TN027", "Товар27", "62", "4490", "elefant1.png", "Описание товара номер 27\nхарактеристики товара номер 27", "img/TN027/");
add_item($link, "TN028", "Товар28", "562", "490", "elefant1.png", "Описание товара номер 28\nхарактеристики товара номер 28", "img/TN028/");
add_item($link, "TN029", "Товар29", "262", "2490", "elefant1.png", "Описание товара номер 29\nхарактеристики товара номер 29", "img/TN029/");
add_item($link, "TN030", "Товар30", "262", "990", "elefant1.png", "Описание товара номер 30\nхарактеристики товара номер 30", "img/TN030/");
add_item($link, "TN031", "Товар31", "262", "1990", "elefant1.png", "Описание товара номер 31\nхарактеристики товара номер 31", "img/TN031/");
add_item($link, "TN032", "Товар32", "162", "1290", "elefant1.png", "Описание товара номер 32\nхарактеристики товара номер 32", "img/TN032/");
add_item($link, "TN033", "Товар33", "162", "1390", "elefant1.png", "Описание товара номер 33\nхарактеристики товара номер 33", "img/TN033/");
add_item($link, "TN034", "Товар34", "462", "1490", "elefant1.png", "Описание товара номер 34\nхарактеристики товара номер 34", "img/TN034/");
add_item($link, "TN035", "Товар35", "462", "1590", "elefant1.png", "Описание товара номер 35\nхарактеристики товара номер 35", "img/TN035/");
add_item($link, "TN036", "Товар36", "462", "1690", "elefant1.png", "Описание товара номер 36\nхарактеристики товара номер 36", "img/TN036/");
add_item($link, "TN037", "Товар37", "462", "1790", "elefant1.png", "Описание товара номер 37\nхарактеристики товара номер 37", "img/TN037/");
add_item($link, "TN038", "Товар38", "562", "490", "elefant1.png", "Описание товара номер 38\nхарактеристики товара номер 38", "img/TN038/");
add_item($link, "TN039", "Товар39", "262", "2490", "elefant1.png", "Описание товара номер 39\nхарактеристики товара номер 39", "img/TN039/");
add_item($link, "TN040", "Товар40", "262", "990", "elefant1.png", "Описание товара номер 40\nхарактеристики товара номер 40", "img/TN040/");
add_item($link, "TN041", "Товар41", "262", "1990", "elefant1.png", "Описание товара номер 41\nхарактеристики товара номер 41", "img/TN041/");
add_item($link, "TN042", "Товар42", "162", "1290", "elefant1.png", "Описание товара номер 42\nхарактеристики товара номер 42", "img/TN042/");
add_item($link, "TN043", "Товар43", "162", "1390", "elefant1.png", "Описание товара номер 43\nхарактеристики товара номер 43", "img/TN043/");
add_item($link, "TN044", "Товар44", "462", "1490", "elefant1.png", "Описание товара номер 44\nхарактеристики товара номер 44", "img/TN044/");
add_item($link, "TN045", "Товар45", "462", "1590", "elefant1.png", "Описание товара номер 45\nхарактеристики товара номер 45", "img/TN045/");
add_item($link, "TN046", "Товар46", "462", "1690", "elefant1.png", "Описание товара номер 46\nхарактеристики товара номер 46", "img/TN046/");
add_item($link, "TN047", "Товар47", "462", "1790", "elefant1.png", "Описание товара номер 47\nхарактеристики товара номер 47", "img/TN047/");
add_item($link, "TN048", "Товар48", "562", "490", "elefant1.png", "Описание товара номер 48\nхарактеристики товара номер 48", "img/TN048/");
add_item($link, "TN049", "Товар49", "262", "2490", "elefant1.png", "Описание товара номер 49\nхарактеристики товара номер 49", "img/TN049/");
add_item($link, "TN050", "Товар50", "262", "990", "elefant1.png", "Описание товара номер 50\nхарактеристики товара номер 50", "img/TN050/");
add_item($link, "TN051", "Товар51", "262", "1990", "elefant1.png", "Описание товара номер 51\nхарактеристики товара номер 51", "img/TN051/");
add_item($link, "TN052", "Товар52", "162", "1290", "elefant1.png", "Описание товара номер 52\nхарактеристики товара номер 52", "img/TN052/");
add_item($link, "TN053", "Товар53", "162", "1390", "elefant1.png", "Описание товара номер 53\nхарактеристики товара номер 53", "img/TN053/");
add_item($link, "TN054", "Товар54", "462", "1490", "elefant1.png", "Описание товара номер 54\nхарактеристики товара номер 54", "img/TN054/");
add_item($link, "TN055", "Товар55", "462", "1590", "elefant1.png", "Описание товара номер 55\nхарактеристики товара номер 55", "img/TN055/");

$tableName2 = "orders(id INT NOT NULL AUTO_INCREMENT,
               order_num VARCHAR(30) NULL,
               adress VARCHAR(1024) NULL,
               clientid INT NOT NULL,
               itemid INT NOT NULL,
               quantity INT NOT NULL,
               price INT NOT NULL,
               confirmed BOOLEAN NULL,
               payed BOOLEAN NULL,
               order_state VARCHAR(30) NOT NULL,
               date DATE NOT NULL,
               PRIMARY KEY (`id`))";
 tableCreate($link, $tableName2);
 $query = "ALTER TABLE orders ADD FOREIGN KEY(`order_num`) REFERENCES order_stat(`order_num`) ON UPDATE CASCADE ON DELETE CASCADE";
 mysqli_query($link, $query);

 $query = "ALTER TABLE orders ADD FOREIGN KEY(`clientid`) REFERENCES clients(`id`) ON UPDATE CASCADE ON DELETE CASCADE";
 mysqli_query($link, $query);
 $query1 = "ALTER TABLE orders ADD FOREIGN KEY(`itemid`) REFERENCES item(item_id) ON UPDATE CASCADE ON DELETE CASCADE";
 mysqli_query($link, $query1);
