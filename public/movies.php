<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
?>
<h1>Kaikki elokuvat </h1>
<table>
  <style>
    table,
    td,
    th {
      border: 1px solid black;
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

  $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

  if (!isset($id)) {
    http_response_code(400);
    echo "<h3>Genre ID parametri puuttuu</h3>";
    exit;
  }



  if ($id === 0) {
    $sql = "SELECT elokuva.id as id, elokuva.nimi as elokuva, vuosi, kesto, kieli, ikaraja, ohjaaja.nimi as Ohjaaja FROM elokuva
left join ohjaaja on elokuva.ohjaaja_id = ohjaaja.id";
  } else {
    $sql = "SELECT elokuva.id as id, elokuva.nimi as elokuva, vuosi, kesto, kieli, ikaraja, ohjaaja.nimi as Ohjaaja FROM elokuva
left join ohjaaja on elokuva.ohjaaja_id = ohjaaja.id WHERE elokuva.genre_id = $id";
  }

  $pdo = openDB();
  $elokuvat = $pdo->query($sql);
  if ($elokuvat->rowCount() > 0) {
    while ($row = $elokuvat->fetch()) {
      echo '<tr>' . '<td>' . '<a href="single.php?id=' . $row["id"] . '">' . $row["elokuva"] . '</a>' . '</td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>' . '<td>' . $row["Ohjaaja"] . '</td>' . "</tr>";
    }
  }


  ?>
</table>

<?php
include TEMPLATES_DIR . "foot.php";
?>