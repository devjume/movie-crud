<?php
include TEMPLATES_DIR . "head.php";
require_once MODULES_DIR . "/inc/functions.php";
require_once MODULES_DIR . "/inc/headers.php";


$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if (isset($_GET['id']) && isset($_GET['delete'])) {
  if ($_GET['delete'] == true) {
    $id = $_GET['id'];
    try {
      $pdo = openDB();
      $sql = "delete from nayttelija_rooli where elokuva_id=?";
      $pdoStatement = $pdo->prepare($sql);
      $pdoStatement->bindParam(1,  $id);
      $pdoStatement->execute();

      $sql2 = "delete from arvostelu where elokuva_id=?";
      $pdoStatement = $pdo->prepare($sql2);
      $pdoStatement->bindParam(1,  $id);
      $pdoStatement->execute();

      $sql3 = "delete from elokuva where id=?";
      $pdoStatement = $pdo->prepare($sql3);
      $pdoStatement->bindParam(1,  $id);
      $pdoStatement->execute();

      header('Location: movies.php', true, 303);
      exit;
    } catch (PDOException $e) {
      returnError($e);
    }
  }
}


#if ($request_method === 'POST') {
#  $id = filter_input(INPUT_POST, "id");
#
#  if (!empty($_POST)) {
#
#    if (!isset($id) {
#      echo '<div class="alert alert-success" role="alert">Parametreja puuttui</div>';
#      exit;
#    }
#
#    header('Location: index.php', true, 303);
#    exit;
#  }
#} elseif ($request_method === 'GET') {
#  echo 
#}

?>

<table>
  <style>
    table,
    td,
    th {
      border: 1px solid black;
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
  #require_once "./inc/functions.php";
  #require_once "./inc/headers.php";
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
  if ($rowCount > 0) {
    while ($row = $pdoStatement->fetch()) {
      echo '<tr>' . '<td>' . $row["nimi"] . '</td>' . '<td>' . $row["vuosi"] . '</td>' . '<td>' . $row["kesto"] . '</td>' . '<td>' . $row["kieli"] . '</td>' . '<td>' . $row["ikaraja"] . '</td>' . "</tr>";
    }
  } else {
    echo "<h3 style='color:red'> Elokuvaa ei löytynyt syöttämäsi ID:n perusteella <h3>";
    exit;
  }
  ?>

  <form method="GET" action="single.php">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="delete" value="true">
    <button type="submit">Poista elokuva</button>
  </form>
</table>


<?php
include TEMPLATES_DIR . "foot.php";
?>