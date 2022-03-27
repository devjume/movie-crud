<?php

$nimi = filter_input(INPUT_POST, "nimi");
$vuosi = filter_input(INPUT_POST, "vuosi");
$kesto = filter_input(INPUT_POST, "kesto");
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
  print json_encode(array("error" => "'Vuosi', 'Kesto' ja 'Ikärajaä tulee olla numeroina"));
  exit();
}

# Varmistaa, että ikäraja on tyhjä, 0, 7, 16 tai 18
if (!empty($ikaraja) && $ikaraja !== '7' && $ikaraja !== '16' && $ikaraja !== '18') {
  http_response_code(400);
  print json_encode(array("error" => "'Ikaraja' tulee olla tyhjä, 0, 7, 16 tai 18"));
  exit();
}


echo $nimi;
echo $vuosi;
echo $kesto;
echo $kieli;
echo $ikaraja;
echo $ohjaaja; 
echo $genre;
echo "<br>";

foreach($nayttelijat as $x) {
  echo $x['nimi'];
  echo "<br>";
  echo $x['rooli'];
  echo "<br>";
  echo $x['sukupuoli'];
  echo "<br>";
}

?>