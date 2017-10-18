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

  if ($_POST) {
    $user = user_fetch($_POST['id']);

    if (user_delete($user['id'])) {
      $message = 'Пользователь удалён';
      $status = true;
      $user = null;
    } else {
      $message = 'Произошла ошибка';
      $status = false;
    }
  } else {
    header('Location: user.php');
  }

  renderLayoutWithContentFile("user_detail.php", array(
    'user' => $user,
    'status' => $status,
    'message' => $message
  ));
 ?>
