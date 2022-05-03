<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";


$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if (isset($_GET['id']) && isset($_GET['delete'])) {
  if ($_GET['delete'] == true) {
    $id = $_GET['id'];
    try {
      $pdo = openDB();
      $sql = "delete from nayttelija_rooli where elokuva_id=?";
      $pdoStatement = $pdo->prepare($sql);
      $pdoStatement->bindParam(1,  $id);
      $pdoStatement->execute();

      $sql2 = "delete from arvostelu where elokuva_id=?";
      $pdoStatement = $pdo->prepare($sql2);
      $pdoStatement->bindParam(1,  $id);
      $pdoStatement->execute();

      $sql3 = "delete from elokuva where id=?";
      $pdoStatement = $pdo->prepare($sql3);
      $pdoStatement->bindParam(1,  $id);
      $pdoStatement->execute();

      header('Location: index.php', true, 303);
      exit;
    } catch (PDOException $e) {
      returnError($e);
    }
  }
}

#if ($request_method === 'POST') {
#  $id = filter_input(INPUT_POST, "id");
#
#  if (!empty($_POST)) {
#
#    if (!isset($id) {
#      echo '<div class="alert alert-success" role="alert">Parametreja puuttui</div>';
#      exit;
#    }
#
#    header('Location: index.php', true, 303);
#    exit;
#  }
#} elseif ($request_method === 'GET') {
#  echo 
#}

?>

<?php 
function showDeleteButton($id) {
?>
<div class="d-flex flex-row mt-2">
<a class="btn btn-primary me-2" href="updatefront.php" role="button">Muokkaa</a>
 <form method="GET" action="single.php">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="delete" value="true">
    <button type="submit" class="btn btn-danger">Poista elokuva</button>
  </form>
  
</div>
<?php
}
?>

<?php 
function showEditButton() {
?>

<?php
}
?>


<?php

function showMovieDetails($data) {
?>
  <div class="container pt-2">
  <div class="row">
    <h1><?php echo $data["nimi"] ?></h1>
  </div>
  <div class="row row-cols-2">
    <div class="col-4">
      <img src="<?php echo $data['kuva_url'] ?>" style="max-height: 500px; width: auto" class="card-img-top" alt="poster">
    </div>
    <div class="col-5">
      <ul class="list-group">
        <li class="list-group-item fs-3">Vuosi: <?php echo $data["vuosi"] ?></li>
        <li class="list-group-item fs-3">Kesto: <?php echo $data["kesto"] ?> min</li>
        <li class="list-group-item fs-3">Kieli: <?php echo $data["kieli"] ?></li>
        <li class="list-group-item fs-3">Ikäraja: <?php echo $data["ikaraja"] ?></li>
        <li class="list-group-item fs-3">Genre: <?php echo $data["genre"] ?></li>
        <li class="list-group-item fs-3">Ohjaaja: <?php echo $data["ohjaaja"] ?></li>
      </ul>
      <?php 
        if(isset($_SESSION["username"])){
          showEditButton();
          showDeleteButton($data["id"]);
        }
       ?>
    </div>
    
  </div>

</div>
</div>
<?php
}
?>

<?php
function showActors($data) {
?>
  <div class="container pt-2">
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Näyttelijä</th>
            <th scope="col">Rooli</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $key => $actor) { ?>
          <tr>
            <th scope="row"><?php echo $key + 1?></th>
            <td><?php echo $actor["nimi"] ?></td>
            <td><?php echo $actor["rooli"] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
<?php
}
?>

<?php
  $id = $_GET['id'];
  try {
    $pdo = openDB();
    $movieDetailsSql = "SELECT elokuva.id, elokuva.nimi, elokuva.vuosi, elokuva.kesto, elokuva.kieli, elokuva.ikaraja, elokuva.kuva_url, ohjaaja.nimi as 'ohjaaja', genre.nimi as 'genre' from elokuva
    LEFT JOIN ohjaaja ON ohjaaja.id = elokuva.ohjaaja_id
    LEFT JOIN genre ON genre.id = elokuva.genre_id
    where elokuva.id=?;";
    $pdoStatement = $pdo->prepare($movieDetailsSql);
    $pdoStatement->bindParam(1,  $id);
    $pdoStatement->execute();
    $rowCount = $pdoStatement->rowCount();

    # Jos elokuvaa ei löydy näytetään käyttäjälle viesti
    if ($rowCount <= 0) {
      echo "<h3 style='color:red'> Elokuvaa ei löytynyt syöttämäsi ID:n perusteella <h3>";
      exit;
    }

    $movieDetails = $pdoStatement->fetch();
    showMovieDetails($movieDetails);
    

    $actorsSql = "SELECT concat(nayttelija.etunimi , ' ', nayttelija.sukunimi) as nimi, nayttelija_rooli.rooli from elokuva
    LEFT JOIN nayttelija_rooli ON nayttelija_rooli.elokuva_id= elokuva.id
    LEFT JOIN nayttelija ON nayttelija.id = nayttelija_rooli.nayttelija_id
    where elokuva.id=?;";

    $pdoStatement = $pdo->prepare($actorsSql);
    $pdoStatement->bindParam(1,  $id);
    $pdoStatement->execute();

    $actors = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    if(!empty( $actors[0]["nimi"])) {
      showActors($actors);
    }

  } catch (PDOException $e) {
    returnError($e);
  }
  ?>

 

<?php
include TEMPLATES_DIR . "foot.php";
?>