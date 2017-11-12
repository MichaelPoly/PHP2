<?php
  require_once 'functions.php';

    if (!empty($_POST)) {
    $user = get_user_by_id($_POST['userId']);
    echo json_encode($user);
    return json_encode($user);
    }
