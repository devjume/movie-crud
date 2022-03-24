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
    $rowCount = $pdoStatement->rowCount();
    
    if ( $rowCount > 0 ) {
        while($row = $pdoStatement->fetch()) {
          echo "id: " . $row["id"]. " Name: " . $row["nimi"]. " Elokuvan tulovuosi: " 
          . $row["vuosi"]. " Elokuvan kesto: ". $row['kesto']. " Elokuvan kieli: ". $row['kieli'] . " Elokuvan ikäraja: ". $row['ikaraja'];
        }
      } else {
        echo "häähää";
        exit;
      }
} catch (PDOException $e) {
    returnError($e);
  }
    

