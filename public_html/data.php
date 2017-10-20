<?php
  require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

  require_once(LIBRARY_PATH . "/database.php");
  require_once(LIBRARY_PATH . "/auth.php");

  if (!$_SESSION['is_auth']) {
    header('Location: login.php');
    return;
  }


  $response = [
    'type' => [
      '0' => 'Сетевые',
      '2' => 'Локальные'
    ],
    'weaknesses' => null,
    'solutions' => null,
    'analysises' => null
  ];


  echo json_encode($response, JSON_UNESCAPED_UNICODE);

 ?>
