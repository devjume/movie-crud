<?php
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";

$id = $_GET['id'];

try {
    $db = openDB();

    if (!$db) {
        echo "Database connection Failed!";
    }

    $db->beginTransaction();

    $sqlDeleteRole = "delete from nayttelija_rooli where elokuva_id=?";
    $pdo = $db->prepare($sqlDeleteMovie);
    $pdo->bindParam(1,  $id);
    $pdo->execute();


    $sqlDeleteReview = "delete from arvostelu where elokuva_id=?";
    $pdo = $db->prepare($sqlDeleteReview);
    $pdo->bindParam(1,  $id);
    $pdo->execute();

    $sqlDeleteMovie = "delete from elokuva where id=?";
    $pdo = $db->prepare($sqlDeleteMovie);
    $pdo->bindParam(1,  $id);
    $pdo->execute();

    $db->commit();

    header("Location: movies.php");
} catch (PDOException $e) {
    $db->rollBack();
    returnError($e);
  }
    