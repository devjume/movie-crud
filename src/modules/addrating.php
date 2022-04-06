<?php
#require_once MODULES_DIR . "/inc/functions.php";

#$nimi = filter_input(INPUT_POST, "elokuva");
#$tahdet = filter_input(INPUT_POST, "tahdet");
#$kommentti = filter_input(INPUT_POST, "kommentti");
#$arvostelija = filter_input(INPUT_POST, "arvostelija");
#
## Tarkistaa, että kaikki vaadittavat parametrit on löytyy
#if (!isset($nimi) || !isset($tahdet) || empty($nimi) || empty($tahdet)) {
#  http_response_code(400);
#  print json_encode(array("error" => "Parametreja puuttui"));
#  exit;
#}

function lisaaArvostelu($nimi, $tahdet, $kommentti, $arvostelija) {
  require_once MODULES_DIR . "inc/functions.php";
  try {
    $db = openDB();

    if (!$db) {
      echo "Database connection Failed!";
    }

    $elokuva_id = haeElokuvaId($db, $nimi);

    $sql = "INSERT INTO arvostelu (elokuva_id, tahdet, kommentti, arvostelija) VALUES (?,?,?,?)";

    $pdo = $db->prepare($sql);
    $pdo->bindParam(1, $elokuva_id);
    $pdo->bindParam(2, $tahdet);
    $pdo->bindParam(3, $kommentti);
    $pdo->bindParam(4, $arvostelija);

    $pdo->execute();

    return "Arvostelu lisätty";
  } catch (PDOException $e) {
    return $e;
  }
}

// Hakee ja palauttaa elokuvan_id, elokuvan nimen perusteella
function haeElokuvaId($db, $elokuvaNimi) {
  $sql = "SELECT id FROM `elokuva` WHERE `nimi` = ?";
  $pdo= $db->prepare($sql);
  $pdo->bindParam(1, $elokuvaNimi);
  $pdo->execute();
  $elokuva_id = $pdo->fetchColumn();
  return $elokuva_id;
}

#try {
#  $db = openDB();
#
#  if (!$db) {
#    echo "Database connection Failed!";
#  }
#  
#  ## TEE TÄSSÄ ENSIN GENRE ID JA OHJAAJA ID TARKASTUS JA MAHDOLLINEN LUONTI
#  $sql2 ="SELECT id FROM `elokuva` WHERE `nimi` = ?";
#
#  $pdoStatement2 = $db->prepare($sql2);
#  $pdoStatement2->bindParam(1, $nimi);
#  $pdoStatement2->execute();
#  $elokuva_id = $pdoStatement2->fetchColumn();
#
#  $sql = "INSERT INTO arvostelu (elokuva_id, tahdet, kommentti, arvostelija) VALUES (?,?,?,?)";
#
#  $pdoStatement = $db->prepare($sql);
#  $pdoStatement->bindParam(1, $elokuva_id);
#  $pdoStatement->bindParam(2, $tahdet);
#  $pdoStatement->bindParam(3, $kommentti);
#  $pdoStatement->bindParam(4, $arvostelija);
#
#  $pdoStatement->execute();
#
#  header("Location: ./addrating.php");
#  # Tee tästä paremi -> palauta vain json ja tee frontendissä sen näyttäminen -> poista page auto refresh after post
#  #header("Location: http://localhost/xx/workTime.php", true, 301);
#  #echo "Käyttäjälle:" . $personid . " lisättiin uusi työaika merkintä.";
#  #http_response_code(201);
#  #print json_encode((array("success" => "Käyttäjälle: " . $personid . " lisättiin uusi työaika merkintä.")));
#  exit();
#  #header('Content-type: text/html');
#
#} catch (PDOException $e) {
#  returnError($e);
#}



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
