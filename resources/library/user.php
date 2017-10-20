<?php
  /**
    * user.php
    * Функции для работы с пользователями
    */

  require_once('database.php');


  function user_create($fio, $password, $is_verified=0, $is_admin=0) {
    global $db;

    $sql = "INSERT INTO `users`
        (`id`,`fio`,`password`, `is_admin`, `is_verified`) VALUES
        (NULL, '" . $fio . "','" . $password . "', ". $is_admin .", ". $is_verified .")";

    return $db->query($sql);
  }

  function user_delete($id) {
    global $db;

    $sql = "DELETE FROM users WHERE id = ".$id.";";

    return $db->query($sql);
  }

  function user_update($id, $fio, $password, $is_verified, $is_admin) {
    global $db;

    $sql = "UPDATE users
            SET fio = '".$fio.($password ? "', password = '".$password : "")."',
            is_verified = ".$is_verified.", is_admin = ".$is_admin."
            WHERE id = ".$id.";";

    return $db->query($sql);
  }

  function user_is_exists($fio) {
    global $db;

    if ($result = $db->query("SELECT `id` FROM `users` WHERE `fio`='$fio' LIMIT 1")) {
      /* очищаем результирующий набор */
      $num = $result->num_rows;
      $result->close();
      return $num == 1;
    }
    return false;
  }

  function user_fetch($id)
  {
    global $db;

    if ($result = $db->query("SELECT * FROM `users` WHERE `id`=$id;")) {
      $ret = null;
      if ($row = $result->fetch_assoc()) {
        $ret = array(
          'id' => $row['id'],
          'fio' => $row['fio'],
          'is_admin' => $row['is_admin'],
          'is_verified' => $row['is_verified'],
        );
      }
      $result->close();
      return $ret;
    }
  }

  function user_fetch_with_password($fio, $password) {
    global $db;

    if ($result = $db->query("SELECT * FROM `users` WHERE `fio`='".$fio."' AND `password`='".$password."' LIMIT 1")) {
      $ret = null;
      if ($row = $result->fetch_assoc()) {
        $ret = array(
          'id' => $row['id'],
          'fio' => $row['fio'],
          'is_admin' => $row['is_admin'],
          'is_verified' => $row['is_verified'],
        );
      }
      $result->close();
      return $ret;
    }
  }

  function users_all() {
    global $db;

    if ($result = $db->query("SELECT * FROM `users`")) {
      $ret = array();
      while ($row = $result->fetch_assoc()) {
        $ret[] = array(
          'id' => $row['id'],
          'fio' => $row['fio'],
          'is_admin' => $row['is_admin'],
          'is_verified' => $row['is_verified'],
        );
      }
      $result->close();
      return $ret;
    }
  }


 ?>
