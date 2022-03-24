<?php
require_once "./inc/functions.php";
require_once "./inc/headers.php";
//id tulee movies.php:sta
$id = $_GET['id'];

try {
    $pdo = openDB();
    $sql = "SELECT * from elokuva where id=?";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindParam(1,  $id);
    $pdoStatement->execute();
    $results = $pdoStatement->fetch();
    
    foreach($results as $result){
        echo $result;
    }
} catch (PDOException $e) {
    returnError($e);
  }
    
