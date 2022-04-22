<?php
require_once MODULES_DIR . "/inc/functions.php";

$nimi = filter_input(INPUT_POST, "nimi");
$vuosi = filter_input(INPUT_POST, "vuosi");
$kesto = filter_input(INPUT_POST, "kesto");
$kieli = filter_input(INPUT_POST, "kieli");
$ikaraja = filter_input(INPUT_POST, "ikaraja");
$ohjaaja = filter_input(INPUT_POST, "Ohjaaja");
$genre = filter_input(INPUT_POST, "Genre");
$kuva_url = filter_input(INPUT_POST, "kuva_url");
$id = filter_input(INPUT_POST, "id");

# Tarkistaa, että kaikki vaadittavat parametrit on löytyy
#if (!isset($nimi) || !isset($tahdet) || empty($nimi) || empty($tahdet)) {
# http_response_code(400);
#  print json_encode(array("error" => "Parametreja puuttui"));
#  exit;
#}

try {
  $db = openDB();

  if (!$db) {
    echo "Database connection Failed!";
  }

  $sql = "UPDATE `elokuva` SET `nimi`=?,`vuosi`=?,`kesto`=?,`kieli`=?,`ikaraja`=?,`Ohjaaja`=?,`Genre`=?,`kuva_url`=? WHERE id=?";

  $pdoStatement = $db->prepare($sql);
  $pdoStatement->bindParam(1, $nimi);
  $pdoStatement->bindParam(2, $vuosi);
  $pdoStatement->bindParam(3, $kesto);
  $pdoStatement->bindParam(4, $kieli);
  $pdoStatement->bindParam(5, $ikaraja);
  $pdoStatement->bindParam(6, $ohjaaja);
  $pdoStatement->bindParam(7, $genre);
  $pdoStatement->bindParam(8, $kuva_url);
  $pdoStatement->bindParam(9, $id);

  $pdoStatement->execute();


} catch (PDOException $e) {
  returnError($e);
}