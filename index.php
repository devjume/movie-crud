<?php
include "./head.php";
echo '<h1>Index</h1>';
echo "<br>";
echo "<a href='./addmovie/addmovie.php'>Lisää elokuva</a>";
echo "<br>";
echo "<a href='movies.php'>Elokuvat</a>";
echo "<br>";
echo "<a href='./single.php?id=1'>Yksittäinen elokuva (Muuta id -> katso url '?id=2'</a>";
echo "<br>";

include "./foot.php";
