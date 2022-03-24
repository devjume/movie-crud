<?php
require_once "../head.php";
?>

<div class="container pt-2">

  <h3>Lisää elokuva</h3>

  <form action="backend.php" method="POST" class="row g-3">
    <div class="col-2">
      <label for="nimi-input" class="form-label">Elokuva:</label>
      <input type="text" name="nimi" id="nimi-input" class="form-control" placeholder="Elokuvan nimi">
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
        <option selected value="null">Ei luokiteltu</option>
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
      <input list="genret" name="genre" id="genre-input" class="form-control" placeholder="Genre">
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

    <h5>Lisää näyttelijöitä</h5>
    <div class="col-12 row">
      <div class="nayttelija-rivi row">
        <div class="col-2">
          <div class="form-floating">
            <input list="nayttelijat" name="nayttelijat[][nimi]" id="nayttelija-input" class="form-control" placeholder="Nimi">
            <datalist id="nayttelijat">
              <?php
              require_once "../inc/functions.php";
              try {
                $db = openDB();

                $sql = "SELECT `id`, CONCAT(`etunimi`, ' ', `sukunimi`) AS nimi FROM `nayttelija`;";
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
            <label for="nayttelija-input">Nimi</label>
          </div>

        </div>
        <div class="col-2">
          <div class="form-floating">
            <input type="text" name="nayttelijat[][rooli]" id="rooli-input" class="form-control" placeholder="Rooli">
            <label for="rooli-input">Rooli</label>
          </div>
        </div>
        <div class="col-2">
          <div class="form-floating">
            <select name="nayttelijat[][sukupuoli]" id="sukupuoli-input" class="form-select">
              <option value="null"></option>
              <option value="mies">Mies</option>
              <option value="nainen">Nainen</option>
              <option value="muu">Muu</option>
            </select>
            <label for="sukupuoli-input">Sukupuoli</label>
          </div>

        </div>
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

</form>

</div>

<script>
  document.getElementById("lisaa-nayttelija").addEventListener("click", () => {
    const node = document.getElementsByClassName("nayttelija-rivi")[0];
    const clone = node.cloneNode(true);
    const btn = node.parentElement.lastElementChild;
    node.parentElement.insertBefore(clone, btn);
    for (let i = 0; i < 3; i++) {
      const label = clone.children[i].firstElementChild.lastElementChild.htmlFor += "23";
      console.log(label);
      console.log(clone.children[i].firstElementChild.lastElementChild.htmlFor.slice(0,-1));
    }

  });
</script>


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