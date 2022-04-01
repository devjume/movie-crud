<?php
require_once "../head.php";
?>

<div class="container pt-2">

  <h3>Lisää elokuva</h3>

  <form action="backend.php" method="POST" id="elokuva-form" class="row g-3">
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
        <option selected value="">Ei luokiteltu</option>
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

    <div class="col-6">
      <label for="kuva-input" class="form-label">Kuvan URL:</label>
      <input type="text" name="kuva" id="kuva-input" class="form-control">
    </div>

    <h5>Lisää näyttelijöitä</h5>
    <div class="col-12 row" id="nayttelija-lisaus">
      <div class="nayttelija-rivi row mt-2">
        <div class="col-2">
          <div class="form-floating">
            <input list="nayttelijat" name="nayttelijat[1][nimi]" id="nayttelija-input-1" class="form-control" placeholder="Nimi">
            <label for="nayttelija-input-1">Nimi</label>
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
              <option value="null"></option>
              <option value="mies">Mies</option>
              <option value="nainen">Nainen</option>
              <option value="muu">Muu</option>
            </select>
            <label for="sukupuoli-input-1">Sukupuoli</label>
          </div>
        </div>
        <!-- Datalista näyttelijöistä on erikseen, jotta se ei monistu turhaan kun lisätään useampi näyttelijä -->
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
    for (let i = 0; i < 3; i++) {
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
require_once "../foot.php";
?>