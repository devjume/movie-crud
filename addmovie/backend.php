<?php

$array1 = filter_input(INPUT_POST, "nayttelijat");
$array2 = $_POST['nayttelijat'];

foreach($array2 as $y) {
  echo $y['nimi'];
}

$posti = $_POST;
$kala = array(1,2,3);

foreach($posti as $row) {
  if (is_array($row)) {
    foreach($row as $x) {
      echo $x;
    }
  } else {
    echo $row;
  }
}


?>