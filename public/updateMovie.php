<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  $_SESSION['msg'] = "You have to log in first";
  exit;
}
$nimi = filter_input(INPUT_POST, "nimi");
$vuosi = filter_input(INPUT_POST, "vuosi");
$kesto = filter_input(INPUT_POST, "kesto");
$kieli = filter_input(INPUT_POST, "kieli");
$ikaraja = filter_input(INPUT_POST, "ikaraja");
$ohjaaja_id = filter_input(INPUT_POST, "ohjaaja_id");
$genre_id = filter_input(INPUT_POST, "genre_id");
$kuva_url = filter_input(INPUT_POST, "kuva_url");
$ohjaaja_vanha = filter_input(INPUT_POST, "ohjaaja_vanha");
$genre_vanha = filter_input(INPUT_POST, "genre_vanha");

//jos elokuvaa on päivitetty
if ( isset($_GET['updated']) && $_GET['updated'] == 1 )
{
  //näytetään siitä ilmoitus
    echo '<div class="alert alert-success" role="alert">Elokuvaa muokattu!</div>';
}
?>

<div class="container-fluid px-5 py-2">
  <div class="row">

    <table class="table-responsive">
      <thead>
        <tr class="d-flex">
          <th class="col-2">Nimi</th>
          <th class="col-1">Tulovuosi</th>
          <th class="col-1">Kesto(min)</th>
          <th class="col-1">Kieli</th>
          <th class="col-1">Ikäraja</th>
          <th class="col-2">Ohjaaja</th>
          <th class="col-2">Posterilinkki</th>
          <th class="col-1">Genre</th>
          <th class="col-1">Tallenna</th>
        </tr>
      </thead>
      <tbody>

        <?php
        require_once MODULES_DIR . "/inc/functions.php";
        require_once MODULES_DIR . "/inc/headers.php";
        require_once MODULES_DIR . "updatemovie.php";
        
        $request_method = strtoupper($_SERVER['REQUEST_METHOD']);

        if ($request_method === 'POST') {
          $id = $_GET['id'];
        }



        try {
          $pdo = openDB();
          $sql = "SELECT elokuva.id, elokuva.nimi,elokuva.vuosi, elokuva.kesto,elokuva.kieli, elokuva.ikaraja, ohjaaja.nimi AS 'Ohjaaja', genre.id AS 'Genre', elokuva.kuva_url 
                FROM elokuva
                INNER JOIN ohjaaja ON elokuva.ohjaaja_id = ohjaaja.id 
                INNER JOIN genre ON elokuva.genre_id = genre.id ";
          $pdoStatement = $pdo->prepare($sql);

          $pdoStatement->execute();
          $rowCount = $pdoStatement->rowCount();
        } catch (PDOException $e) {
          returnError($e);
        }

        if (isset($id)) {
          try {
            updateMovie($id, $nimi, $vuosi, $kesto, $kieli, $ikaraja, $ohjaaja_id, $genre_id, $kuva_url, $ohjaaja_vanha, $genre_vanha);
            //ohjataan takaisin samalle sivulle, mutta annetaan sivun tietää, että elokuvan tietoja on päivitetty
            header( "Location: updateMovie.php?updated=1");
          } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">' . $e->getMessage() . '</div>';
          }
        }

        if ($rowCount > 0) {
          while ($row = $pdoStatement->fetch()) {
        ?>
            <form method="post" action="updateMovie.php?id=  <?php echo $row["id"] ?>">

              <tr class="d-flex">
                <td class="col-2"> <input name="nimi" class="w-100 form-control" value="<?php echo ($row["nimi"]) ?>"></td>
                <td class="col-1"> <input name="vuosi" class="w-100 form-control" value="<?php echo $row["vuosi"] ?>"> </td>
                <td class="col-1"> <input name="kesto" class="w-100 form-control" value="<?php echo $row["kesto"] ?>"> </td>
                <td class="col-1"> <input name="kieli" class="w-100 form-control" value="<?php echo $row["kieli"] ?>"> </td>
                <td class="col-1"> <input name="ikaraja" class="w-100 form-control" value="<?php echo $row["ikaraja"] ?>"> </td>
                <td class="col-2"> <input name="ohjaaja_id" class="w-100 form-control" value="<?php echo $row["Ohjaaja"] ?>"> </td>
                <td class="col-2"> <textarea name="kuva_url" class="w-100 form-control" rows="1" style="height: 0px;"><?php echo $row["kuva_url"] ?></textarea></td>
                <td class="col-1"> <select name="genre_id" class="w-100 form-select" value="<?php echo $row["Genre"] ?>">
                    <?php
                    require_once MODULES_DIR . "/inc/functions.php";
                    try {
                      $db = openDB();

                      $sql = "SELECT `id`, `nimi` FROM `genre`;";
                      $query = $db->query($sql);
                      $result = $query->fetchAll();

                      foreach ($result as $row1) {
                        if ($row1['id'] == $row["Genre"]) {
                          echo "<option selected value=\"{$row1['id']}\">{$row1['nimi']}</option>";
                        } else {
                          echo "<option value=\"{$row1['id']}\">{$row1['nimi']}</option>";
                        }
                      }
                    } catch (PDOException $e) {
                      returnError($e);
                    }
                    ?>
                  </select> </td>
                <td class="col-1"><button type="submit" class="w-100 btn btn-success">Tallenna</button></td>
              </tr>
              <input type="hidden" name="ohjaaja_vanha" value="<?php print $row["Ohjaaja"] ?>"></input>
            </form>


        <?php
          }
        } else {
          echo "<h3 style='color:red'> Elokuvaa ei löytynyt syöttämäsi ID:n perusteella <h3>";
          exit;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include TEMPLATES_DIR . "foot.php";
?>