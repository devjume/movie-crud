<?php

function createSingleCard($data) {
?>
<div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src=<?php echo $data['kuva_url'] ?> class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?php echo $data["elokuva"] ?></h5>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">Vuosi: <?php echo $data["vuosi"] ?></li>
          <li class="list-group-item">Kesto: <?php echo $data["kesto"] ?> min</li>
          <li class="list-group-item">Kieli: <?php echo $data["kieli"] ?></li>
          <li class="list-group-item">Ikäraja: <?php echo $data["ikaraja"] ?></li>
          <li class="list-group-item">Ohjaaja: <?php echo $data["ohjaaja"] ?></li>
        </ul>
        <a href="single.php?id= <?php echo $data["id"] ?>" class="stretched-link"></a>
      </div>
    </div> 
  </div>
<?php
}
?>
  
