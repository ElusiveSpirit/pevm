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


  renderLayoutWithContentFile("user.php", array(
    'users_list' => users_all()
  ));
 ?>
