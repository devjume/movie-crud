<?php
require_once "head.php";
?>
<form action="ratingform.php" method="POST" id="elokuva-form" class="row g-3">
  <div class="col-1">
    <label for="elokuva" class="form-label">Elokuva:</label>
    <input list="elokuva-dl" name="elokuva" id="elokuva-input" class="form-control" placeholder="Elokuva">
    <datalist id="elokuva-dl">

      <?php
      require_once "./inc/functions.php";
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
  <div class="col-2">
    <label for="tahdet" class="form-label">Tähdet:</label>
    <select class="form-select" id="tahdet" name="tahdet">
      <?php
      foreach (range(1, 5) as $tahdet) {
        echo "<option value='{$tahdet}'>$tahdet</option>";
      }
      ?>
    </select>
  </div>
  <div class="col-3">
    <label for="kommentti"> Arvostelu: </label>
    <textarea name="kommentti" id="kommentti"></textarea><br>
  </div>

  <div class="col-4">
    <label for="arvostelija"> Arvostelija: </label>
    <input name="arvostelija" id="arvostelija"><br>

  </div>
  <input type="submit" value="Lisää">
</form>
<?php
require_once "./foot.php";
?>