<?php

    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

    require_once(LIBRARY_PATH . "/templateFunctions.php");
    require_once(LIBRARY_PATH . "/database.php");
    require_once(LIBRARY_PATH . "/auth.php");

    if (!$_SESSION['is_auth']) {
      header('Location: login.php');
      return;
    }



    renderLayoutWithContentFile("home.php", [

    ]);

?>
