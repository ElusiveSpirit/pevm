<?php
  require_once('database.php');

  function fetch_detail_sql($sql) {
    global $db;

    if ($result = $db->query($sql)) {
      $ret = null;
      if ($row = $result->fetch_assoc()) {
        $ret = [
          'id' => $row['id'],
          'name' => $row['name'],
          'text' => $row['text']
        ];
      }
      $result->close();
      return $ret;
    }
  }

  function fetch_sql($sql) {
    global $db;

    if ($result = $db->query($sql)) {
      $ret = [];
      while ($row = $result->fetch_assoc()) {
        $ret[$row['id']] = $row['name'];
      }
      $result->close();
      return $ret;
    }
  }

  function fetch_weaknesses($id) {
    return fetch_detail_sql("SELECT * FROM `weaknesses` WHERE `id` = $id");
  }

  function fetch_weaknesses_list($is_local) {
    return fetch_sql("SELECT * FROM `weaknesses` WHERE `is_local` = $is_local");
  }

 ?>
