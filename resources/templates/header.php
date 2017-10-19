<!DOCTYPE html>
<html>
<head>
    <title>Заголовок</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo url('/css/style.css') ?>">
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?php echo url('/') ?>">PVM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <?php if ($_SESSION['is_auth'] && $_SESSION['is_admin']) { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('/users/') ?>">Пользователи</a>
        </li>
        <?php } ?>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php
              if ($_SESSION['is_auth']) {
                ?>
                <span class="navbar-text" style="margin: 0 10px;">
                  <?php if ($_SESSION['is_admin']) { ?>
                    <?php echo "Admin: "; ?>
                  <?php } ?>
                  <?php echo $_SESSION['fio']; ?>
                </span>
                <a href="<?php echo url('/logout.php') ?>" class="btn btn-light">Logout</a>
                <?php
              } else {
                ?>
                <a href="<?php echo url('/registration.php') ?>" class="btn btn-light">Registration</a>
                <a href="<?php echo url('/login.php') ?>" class="btn btn-light">Login</a>
                <?php
              }
          ?>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
