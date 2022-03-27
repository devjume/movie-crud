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
  
  ## TEE TÄSSÄ ENSIN GENRE ID JA OHJAAJA ID TARKASTUS JA MAHDOLLINEN LUONTI

  $sql = "INSERT INTO elokuva (nimi, vuosi, kesto, kieli, ohjaaja_id, ikaraja, genre_id) VALUES (?,?,?,?,?,?,?)";

  $pdoStatement = $db->prepare($sql);
  $pdoStatement->bindParam(1, $nimi);
  $pdoStatement->bindParam(2, $vuosi);
  $pdoStatement->bindParam(3, $kesto);
  $pdoStatement->bindParam(4, $kieli);
  $pdoStatement->bindParam(5, $ohjaaja_id);
  $pdoStatement->bindParam(6, $ikaraja);
  $pdoStatement->bindParam(7, $genre_id);

  #$pdoStatement->execute();

  # Tee tästä paremi -> palauta vain json ja tee frontendissä sen näyttäminen -> poista page auto refresh after post
  #header("Location: http://localhost/xx/workTime.php", true, 301);
  #echo "Käyttäjälle:" . $personid . " lisättiin uusi työaika merkintä.";
  #http_response_code(201);
  #print json_encode((array("success" => "Käyttäjälle: " . $personid . " lisättiin uusi työaika merkintä.")));
  exit();
  #header('Content-type: text/html');

} catch (PDOException $e) {
  returnError($e);
}



#echo $nimi;
#echo "<br>";
#echo $vuosi;
#echo "<br>";
#echo $kesto;
#echo "<br>";
#echo $kieli;
#echo "<br>";
#echo $ikaraja;
#echo "<br>";
#echo $ohjaaja;
#echo "<br>";
#echo $genre;
#echo "<br>";
#echo "<br>";
#
#foreach($nayttelijat as $x) {
#  echo $x['nimi'];
#  echo "<br>";
#  echo $x['rooli'];
#  echo "<br>";
#  echo $x['sukupuoli'];
#  echo "<br>";
#  echo "<br>";
#}
?>