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


  function fetch_detail_by_id($table_name, $id) {
    return fetch_detail_sql("SELECT * FROM `$table_name` WHERE `id` = $id");
  }


  function fetch_weaknesses_list($is_local) {
    return fetch_sql("SELECT * FROM `weaknesses` WHERE `is_local` = $is_local");
  }


  function fetch_solutions_list($weakness_id) {
    return fetch_sql("SELECT s.* FROM `solutions` AS s
      JOIN weakness_solution AS ws ON ws.solution_id = s.id
      WHERE ws.weakness_id = $weakness_id
    ");
  }


  function fetch_analysises_list($solution_id) {
    return fetch_sql("SELECT a.* FROM `analysises` AS a
      JOIN solution_analysises AS sa ON sa.analysis_id = a.id
      WHERE sa.solution_id = $solution_id
    ");
  }

 ?>
