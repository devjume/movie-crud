<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
include TEMPLATES_DIR . "movieCard.php";
?>

<div class="container">
  <h1>Elokuva tietokanta </h1>
  <div class="row row-cols-3 row-cols-md-3 d-flex justify-content-start">
    <?php
    try {
      $sql = "SELECT elokuva.id as id, elokuva.nimi as elokuva, vuosi, kesto, kieli, ikaraja, kuva_url, ohjaaja.nimi as ohjaaja FROM elokuva
      left join ohjaaja on elokuva.ohjaaja_id = ohjaaja.id
      where kuva_url IS not NULL ORDER BY RAND () limit 12";
      $pdo = openDB();
      $elokuvat = $pdo->query($sql);

      if ($elokuvat->rowCount() > 0) {
        while ($row = $elokuvat->fetch()) {
          createSingleCard($row);
        }
      }
    } catch (PDOException $e) {
      returnError($e);
    }
    ?>
  </div>
</div>

<?php
include TEMPLATES_DIR . "foot.php";
?>
