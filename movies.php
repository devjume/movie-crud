<?php
require_once "./inc/functions.php";
require_once "./inc/headers.php";

try {
  createTableRow();
} catch (PDOException $e) {
  returnError($e);
}

function createTableRow() {
  //kanta yhteys
  $pdo = openDB();
  $sql = "SELECT id,nimi, vuosi, kesto, kieli, ikaraja FROM elokuva";
  $elokuvat = $pdo->query($sql);
  if ($elokuvat->rowCount() > 0 ) {
    //jos elokuvia(rivejä) löytyy, niin luodaan taulukko. Vähän taululle tyyliä, sekä taulukon headerit
    echo "<table>";
    echo "<style>
            table, td, th {
            border:1px solid black;
            }
          </style>";
    echo "<tr>
          <th>Nimi</th>
          <th>Tulovuosi</th>
          <th>Kesto(min)</th>
          <th>Kieli</th>
          <th>Ikäraja</th>
          </tr>";
    //jokaista tietokannan riviä kohden luodaan html-taulukkoon uusi rivi
    while($row = $elokuvat->fetch()) {
        echo '<tr>' . '<td>' . '<a href="single.php?id='.$row["id"].'">'. $row["nimi"] . '</a>' . '</td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>' . "</tr>";
    }
    //lopuksi taulukko kiinni 
    echo "</table>";
}
}

