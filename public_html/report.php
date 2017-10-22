<?php
  require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

  require_once(LIBRARY_PATH . "/templateFunctions.php");
  require_once(LIBRARY_PATH . "/database.php");
  require_once(LIBRARY_PATH . "/auth.php");
  require_once(LIBRARY_PATH . "/query_sets.php");

  if (!$_SESSION['is_auth']) {
    header('Location: login.php');
    return;
  }

  $REQUESTED_PARAMS = ['type', 'weaknesses', 'solutions', 'analysises'];

  $error = null;
  $report = [];

  if ($_GET) {
    foreach ($_GET as $key => $value) {
      if (in_array($key, $REQUESTED_PARAMS)) {
        if ($key == 'type') {
          $report[$key] = [
            'name' => $key ? 'Локальные уязвимости' : 'Сетевые уязвимости',
            'text' => $key ? 'Уязвимости в локальной сети' : 'Уязвимости в межсетевом пространстве'
          ];
        } else {
          $report[$key] = fetch_detail_by_id($key, $value);
        }
      } else {
        $url = url('/index.php');
        $error = "Произошла ошибка при формировании отчёта. Повторите попытку <a href=\"$url\">ввода данных</a>";
        break;
      }
    }
  } else {
    $url = url('/index.php');
    $error = "Для формирования отчёта вам необходимо ввести данные <a href=\"$url\">здесь</a>";
  }


  renderLayoutWithContentFile("report.php", [
    'report' => $report,
    'error' => $error
  ]);
 ?>
