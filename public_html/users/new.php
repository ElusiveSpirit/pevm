<?php
  require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));

  require_once(LIBRARY_PATH . "/templateFunctions.php");
  require_once(LIBRARY_PATH . "/database.php");
  require_once(LIBRARY_PATH . "/auth.php");
  require_once(LIBRARY_PATH . "/user.php");

  if (!$_SESSION['is_auth'] || !$_SESSION['is_admin']) {
    header('Location: index.php');
    return;
  }

  $message = null;
  $status = null;
  $user = null;
  if ($_POST) {
    if (isset($_POST['fio']) && isset($_POST['password'])) {
      $fio = $_POST['fio'];
      $password = $_POST['password'];
      $is_verified = isset($_POST['is_verified']) ? 1 : 0;
      $is_admin = isset($_POST['is_admin']) ? 1 : 0;

      if (!user_is_exists($fio)) {
        if (user_create($fio, $password, $is_verified, $is_admin)) {
          $message = 'Пользователь создан';
          $status = true;
          $user = user_fetch_with_password($fio, $password);
          header('Refresh: 5; URL = edit.php?id=' . $user['id']);
        } else {
          $message = 'Произошла ошибка';
          $status = false;
        }
      } else {
        $message = 'Пользователь с таким ФИО уже зарегистрирован';
        $status = false;
      }
    } else {
      $message = 'ФИО и пароль - обязательные поля';
      $status = false;
    }
  }


  renderLayoutWithContentFile("users/new.php", array(
    'user' => $user,
    'status' => $status,
    'message' => $message
  ));
 ?>
