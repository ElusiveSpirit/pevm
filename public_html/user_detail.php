<?php
  require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

  require_once(LIBRARY_PATH . "/templateFunctions.php");
  require_once(LIBRARY_PATH . "/database.php");
  require_once(LIBRARY_PATH . "/auth.php");
  require_once(LIBRARY_PATH . "/user.php");

  if (!$_SESSION['is_auth'] || !$_SESSION['is_admin']) {
    header('Location: index.php');
    return;
  }

  $user = user_fetch($_GET['id']);

  $message = null;
  $status = null;
  if ($_POST) {
    $fio = isset($_POST['fio']) ? $_POST['fio'] : $user['fio'];
    $password = $_POST['password'];

    $is_verified = $user['is_verified'];
    $is_verified_post = isset($_POST['is_verified']) ? 1 : 0;
    if ($is_verified_post != $is_verified) {
      $is_verified = $is_verified_post;
    }

    $is_admin = $user['is_admin'];
    $is_admin_post = isset($_POST['is_admin']) ? 1 : 0;
    if ($is_admin_post != $is_admin) {
      $is_admin = $is_admin_post;
    }

    if (user_update($user['id'], $fio, $password, $is_verified, $is_admin)) {
      $message = 'Пользователь обновлён';
      $status = true;
    } else {
      $message = 'Произошла ошибка';
      $status = false;
    }
    $user = user_fetch($_GET['id']);
  }


  renderLayoutWithContentFile("user_detail.php", array(
    'user' => $user,
    'status' => $status,
    'message' => $message
  ));
 ?>
