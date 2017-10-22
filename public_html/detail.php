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

  $ALLOWED_TYPES = ['weaknesses', 'solutions', 'analysises'];


  if ($_GET['type'] == 'type') {
    $response = [
      'name' => $_GET['value'] ? 'Локальные уязвимости' : 'Сетевые уязвимости',
      'text' => $_GET['value'] ? 'Уязвимости в локальной сети' : 'Уязвимости в межсетевом пространстве'
    ];
  } elseif (in_array($_GET['type'], $ALLOWED_TYPES)) {
    $response = fetch_detail_by_id($_GET['type'], $_GET['value']);
  } else {
    die('Type not found');
  }


  echo json_encode($response, JSON_UNESCAPED_UNICODE);

 ?>
