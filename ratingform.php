<?php
require_once "./inc/functions.php";

$nimi = filter_input(INPUT_POST, "nimi");
$tahdet = filter_input(INPUT_POST, "tahdet", FILTER_VALIDATE_INT);
$kommentti = filter_input(INPUT_POST, "kommentti");
$arvostelija = filter_input(INPUT_POST, "arvostelija");

# Tarkistaa, että kaikki vaadittavat parametrit on löytyy
if (!isset($nimi) || !isset($tahdet) || empty($nimi) || empty($tahdet)) {
  http_response_code(400);
  print json_encode(array("error" => "Parametreja puuttui"));
  exit;
}

try {
  $db = openDB();

  if (!$db) {
    echo "Database connection Failed!";
  }
  
  ## TEE TÄSSÄ ENSIN GENRE ID JA OHJAAJA ID TARKASTUS JA MAHDOLLINEN LUONTI

  $sql = "INSERT INTO elokuva (nimi, tahdet, kommentti, arvostelija) VALUES (?,?,?,?)";

  $pdoStatement = $db->prepare($sql);
  $pdoStatement->bindParam(1, $nimi);
  $pdoStatement->bindParam(2, $tahdet);
  $pdoStatement->bindParam(3, $kommentti);
  $pdoStatement->bindParam(4, $arvostelija);

  $pdoStatement->execute();

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
