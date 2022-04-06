<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">MovieDB</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./">Etusivu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="movies.php">Elokuvat</a>
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Genret
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Komedia</a></li>
            <li><a class="dropdown-item" href="#">Kauhu</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="movies.php">Kaikki elokuvat</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>