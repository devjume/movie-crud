<?php
require_once "./inc/functions.php";
require_once "./inc/headers.php";
require_once "head.php";
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
</tr>
<?php
require_once "./inc/functions.php";
require_once "./inc/headers.php";
$id = $_GET['id'];
try {
  $pdo = openDB();
  $sql = "SELECT * from elokuva where id=?";
  $pdoStatement = $pdo->prepare($sql);
  $pdoStatement->bindParam(1,  $id);
  $pdoStatement->execute();
  $rowCount = $pdoStatement->rowCount();
} catch (PDOException $e) {
  returnError($e);
}
if ( $rowCount > 0 ) {
  while($row = $pdoStatement->fetch()) {
   echo '<tr>' . '<td>'. $row["nimi"] . '</td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>' . "</tr>" . 
   '<form method="post" action="deletemovie.php?id='. $row["id"] .'">
    <button type="submit">Poista elokuva</button>
    </form>';
  }
} else {
  
  echo "Elokuvaa ei löytynyt syöttämäsi ID:n perusteella";
  exit;
}
?>
</table>