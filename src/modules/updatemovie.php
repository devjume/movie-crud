<?php
require_once MODULES_DIR . "/inc/functions.php";

function updateMovie($id, $nimi,$vuosi,$kesto,$kieli,$ikaraja,$ohjaaja,$genre,$kuva_url,$ohjaaja_vanha, $genre_vanha){
require_once MODULES_DIR . "/inc/functions.php";

 #Tarkistaa, että kaikki vaadittavat parametrit on löytyy
if (!isset($nimi) || !isset($id) || empty($nimi) || empty($id)) {
  http_response_code(400);
  print json_encode(array("error" => "Parametreja puuttui"));
 exit;
}

try {
  $db = openDB();

  if (!$db) {
    echo "Database connection Failed!";
  }
  $sql = "UPDATE `elokuva` SET `genre_id` = ? WHERE id=?";
  $pdoStatement = $db->prepare($sql);
  $pdoStatement->bindParam(1, $genre);
  $pdoStatement->bindParam(2, $id);
  $pdoStatement->execute();

  $sql = "UPDATE `ohjaaja` SET `nimi` = ?  WHERE nimi=?";
  $pdoStatement = $db->prepare($sql);
  $pdoStatement->bindParam(1, $ohjaaja);
  $pdoStatement->bindParam(2, $ohjaaja_vanha);
  $pdoStatement->execute();

  $sql = "UPDATE `elokuva` SET `nimi`=?,`vuosi`=?,`kesto`=?,`kieli`=?,`ikaraja`=?,`kuva_url`=? WHERE id=?";

  $pdoStatement = $db->prepare($sql);
  $pdoStatement->bindParam(1, $nimi);
  $pdoStatement->bindParam(2, $vuosi);
  $pdoStatement->bindParam(3, $kesto);
  $pdoStatement->bindParam(4, $kieli);
  $pdoStatement->bindParam(5, $ikaraja);
  $pdoStatement->bindParam(6, $kuva_url);
  $pdoStatement->bindParam(7, $id);

  $pdoStatement->execute();


} catch (PDOException $e) {
  returnError($e);
}
}



