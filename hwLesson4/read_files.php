<?php
  if (!empty($_POST)) {
    $i = 0;
    $files = [];
    $dir = $_POST['directory'];
    $handle = opendir($dir);
    while (false !== ($file = readdir($handle))) {
      if ($file == '.' || $file == '..') {
        } else {
        $files[$i] = $file;
        $i++;
      }

    }

    echo json_encode($files);
  }
