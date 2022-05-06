<?php
function login($uname, $pw){

    require_once MODULES_DIR.'/inc/functions.php';

    // $uname = filter_input(INPUT_POST, "username");
    // $pw = filter_input(INPUT_POST, "password");

    //Tarkistetaan onko muttujia asetettu
    if( !isset($uname) || !isset($pw) ){
        throw new Exception("Puuttuvia parametrejä. Ei voida kirjautua sisään.");
    }

    //Tarkistetaan, ettei tyhjiä arvoja muuttujissa
    if( empty($uname) || empty($pw) ){
        throw new Exception("Et voi kirjautua tyhjillä arvoilla.");
    }

    try{
        $pdo = openDB();
        //Haetaan käyttäjä annetulla käyttäjänimellä
        $sql = "SELECT username, password, firstname, lastname FROM yllapitaja WHERE username=?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $uname);
        $statement->execute();

        if($statement->rowCount() <=0){
            throw new Exception("Käyttäjää ei löydy. Ei voida kirjautua sisään!");
        }

        $row = $statement->fetch();

        //Tarkistetaan käyttäjän antama salasana tietokannan salasanaa vasten
        if(!password_verify($pw, $row["password"] )){
            throw new Exception("Wrong password!!");
        }

        //Jos käyttäjä tunnistettu, talletetaan käyttäjän tiedot sessioon
        $_SESSION["username"] = $uname;
        $_SESSION["fname"] = $row["firstname"];
        $_SESSION["lname"] = $row["lastname"];

    }catch(PDOException $e){
        throw $e;
    }

}

function logout(){
    //Tyhjennetään ja tuhotaan nykyinen sessio.
    try{
        session_unset();
        session_destroy();
    }catch(Exception $e){
        throw $e;
    }
}

?>