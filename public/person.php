<?php
include MODULES_DIR.'/inc/person.php';

    //Filtteroidaan POST-inputit (ei käytetä string-filtteriä, koska deprekoitunut)
    //Jos parametria ei löydy, funktio palauttaa null
    $fname = filter_input(INPUT_POST, "fname");
    $lname = filter_input(INPUT_POST, "lname");
    $uname = filter_input(INPUT_POST, "username");
    $pw = filter_input(INPUT_POST, "password");

    if(isset($fname)){
        try{
            addPerson($fname, $lname, $uname, $pw);
        }catch(Exception $e){
            echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
        }
        
    }

?> 
    <h3>Luo uusi käyttäjä</h3>
    <form action="person.php" method="post">
        <label for="fname" class="m-1">Etunimi:</label><br>
        <input type="text" name="fname" id="fname" class="m-1"><br>
        <label for="lname" class="m-1">Sukunimi:</label><br>
        <input type="text" name="lname" id="lname" class="m-1"><br>
        <label for="username" class="m-1">Käyttäjänimi:</label><br>
        <input type="text" name="username" id="username" class="m-1"><br>
        <label for="password" class="m-1">Salasana:</label><br>
        <input type="password" name="password" id="password" class="m-1"><br>
        <input type="submit" class="btn btn-primary m-1" value="Luo käyttäjä">
    </form>

<?php   include TEMPLATES_DIR.'foot.php'; ?>