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
          <a class="nav-link active" aria-current="page" href="addmovie.php">Lisää Elokuva</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="addrating.php">Lisää Arvostelu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="single.php?id=1">Yksittäinen elokuva (?id=X)</a>
        </li>

      </ul>
    </div>
  </div>
</nav>