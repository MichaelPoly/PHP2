<?php

  $path = 'img/galery/FullSize/';
  $tmp_path = 'img/galery/tmp/';
  $path_min = 'img/galery/';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $file = $_FILES['picture'];
    if ($file['type'] == 'image/jpeg')
      $source = imagecreatefromjpeg($file['tmp_name']);
    elseif ($file['type'] == 'image/png')
      $source = imagecreatefrompng($file['tmp_name']);
    elseif ($file['type'] == 'image/gif')
      $source = imagecreatefromgif($file['tmp_name']);
    else
      return false;
          $quality = 75;
          $w_src = imagesx($source);
          $h_src = imagesy($source);
          if ($w_src > $h_src) {
            $w = 600;
          } else $w = 200;
          $ratio = $w_src / $w;
          $w_dest = round($w_src / $ratio);
          $h_dest = round($h_src / $ratio);
          $dest = imagecreatetruecolor($w_dest, $h_dest);
          print_r($dest);
          imagecopyresampled($dest, $source, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
          imagejpeg($dest, $path_min . $file['name'], $quality);
          imagedestroy($dest);
          imagedestroy($source);
    $uploadfile = $path . basename($_FILES['picture']['name']);
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
      header("Location: galery.html");
    } else {
     echo "Возможная атака с помощью файловой загрузки!\n";
    }
  }
