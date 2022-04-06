<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
?>
<h1>Kaikki elokuvat </h1>
<table>
<style>
    table, td, th {
    border:1px solid black;
    }
</style>
<tr>
<th>Nimi</th>
<th>Tulovuosi</th>
<th>Kesto(min)</th>
<th>Kieli</th>
<th>Ikäraja</th>
<th>Ohjaaja</th>
</tr>
<?php

$pdo = openDB();
$sql = "SELECT elokuva.id as id, elokuva.nimi as elokuva, vuosi, kesto, kieli, ikaraja, ohjaaja.nimi as Ohjaaja FROM elokuva
left join ohjaaja on elokuva.ohjaaja_id = ohjaaja.id";
$elokuvat = $pdo->query($sql);
if ($elokuvat->rowCount() > 0 ) {
  while($row = $elokuvat->fetch()) {
      echo '<tr>' . '<td>' . '<a href="single.php?id='.$row["id"].'">'. $row["elokuva"] . '</a>' . '</td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>' . '<td>' . $row["Ohjaaja"] . '</td>' ."</tr>";
  }
}
?>
</table>