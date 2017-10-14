<!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Simple Site</title>
</head>

<body>
  <header>
    <?php
        if ($_SESSION['is_auth']) {
          if ($_SESSION['is_admin']) {
            echo 'Admin: ' . $_SESSION['fio'];
          } else {
            echo $_SESSION['fio'];
          }
        } else {
          ?>
          <a href="/login.php">Login</a>
          <?php
        }
    ?>
  </header>
