<?php
//require 'config.php';

//Tässä haetaan tiedot init-tiedostosta. 
//Voit käyttää myös ylempänä olevaa config.php tiedostoa
//jos haluat. Kommentoi silloin seuraavat rivit.

function getPdoConnection(){
	$init = parse_ini_file(BASE_DIR."myconf.ini");
	$host = $init["host"];
	$db = $init["db"];
	$user = $init["username"];
	$password = $init["pw"];
	
	$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

	try {
		$pdo = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	return $pdo;
}