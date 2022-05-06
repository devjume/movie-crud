<?php
include TEMPLATES_DIR . "head.php";
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  $_SESSION['msg'] = "You have to log in first";
  exit;
}
session_start();

$errors = [];
$inputs = [];
$valid = false;

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'POST') {
  $nimi = filter_input(INPUT_POST, "nimi");
  $vuosi = filter_input(INPUT_POST, "vuosi");
  $kesto = filter_input(INPUT_POST, "kesto", FILTER_VALIDATE_INT);
  $kieli = filter_input(INPUT_POST, "kieli");
  $ikaraja = filter_input(INPUT_POST, "ikaraja", FILTER_VALIDATE_INT);
  $ohjaaja = filter_input(INPUT_POST, "ohjaaja");
  $genre = filter_input(INPUT_POST, "genre");
  $kuva_url = filter_input(INPUT_POST, "kuva", FILTER_DEFAULT);
  $nayttelijat = filter_input(INPUT_POST, "nayttelijat", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

  # Jos post parametreja on määritelty niin tee tarkastukset ja lisää lopuksi elokuva tietokantaan
  if (!empty($_POST)) {
    require_once MODULES_DIR . "addmovie.php";

    # Tarkistaa, että kaikki vaadittavat parametrit on löytyy
    if (!isset($nimi) || !isset($genre) || empty($nimi) || empty($genre)) {
      echo '<div class="alert alert-success" role="alert">Parametreja puuttui</div>';
      exit;
    }

    # Tarkistaa onko vuosi, kesto ovat numeroita
    #if (isset($vuosi) | isset($kesto) && !filter_var($vuosi, FILTER_VALIDATE_INT) || !filter_var($kesto, FILTER_VALIDATE_INT)) {
    #  echo '<div class="alert alert-success" role="alert">Vuosi ja kesto tulee olla numeroina</div>';
    #}

    if (!empty($ikaraja)) {
      #echo '<div class="alert alert-success" role="alert">Ikäraja tyhjä</div>';
      # Varmistaa, että ikäraja on tyhjä, 0, 7, 16 tai 18
      if ($ikaraja !== 0 && $ikaraja !== 7 && $ikaraja !== 16 && $ikaraja !== 18) {
        echo '<div class="alert alert-success" role="alert">Ikärajan tulee olla tyhjä, 0, 7, 16 tai 18</div>';
        exit;
      }
    }

    foreach ($nayttelijat as $nayttelija) {
      echo $nayttelija['rooli'] . "<br>";
      echo $nayttelija['sukupuoli'] . "<br>";
      echo $nayttelija['etunimi'] . "<br>";
      echo $nayttelija['sukunimi'] . "<br>";
    };


    // Kutsuu lisaaElokuva funktiota src/modules/addmovie.php tiedostosta
    $viesti = lisaaElokuva($nimi, $vuosi, $kesto, $kieli, $ohjaaja, $ikaraja, $genre, $kuva_url, $nayttelijat);
    #echo '<div class="alert alert-success" role="alert">Elokuva lisätty</div>';
    $valid = true;
  }

  $_SESSION['valid'] = $valid;
  $_SESSION['errors'] = $errors;
  $_SESSION['inputs'] = $inputs;

  // Ohjaa takaisin samalle sivulle get kutsulla
  header('Location: addmovie.php', true, 303);
  exit;
} elseif ($request_method === 'GET') {
  if (isset($_SESSION['valid'])) {
    $valid = $_SESSION['valid'];
    unset($_SESSION['valid']);
  }

  if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
  }

  if (isset($_SESSION['inputs'])) {
    $errors = $_SESSION['inputs'];
    unset($_SESSION['inputs']);
  }
}

?>

