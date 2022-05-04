<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container">
    <a class="navbar-brand" href="./">MovieDB</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Elokuvat
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php
            require_once MODULES_DIR . "/inc/functions.php";
            try {
              $db = openDB();

              $sql = "SELECT `id`, `nimi` FROM `genre`;";
              $query = $db->query($sql);
              $result = $query->fetchAll();

              foreach ($result as $row) {
                echo "<li><a class='dropdown-item' href='movies.php?id={$row['id']}'>{$row['nimi']}</a></li>";
              }
            } catch (PDOException $e) {
              returnError($e);
            }
            ?>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="movies.php?id=0">Kaikki elokuvat</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="addrating.php">Anna Arvostelu</a>
        </li>

        
        <?php
        if (!isset($_SESSION['username'])) {
          $_SESSION['msg'] = "You have to log in first";
        }
        else{
          echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="addmovie.php">Lisää Elokuva</a></li>';
        }
        
        if (!isset($_SESSION['username'])) {
          $_SESSION['msg'] = "You have to log in first";

        }
        else{
          echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="updatefront.php">Muokkaa Elokuvaa</a></li>';
        }
        
        ?>

      </ul>
      <?php
        if (isset($_SESSION["username"])) {
          echo '<a class="btn btn-outline-danger ms-auto" href="logout.php">Kirjaudu Ulos</a>';
        } else {
          echo '<a class="btn btn-outline-success ms-auto" href="login.php">Kirjaudu Sisään</a>';
        }
      ?>
    </div>
  </div>
</nav>