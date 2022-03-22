<?php
require_once "../backend/inc/functions.php";
require_once "../backend/inc/headers.php";

try {
  $db = openDB();
  
  if(!$db) { echo "Database connection Failed!"; }

  $sql = "select * from `elokuvat`";
  $query = $db->query($sql);

  $result = $query->fetchAll();

  print json_encode($result);

} catch (PDOException $e) {
  returnError($e);
}
