<?php
require_once "../inc/functions.php";
require_once "../inc/headers.php";

try {
  $db = openDB();

  $sql = "SELECT CONCAT(`etunimi`, ' ', `sukunimi`) AS nimi FROM `ohjaaja`;";
  $query = $db->query($sql);
  $result = $query->fetchAll();

  print json_encode($result);
} catch (PDOException $e) {
  returnError($e);
}
