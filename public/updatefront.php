<?php
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
include TEMPLATES_DIR . "head.php";
$nimi = filter_input(INPUT_POST, "nimi");
$vuosi = filter_input(INPUT_POST, "vuosi");
$kesto = filter_input(INPUT_POST, "kesto");
$kieli = filter_input(INPUT_POST, "kieli");
$ikaraja = filter_input(INPUT_POST, "ikaraja");
$ohjaaja_id = filter_input(INPUT_POST, "ohjaaja_id");
$genre_id = filter_input(INPUT_POST, "genre_id");
$kuva_url = filter_input(INPUT_POST, "kuva_url");
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
<th>Genre</th>
<th>Posterilinkki</th>
<th>Muokkaa</th>
</tr>
<?php
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";
$id = $_GET['id'];
try {
    echo $id;
  $pdo = openDB();
  $sql = "SELECT elokuva.id, elokuva.nimi,elokuva.vuosi, elokuva.kesto,elokuva.kieli, elokuva.ikaraja, ohjaaja.nimi AS 'Ohjaaja', genre.nimi AS 'Genre', elokuva.kuva_url 
  FROM elokuva
  INNER JOIN ohjaaja ON elokuva.ohjaaja_id = ohjaaja.id 
  INNER JOIN genre ON elokuva.genre_id = genre.id ";
  $pdoStatement = $pdo->prepare($sql);
  
  $pdoStatement->execute();
  $rowCount = $pdoStatement->rowCount();
} catch (PDOException $e) {
  returnError($e);
}
if ( $rowCount > 0 ) {
  while($row = $pdoStatement->fetch()) {
    echo '<form method="post" action="updatefront.php?id='. $row["id"] .'">'.
     
    '<tr>' . '<td> <input name="nimi" value='. $row["nimi"] . '></td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>'. '<td>' . $row["Ohjaaja"] . '</td>'. '<td>' . $row["Genre"] . '</td>' . '<td>' . $row["kuva_url"] . '</td>' . 
   
    '<td><button type="submit">Muokkaa elokuvaa</button></td>
    </form>' . "</tr>" ;
  }
} else {
  echo "<h3 style='color:red'> Elokuvaa ei löytynyt syöttämäsi ID:n perusteella <h3>";
  exit;
}
?>
</table>