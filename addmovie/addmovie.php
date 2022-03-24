<?php
require_once "../head.php";
?>

<div class="container">

  <h1>Lisää elokuva</h1>

  <form action="#" class="row g-3">
    <div class="col-2">
      <label for="nimi-input" class="form-label">Elokuva:</label>
      <input type="text" name="nimi-input" id="nimi-input" class="form-control" placeholder="Elokuvan nimi">
    </div>
    <div class="col-1">
      <label for="vuosi-input" class="form-label">Vuosi:</label>
      <input list="vuosiluku" id="vuosi-input" class="form-control">
      <datalist id="vuosiluku">
        <?php
        foreach (range(date("Y") + 5, 1888) as $year) {
          echo "<option value=\"{$year}\">";
        }
        ?>
      </datalist>
    </div>
    <div class="col-1">
      <label for="kesto-input" class="form-label">Kesto:</label>
      <input type="number" name="kesto-input" id="kesto-input" class="form-control" placeholder="min" min=0>
    </div>
    <div class="col-2">
      <label for="kieli-input" class="form-label">Kieli:</label>
      <input type="text" name="kieli-input" id="kieli-input" class="form-control">
    </div>
    <div class="col-2">
      <label for="ikaraja-input" class="form-label">Ikäraja:</label>
      <select name="ikaraja-input" id="ikaraja-input" class="form-control">
        <option selected value="?">Ei luokiteltu</option>
        <option value="S">S</option>
        <option value="7">K7</option>
        <option value="16">K16</option>
        <option value="18">K18</option>
      </select>
    </div>
    <div class="col-2">
      <label for="ohjaaja-input" class="form-label">Ohjaaja:</label>
      <input list="ohjaajat" id="ohjaaja-input" class="form-control" placeholder="Ohjaaja">
      <datalist id="ohjaajat">
        <?php
        require_once "../inc/functions.php";
        try {
          $db = openDB();

          $sql = "SELECT `id`, CONCAT(`etunimi`, ' ', `sukunimi`) AS nimi FROM `ohjaaja`;";
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
      <input list="genret" id="genre-input" class="form-control" placeholder="Genre">
      <datalist id="genret">
        <?php
        require_once "../inc/functions.php";
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

    <div class="offset-4 col-4 d-grid">
      <button type="submit" class="btn btn-primary">Lisää</button>
    </div>


</div>

<div class="col-12">







</div>
</form>

</div>

<?php
require_once "../foot.php";
?>
<?php
# ELOKUVA
#nimi
#vuosi
#kesto (min)
#kieli
#ikäraja
#ohjaaja id
#genre id

# OHJAAJA
#etunimi
#sukunimi

# NÄYTTELIJÄ
#etunimi
#sukunimi
#sukupuoli

# NÄYTTELIJÄ - ROOLI
# näyttelijä id 
# elokuva id
# rooli

?>