<div class="container pt-2">
  <!-- Näyttää onnistumis viestin -->
  <?php if ($valid) {
    echo '<div class="alert alert-success" role="alert">Elokuva lisätty</div>';
  } ?>

  <!-- Perus html -->
  <h3>Lisää elokuva</h3>

  <form action="addmovie.php" method="POST" id="elokuva-form" class="row g-3">
    <div class="col-2">
      <label for="nimi-input" class="form-label">Elokuva:</label>
      <input type="text" name="nimi" id="nimi-input" class="form-control" placeholder="Elokuvan nimi" required>
    </div>
    <div class="col-1">
      <label for="vuosi-input" class="form-label">Vuosi:</label>
      <input list="vuosiluku" id="vuosi-input" name="vuosi" class="form-control">
      <datalist id="vuosiluku">
        <?php
        foreach (range(date("Y") + 5, 1888) as $year) {
          echo "<option>{$year}</option>";
        }
        ?>
      </datalist>
    </div>
    <div class="col-1">
      <label for="kesto-input" class="form-label">Kesto:</label>
      <input type="number" name="kesto" id="kesto-input" class="form-control" placeholder="min" min=0>
    </div>
    <div class="col-2">
      <label for="kieli-input" class="form-label">Kieli:</label>
      <input type="text" name="kieli" id="kieli-input" class="form-control">
    </div>
    <div class="col-2">
      <label for="ikaraja-input" class="form-label">Ikäraja:</label>
      <select name="ikaraja" id="ikaraja-input" class="form-control">
        <option value="" selected>Ei luokiteltu</option>
        <option value="0">S</option>
        <option value="7">K7</option>
        <option value="16">K16</option>
        <option value="18">K18</option>
      </select>
    </div>
    <div class="col-2">
      <label for="ohjaaja-input" class="form-label">Ohjaaja:</label>
      <input list="ohjaajat" name="ohjaaja" id="ohjaaja-input" class="form-control" placeholder="Ohjaaja">
      <datalist id="ohjaajat">
        <?php
        require_once MODULES_DIR . "/inc/functions.php";
        try {
          $db = openDB();

          $sql = "SELECT `id`, `nimi` FROM `ohjaaja`;";
          $query = $db->query($sql);
          $result = $query->fetchAll();

          foreach ($result as $row) {
            echo "<option value=\"{$row['nimi']}\"}>";
          }
        } catch (PDOException $e) {
          returnError($e);
        }
        ?>
      </datalist>
    </div>
    <div class="col-2">
      <label for="genre-input" class="form-label">Genre:</label>
      <input list="genret" name="genre" id="genre-input" class="form-control" placeholder="Genre" required>
      <datalist id="genret">
        <?php
        require_once MODULES_DIR . "/inc/functions.php";
        try {
          $db = openDB();

          $sql = "SELECT `nimi` FROM `genre`; ";
          $query = $db->query($sql);
          $result = $query->fetchAll();

          foreach ($result as $row) {
            echo "<option value=\"{$row['nimi']}\"}>";
          }
        } catch (PDOException $e) {
          returnError($e);
        }
        ?>
      </datalist>
    </div>

    <div class="col-6">
      <label for="kuva-input" class="form-label">Kuvan URL:</label>
      <input type="text" name="kuva" id="kuva-input" class="form-control">
    </div>

    <h5>Lisää näyttelijöitä</h5>
    <div class="col-12 row" id="nayttelija-lisaus">
      <div class="nayttelija-rivi row mt-2">
        <div class="col-2">
          <div class="form-floating">
            <input list="etunimet" name="nayttelijat[1][etunimi]" id="etunimi-input-1" class="form-control" placeholder="Etunimi">
            <label for="nayttelija-input-1">Etunimi</label>
          </div>
        </div>
        <div class="col-2">
          <div class="form-floating">
            <input list="sukunimet" name="nayttelijat[1][sukunimi]" id="sukunimi-input-1" class="form-control" placeholder="Sukunimi">
            <label for="nayttelija-input-2">Sukunimi</label>
          </div>
        </div>
        <div class="col-2">
          <div class="form-floating">
            <input type="text" name="nayttelijat[1][rooli]" id="rooli-input-1" class="form-control" placeholder="Rooli">
            <label for="rooli-input-1">Rooli</label>
          </div>
        </div>
        <div class="col-2">
          <div class="form-floating">
            <select name="nayttelijat[1][sukupuoli]" id="sukupuoli-input-1" class="form-select">
              <option value=""></option>
              <option value="mies">Mies</option>
              <option value="nainen">Nainen</option>
              <option value="muu">Muu</option>
            </select>
            <label for="sukupuoli-input-1">Sukupuoli</label>
          </div>
        </div>
        <!-- Datalista näyttelijöistä on erikseen, jotta se ei monistu turhaan kun lisätään useampi näyttelijä -->
        <datalist id="etunimet">
          <?php
          require_once MODULES_DIR . "/inc/functions.php";
          try {
            $db = openDB();

            $sql = "SELECT `id`, `etunimi`FROM `nayttelija`;";
            $query = $db->query($sql);
            $result = $query->fetchAll();

            foreach ($result as $row) {
              echo "<option value=\"{$row['etunimi']}\"}>";
            }
          } catch (PDOException $e) {
            returnError($e);
          }
          ?>
        </datalist>
        <datalist id="sukunimet">
          <?php
          require_once MODULES_DIR . "/inc/functions.php";
          try {
            $db = openDB();

            $sql = "SELECT `id`, `sukunimi` FROM `nayttelija`;";
            $query = $db->query($sql);
            $result = $query->fetchAll();

            foreach ($result as $row) {
              echo "<option value=\"{$row['sukunimi']}\"}>";
            }
          } catch (PDOException $e) {
            returnError($e);
          }
          ?>
        </datalist>
      </div>


      <div class="col-2 d-flex mt-3">
        <button type="button" id="lisaa-nayttelija" class="btn btn-secondary">Lisää näyttelijöitä</button>
      </div>
    </div>

    <div class="col-12 d-grid">
      <button type="submit" class="btn btn-primary">Lisää</button>
    </div>
  </form>

