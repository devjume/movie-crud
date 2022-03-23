<?php
require_once "./inc/functions.php";
require_once "./inc/headers.php";

try {
  $db = openDB();
  
  $sql = "SELECT * FROM `elokuva`";
  $query = $db->query($sql);
  $result = $query->fetchAll();

  print json_encode($result);

} catch (PDOException $e) {
  returnError($e);
}
