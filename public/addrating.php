<?php
include TEMPLATES_DIR . "head.php";

$errors = [];
$inputs = [];
$valid = false;
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'POST') {
  $nimi = filter_input(INPUT_POST, "elokuva");
  $tahdet = filter_input(INPUT_POST, "tahdet");
  $kommentti = filter_input(INPUT_POST, "kommentti");
  $arvostelija = filter_input(INPUT_POST, "arvostelija");

  // Jos post parametreja on määritelty -> tarkastaa ne ja kutsuu funktiota modules/addrating.php tiedostosta
  if (!empty($_POST)) {
    require_once MODULES_DIR . "addrating.php";

    # Tarkistaa, että kaikki vaadittavat parametrit on löytyy
    if (!isset($nimi) || !isset($tahdet) || empty($nimi) || empty($tahdet)) {
      #http_response_code(400);
      #print json_encode(array("error" => "Parametreja puuttui"));
      echo "failed";
      echo '<div class="alert alert-success" role="alert">Parametreja puuttui</div>';
      exit;
    }

    $viesti = lisaaArvostelu($nimi, $tahdet, $kommentti, $arvostelija);
    #echo '<div class="alert alert-success" role="alert">Arvostelu lisätty</div>';
    $valid = true;
  }

  $_SESSION['valid'] = $valid;
  $_SESSION['errors'] = $errors;
  $_SESSION['inputs'] = $inputs;

  // Ohjaa takaisin samalle sivulle get kutsulla
  header('Location: addrating.php', true, 303);
  exit;
} elseif ($request_method === 'GET') {
  if (isset($_SESSION['valid'])) {
    // get the valid state from the session
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
  <h3>Anna arvostelu</h3>

  <form action="addrating.php" method="POST" id="elokuva-form" class="row g-3">
    <div class="col-2">
      <label for="elokuva" class="form-label">Elokuva:</label>
      <input list="elokuva-dl" name="elokuva" id="elokuva-input" class="form-control" placeholder="Elokuva">
      <datalist id="elokuva-dl">

        <?php
        require_once MODULES_DIR . "/inc/functions.php";
        try {
          $db = openDB();

          $sql = "SELECT `nimi` FROM `elokuva`;";
          $query = $db->query($sql);
          $result = $query->fetchAll();

          foreach ($result as $row) {
            echo "<option value=\"{$row['nimi']}\">";
          }
        } catch (PDOException $e) {
          returnError($e);
        }
        ?>
      </datalist>
    </div>
    <div class="col-1">
      <label for="tahdet" class="form-label">Tähdet:</label>
      <select class="form-select" id="tahdet" name="tahdet">
        <?php
        foreach (range(1, 5) as $tahdet) {
          echo "<option value='{$tahdet}'>$tahdet</option>";
        }
        ?>
      </select>
    </div>
    <div class="col-6">
      <label for="kommentti" class="form-label"> Arvostelu: </label>
      <textarea name="kommentti" id="kommentti" rows="1" class="form-control h-25"></textarea>
    </div>

    <div class="col-3">
      <label for="arvostelija" class="form-label"> Arvostelija: </label>
      <input name="arvostelija" id="arvostelija" class="form-control"><br>

    </div>
    <div class="col-12 d-grid">
      <button type="submit" class="btn btn-primary">Lisää</button>
    </div>
  </form>
</div>





<?php
include TEMPLATES_DIR . "foot.php";
?>