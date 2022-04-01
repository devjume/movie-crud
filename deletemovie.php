<?php
require_once "./inc/functions.php";
require_once "./inc/headers.php";

$id = $_GET['id'];

try {
    $pdo = openDB();
    $sql = "delete from nayttelija_rooli where elokuva_id=?";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindParam(1,  $id);
    $pdoStatement->execute();

    $sql2 = "delete from arvostelu where elokuva_id=?";
    $pdoStatement = $pdo->prepare($sql2);
    $pdoStatement->bindParam(1,  $id);
    $pdoStatement->execute();

    $sql3 = "delete from elokuva where id=?";
    $pdoStatement = $pdo->prepare($sql3);
    $pdoStatement->bindParam(1,  $id);
    $pdoStatement->execute();

    header("Location: movies.php");
} catch (PDOException $e) {
    returnError($e);
  }
    