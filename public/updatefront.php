<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
if (!isset($_SESSION['username'])) {
  header("Location: ".PUBLIC_DIR."index.php");
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
?>

<table>
<style>
    table, td, th {
    border:1px solid black;
    }
</style>
<tr>
<th>Nimi</th>
<th>Tulovuosi</th>
<th>Kesto(min)</th>
<th>Kieli</th>
<th>Ikäraja</th>
<th>Ohjaaja</th>
<th>Posterilinkki</th>
<th>Genre</th>
<th>Muokkaa</th>
</tr>
<?php
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
require_once MODULES_DIR . "updatemovie.php";
$id = $_GET['id'];
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

if(isset($id)){
  try{
      updateMovie($id, $nimi, $vuosi, $kesto, $kieli, $ikaraja, $ohjaaja_id, $genre_id, $kuva_url, $ohjaaja_vanha, $genre_vanha);
      echo '<div class="alert alert-success" role="alert">Elokuvaa muokattu!</div>';
  }catch(Exception $e){
      echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
  }
  
}

if ( $rowCount > 0 ) {
  while($row = $pdoStatement->fetch()) {
    ?>
    <form method="post" action="updatefront.php?id=  <?php echo $row["id"] ?>">
    <tr><td> <input name="nimi" value= "<?php echo ($row["nimi"]) ?>"></td>
    <td> <input name="vuosi" value= "<?php echo $row["vuosi"] ?>"> </td>
    <td> <input name="kesto" value= "<?php echo $row["kesto"] ?>"> </td>
    <td> <input name="kieli" value= "<?php echo $row["kieli"] ?>"> </td>
    <td> <input name="ikaraja" value= "<?php echo $row["ikaraja"] ?>"> </td>
    <td> <input name="ohjaaja_id" value= "<?php print $row["Ohjaaja"] ?>"> </td>
    <td> <input name="kuva_url" value= "<?php echo $row["kuva_url"] ?>"></td>
    <input type="hidden" name="ohjaaja_vanha" value="<?php print $row["Ohjaaja"] ?>"></input>
    <td> <select name="genre_id" value= "<?php echo $row["Genre"] ?>">
    <?php
            require_once MODULES_DIR . "/inc/functions.php";
            try {
              $db = openDB();

              $sql = "SELECT `id`, `nimi` FROM `genre`;";
              $query = $db->query($sql);
              $result = $query->fetchAll();

              foreach ($result as $row1) {
                if($row1['id'] == $row["Genre"]){
                  echo "<option selected value=\"{$row1['id']}\">{$row1['nimi']}</option>";
                }
                else{
                  echo "<option value=\"{$row1['id']}\">{$row1['nimi']}</option>";
                }
              }
            } catch (PDOException $e) {
              returnError($e);
            }
            ?>
    </select> </td>
    <td><button type="submit">Muokkaa elokuvaa</button></td>
    </form></tr>

    
    <?php
  }
} else {
  echo "<h3 style='color:red'> Elokuvaa ei löytynyt syöttämäsi ID:n perusteella <h3>";
  exit;
}
?>
</table>

<?php
include TEMPLATES_DIR . "foot.php";
?>