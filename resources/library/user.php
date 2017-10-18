<?php
  /**
    * user.php
    * Функции для работы с пользователями
    */

  require_once('database.php');


  function user_create($fio, $password) {
    global $db;

    $sql = "INSERT INTO `users`
        (`id`,`fio`,`password`, `is_admin`, `is_verified`) VALUES
        (NULL, '" . $fio . "','" . $password . "', 0, 0)";

    return $db->query($sql);
  }

  function user_is_exists($fio) {
    global $db;

    if ($result = $db->query("SELECT `id` FROM `users` WHERE `fio`='" . $fio . "' LIMIT 1")) {
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

    if ($result = $db->query("SELECT * FROM `users` WHERE `id`=".$id.";")) {
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

  function users_get() {
    $strSQL =  "SELECT `id`, `fio` FROM `users`";

    // Выполнить запрос (набор данных $rs содержит результат)
    $rs = mysql_query($strSQL);

    // Цикл по $rs
    while($row = mysql_fetch_array($rs)) {
      // Имя человека
      $strName = $row['fio'];

      // Создать ссылку на person.php с id-value в URL
      //   $strLink = "<a href = 'person.php?id = " . $row['id'] . "'>" . $strNavn . "</a>";

      // Листинг ссылок
      if ($strName != $_SESSION["fio"])
      	echo "<li>" . $strName . "</li>";

    }
  }


 ?>