</div>

<script>
  window.onload = () => {
    // Resetoi lomake, kun sivu latautuu
    document.getElementById("elokuva-form").reset();
  }

  // Luo uusi lomake rivi jokaiselle näyttelijälle
  document.getElementById("lisaa-nayttelija").addEventListener("click", () => {
    const parentDiv = document.getElementById("nayttelija-lisaus");
    const latestRow = parentDiv.children[parentDiv.childElementCount - 2];
    const clone = latestRow.cloneNode(true);
    const btn = parentDiv.children[parentDiv.childElementCount - 1];
    parentDiv.insertBefore(clone, btn);

    // Lisää yksi numero edellisen näyttelijän id, htmlfor ja name attribuutteihin
    for (let i = 0; i < 4; i++) {
      clone.children[i].firstElementChild.firstElementChild.value = null;

      // Name attribuutti
      const nameAttribute = clone.children[i].firstElementChild.firstElementChild.name;
      const nameInt = parseInt(nameAttribute.match(/\d+/g));
      clone.children[i].firstElementChild.firstElementChild.name = nameAttribute.replace(nameInt, nameInt + 1)

      // Id ja htmlfor attribuutti
      const idAttribute = clone.children[i].firstElementChild.firstElementChild.id;
      const idInt = parseInt(idAttribute.match(/\d+/g));
      clone.children[i].firstElementChild.firstElementChild.id = idAttribute.replace(idInt, idInt + 1);
      clone.children[i].firstElementChild.lastElementChild.htmlFor = idAttribute.replace(idInt, idInt + 1);
      console.log(clone.children[i].firstElementChild.firstElementChild.id);
      console.log(clone.children[i].firstElementChild.lastElementChild.htmlFor);
    }

  });
</script>


<?php
include TEMPLATES_DIR . "foot.php";
?>