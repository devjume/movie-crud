<?php
include "./head.php";
require_once "./inc/functions.php";
require_once "./inc/headers.php";
echo '<h1>Index</h1>';
echo "<br>";
echo "<a href='./addmovie/addmovie.php'>Lisää elokuva</a>";
echo "<br>";
echo "<a href='movies.php'>Elokuvat</a>";
echo "<br>";
echo "<a href='./single.php?id=1'>Yksittäinen elokuva (Muuta id -> katso url '?id=2'</a>";
echo "<br>";

try {
  createTableRow();
} catch (PDOException $e) {
  returnError($e);
}
function createTableRow() {
$sql = "SELECT * FROM `elokuva`";
$pdo = openDB();
$elokuvat = $pdo->query($sql);

  if ($elokuvat->rowCount() > 0 ) {
    echo "<ul>";
  while ( $row = $elokuvat->fetch() ) {
      echo '<li> <a href="single.php?id='.$row["id"].'">'. '<img class="w-25 p-3; rounded" src="' .$row["kuva_url"]. '"alt=""/>'.'</a>'. 
    "<h2>". $row["nimi"]. "<h2><h3>". $row["vuosi"]. "<br>". $row["kesto"]. " min<br>Ikäraja: ". $row["ikaraja"]. "</h3></li>";
  }
  echo "</ul>";
}}
include "./foot.php";
