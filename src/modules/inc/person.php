<?php

function getPeople(){
    require_once MODULES_DIR.'/inc/db.php';

    try{
        $pdo = getPdoConnection();
        // Create SQL query to get all rows from a table
        $sql = "SELECT * FROM yllapitaja";
        // Execute the query
        $people = $pdo->query($sql);

        return $people->fetchAll();
    }catch(PDOException $e){
        throw $e;
    }
}

function addPerson($fname, $lname, $uname, $pw){
    require_once MODULES_DIR.'/inc/functions.php';
    
    //Tarkistetaan onko muttujia asetettu
    if( !isset($fname) || !isset($lname) || !isset($uname) || !isset($pw) ){
        throw new Exception("Puuttuvia parametrejä. Ei voida lisätä käyttäjää.");
    }
    
    //Tarkistetaan, ettei tyhjiä arvoja muuttujissa
    if( empty($fname) || empty($lname) || empty($uname) || empty($pw) ){
        throw new Exception("Tyhjiä arvoja ei voi asettaa!");
    }
    
    try{
        $pdo = openDB();
        //Suoritetaan parametrien lisääminen tietokantaan.
        $sql = "INSERT INTO yllapitaja (firstname, lastname, username, password) VALUES (?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $fname);
        $statement->bindParam(2, $lname);
        $statement->bindParam(3, $uname);
    
        $hash_pw = password_hash($pw, PASSWORD_DEFAULT);
        $statement->bindParam(4, $hash_pw);
        
    
        $statement->execute();
    
        header('Location: login.php');
    }catch(PDOException $e){
        throw $e;
    }
}

function deletePerson($id){
    require_once MODULES_DIR.'/inc/db.php'; // DB connection
    
    //Tarkistetaan onko muttujia asetettu
    if( !isset($id) ){
        throw new Exception("Puuttuvia parametrejä! Käyttäjää ei voi poistaa!");
    }
    
    try{
        $pdo = getPdoConnection();
        // Start transaction
        $pdo->beginTransaction();
        // Delete from worktime table
        $sql = "DELETE FROM worktime WHERE person_id = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $id);        
        $statement->execute();
        // Delete from person table
        $sql = "DELETE FROM yllapitaja WHERE ID = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $id);        
        $statement->execute();
        // Commit transaction
        $pdo->commit();
    }catch(PDOException $e){
        // Rollback transaction on error
        $pdo->rollBack();
        throw $e;
    }
}