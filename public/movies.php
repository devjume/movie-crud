<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
?>
<div class="container">
<h1>Kaikki elokuvat </h1>

<!-- <table>
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
</table> -->
  <div class="row row-cols-3 row-cols-md-3 g-1">
    <?php

    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    if (!isset($id)) {
      http_response_code(400);
      echo "<h3>Genre ID parametri puuttuu</h3>";
      exit;
    }



    if ($id === 0) {
      $sql = "SELECT elokuva.id as id, elokuva.nimi as elokuva, vuosi, kesto, kieli, ikaraja, kuva_url, ohjaaja.nimi as ohjaaja FROM elokuva
left join ohjaaja on elokuva.ohjaaja_id = ohjaaja.id";
    } else {
      $sql = "SELECT elokuva.id as id, elokuva.nimi as elokuva, vuosi, kesto, kieli, ikaraja, kuva_url, ohjaaja.nimi as ohjaaja FROM elokuva
left join ohjaaja on elokuva.ohjaaja_id = ohjaaja.id WHERE elokuva.genre_id = $id";
    }

    $pdo = openDB();
    $elokuvat = $pdo->query($sql);
    if ($elokuvat->rowCount() > 0) {
      while ($row = $elokuvat->fetch()) {
        echo '<div class="col-3"> <div class="card" style="width: 18rem;">
      <img src="' . $row["kuva_url"] . 'class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">' . $row["elokuva"] . '</h5>
    <ul class="list-group list-group-flush">
    <li class="list-group-item">Vuosi: ' . $row["vuosi"] . '</li>
    <li class="list-group-item">Kesto: ' . $row["kesto"] . ' min'  . '</li>
    <li class="list-group-item">Kieli: ' . $row["kieli"] . '</li>
    <li class="list-group-item">Ikäraja: ' . $row["ikaraja"] . '</li>
    <li class="list-group-item">Ohjaaja: ' . $row["ohjaaja"] . '</li>
  </ul>
  </div>
</div> </div>';
      }
    }

    #echo '<tr>' . '<td>' . '<a href="single.php?id=' . $row["id"] . '">' . $row["elokuva"] . '</a>' . '</td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>' . '<td>' . $row["Ohjaaja"] . '</td>' . "</tr>";


    ?>
    <!-- </table> -->
  </div>
  </div>
    <?php
    include TEMPLATES_DIR . "foot.php";
    ?>