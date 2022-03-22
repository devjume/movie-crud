<?php
  
function openDB() {
  $init = parse_ini_file("conf.ini");
  $host = $init["host"];
  $db = $init["db"];
  $user = $init["username"];
  $password = $init["pw"];

  $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
  
  return new PDO($dsn, $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
}

function returnError(PDOException $pdoex) {
  header('HTTP/1.1 500 Internal Server Error');
  $error = ['error' => $pdoex->getMessage()];
  print json_encode($error);
}
