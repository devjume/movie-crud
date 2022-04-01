<?php
require_once "./inc/functions.php";
require_once "./inc/headers.php";
require_once "head.php";
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
</tr>
<?php

$pdo = openDB();
$sql = "SELECT id,nimi, vuosi, kesto, kieli, ikaraja FROM elokuva";
$elokuvat = $pdo->query($sql);
if ($elokuvat->rowCount() > 0 ) {
  while($row = $elokuvat->fetch()) {
      echo '<tr>' . '<td>' . '<a href="single.php?id='.$row["id"].'">'. $row["nimi"] . '</a>' . '</td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>' . "</tr>";
  }
}
?>
</table>