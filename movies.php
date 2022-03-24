<?php
require_once "./inc/functions.php";
require_once "./inc/headers.php";

  echo "<table>";
  echo "<style>
  table, th, td {
    border:1px solid black;
  }
  </style>";
  echo "<tr>
        <th>Nimi</th>
        <th>Tulovuosi</th>
        <th>Kesto</th>
        <th>Kieli</th>
        <th>Ikäraja</th>
        </tr>";
  createTableRow();
  echo "</table>";


function createTableRow() {
  $pdo = openDB();
  $sql = "SELECT nimi, vuosi, kesto, kieli, ikaraja FROM elokuva";
  $elokuvat = $pdo->query($sql);
  if ($elokuvat->rowCount() > 0 ) {
      echo '<tr>';
      while($row = $elokuvat->fetch()) {
          echo '<td>' . $row["nimi"] . '</td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>' ;
      }
      echo "</tr>";
  }
}