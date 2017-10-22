<?php
  require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

  require_once(LIBRARY_PATH . "/database.php");
  require_once(LIBRARY_PATH . "/auth.php");
  require_once(LIBRARY_PATH . "/query_sets.php");

  if (!$_SESSION['is_auth']) {
    header('Location: login.php');
    return;
  }


  $response = [
    'type' => [
      '0' => 'Сетевые',
      // Здесь должна быть единица, но в таком случае PHP создаёт не словарь, а массив
      '2' => 'Локальные'
    ],
    'weaknesses' => null,
    'solutions' => null,
    'analysises' => null
  ];

  if (strlen($_GET['type'])) {
    $response['weaknesses'] = fetch_weaknesses_list($_GET['type'] ? 1 : 0);
  }

  if (strlen($_GET['weaknesses'])) {
    $response['solutions'] = fetch_solutions_list($_GET['weaknesses']);
  }

  if (strlen($_GET['solutions'])) {
    $response['analysises'] = fetch_analysises_list($_GET['solutions']);
  }


  echo json_encode($response, JSON_UNESCAPED_UNICODE);

 ?>
