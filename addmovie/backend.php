<?php
require_once "../inc/functions.php";

$nimi = filter_input(INPUT_POST, "nimi");
$vuosi = filter_input(INPUT_POST, "vuosi");
$kesto = filter_input(INPUT_POST, "kesto", FILTER_VALIDATE_INT);
$kieli = filter_input(INPUT_POST, "kieli");
$ikaraja = filter_input(INPUT_POST, "ikaraja", FILTER_VALIDATE_INT);
$ohjaaja = filter_input(INPUT_POST, "ohjaaja");
$genre = filter_input(INPUT_POST, "genre");
$nayttelijat = filter_input(INPUT_POST, "nayttelijat", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

# Tarkistaa, että kaikki vaadittavat parametrit on löytyy
if (!isset($nimi) || !isset($genre) || empty($nimi) || empty($genre)) {
  http_response_code(400);
  print json_encode(array("error" => "Parametreja puuttui"));
  exit;
}

# Tarkistaa onko vuosi, kesto, ikaraja ovat numeroita
if (!filter_var($vuosi, FILTER_VALIDATE_INT) || !filter_var($kesto, FILTER_VALIDATE_INT)) {
  http_response_code(400);
  print json_encode(array("error" => "'Vuosi', 'Kesto' ja 'Ikäraja' tulee olla numeroina"));
  exit();
}

# Varmistaa, että ikäraja on tyhjä, 0, 7, 16 tai 18
if (!empty($ikaraja) && $ikaraja !== '7' && $ikaraja !== '16' && $ikaraja !== '18') {
  http_response_code(400);
  print json_encode(array("error" => "'Ikaraja' tulee olla tyhjä, 0, 7, 16 tai 18"));
  exit();
}

try {
  $db = openDB();

  if (!$db) {
    echo "Database connection Failed!";
  }

  # TARKASTA LÖYTYYKÖ ELOKUVA JO TIETOKANNASTA
  # LISÄÄ NÖYTTELIJÄT JA ROOLIT

  $ohjaaja_id = luoOhjaaja($db, $ohjaaja);
  $genre_id = luoGenre($db, $genre);

  $sql = "INSERT INTO elokuva (nimi, vuosi, kesto, kieli, ohjaaja_id, ikaraja, genre_id) VALUES (?,?,?,?,?,?,?)";

  $pdoStatement = $db->prepare($sql);
  $pdoStatement->bindParam(1, $nimi);
  $pdoStatement->bindParam(2, $vuosi);
  $pdoStatement->bindParam(3, $kesto);
  $pdoStatement->bindParam(4, $kieli);
  $pdoStatement->bindParam(5, $ohjaaja_id);
  $pdoStatement->bindParam(6, $ikaraja);
  $pdoStatement->bindParam(7, $genre_id);

  $pdoStatement->execute();
  
  http_response_code(201);
  print json_encode((array("success" => "Elokuva: " . $nimi . " on lisätty tietokantaan")));
  exit();
  #header('Content-type: text/html');

} catch (PDOException $e) {
  returnError($e);
}

function luoOhjaaja($db, $ohjaaja)
{
  $sqlCheckGenre = "SELECT id FROM `ohjaaja` WHERE `nimi` = ?";
  $pdoGenreExits = $db->prepare($sqlCheckGenre);
  $pdoGenreExits->bindParam(1,  $ohjaaja);
  $pdoGenreExits->execute();
  $ohjaaja_id = $pdoGenreExits->fetchColumn();

  # Jos syötettyä ohjaajaa ei ole tietokannassa, Sellainen luodaan.
  if (empty($ohjaaja_id)) {
    $sqlCreateGenre = "INSERT INTO ohjaaja(nimi) VALUES (?)";
    $pdoCreateGenre = $db->prepare($sqlCreateGenre);
    $pdoCreateGenre->bindParam(1, $ohjaaja);
    $pdoCreateGenre->execute();
    $ohjaaja_id = $db->lastInsertId();
    return $ohjaaja_id;
  }
  return $ohjaaja_id;
}

function luoGenre($db, $genre) {
  $sqlCheckGenre = "SELECT id FROM `genre` WHERE `nimi` = ?";
  $pdoGenreExits = $db->prepare($sqlCheckGenre);
  $pdoGenreExits->bindParam(1,  $genre);
  $pdoGenreExits->execute();
  $genre_id = $pdoGenreExits->fetchColumn();

  # Jos syötettyä genreä ei ole tietokannassa, Sellainen luodaan.
  if (empty($genre_id)) {
    $sqlCreateGenre = "INSERT INTO genre(nimi) VALUES (?)";
    $pdoCreateGenre = $db->prepare($sqlCreateGenre);
    $pdoCreateGenre->bindParam(1, $genre);
    $pdoCreateGenre->execute();
    $genre_id = $db->lastInsertId();
    return $genre_id;
  }
  return $genre_id;
}

?>