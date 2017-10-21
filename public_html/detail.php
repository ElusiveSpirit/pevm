<?php
  require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

  require_once(LIBRARY_PATH . "/database.php");
  require_once(LIBRARY_PATH . "/auth.php");
  require_once(LIBRARY_PATH . "/query_sets.php");

  if (!$_SESSION['is_auth']) {
    header('Location: login.php');
    return;
  }

  $response = null;


  if ($_GET['type'] == 'type') {
    $response = [
      'name' => $_GET['value'] ? 'Локальные уязвимости' : 'Сетевые уязвимости',
      'text' => $_GET['value'] ? 'Уязвимости в локальной сети' : 'Уязвимости в межсетевом пространстве'
    ];
  } elseif ($_GET['type'] == 'weaknesses') {
    $response = fetch_weaknesses($_GET['value']);
  }


  echo json_encode($response, JSON_UNESCAPED_UNICODE);

 ?>
