<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";

include TEMPLATES_DIR . "movieCard.php";
?>
<div class="container">
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
              echo '<h1>Kaikki elokuvat </h1><div class="row row-cols-3 row-cols-md-3 g-1">';
    } else {
      $sql = "SELECT elokuva.id as id, elokuva.nimi as elokuva, vuosi, kesto, kieli, ikaraja, kuva_url, ohjaaja.nimi as ohjaaja, genre.nimi as genre FROM elokuva
              left join ohjaaja on elokuva.ohjaaja_id = ohjaaja.id left join genre on elokuva.genre_id = genre.id WHERE elokuva.genre_id = $id";
              $pdo = openDB();
              $elokuvat = $pdo->query($sql);
              $row = $elokuvat->fetch();
              echo '<h1>' .$row["genre"]. '</h1>'. '<div class="row row-cols-3 row-cols-md-3 g-1">';
    }

    $pdo = openDB();
    $elokuvat = $pdo->query($sql);
    if ($elokuvat->rowCount() > 0) {
      while ($row = $elokuvat->fetch()) {
        #Kutsuu movieCard.php template tiedoston funktiota, joka luo elokuva kortit
        createSingleCard($row);
      }
    }
    ?>
  </div>
</div>
    <?php
    include TEMPLATES_DIR . "foot.php";
    ?>