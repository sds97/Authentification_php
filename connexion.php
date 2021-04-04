<?php 

function connect()
{
	$serveur = "localhost";
	$user = "root";
	$password = "";
	try {
		$connexion = new PDO("mysql:host=$serveur;dbname=authentification", $user, $password);
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		die('Echec PDO:' .$e->getMessage());
	}

	return $connexion;
	
}


 ?>