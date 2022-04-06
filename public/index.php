<?php
include TEMPLATES_DIR."head.php";
require_once MODULES_DIR."/inc/functions.php";
require_once MODULES_DIR ."/inc/headers.php";
echo '<h1>Index</h1>';
echo "<br>";

try {
  createTableRow();
} catch (PDOException $e) {
  returnError($e);
}

function createTableRow() {
$sql = "SELECT * FROM `elokuva` where kuva_url IS not NULL ORDER BY RAND () limit 5";
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
include TEMPLATES_DIR."foot.php";
