<?php 
session_start();
$erreur = "";

if (isset($_POST['enregistrer'])) {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$repassword = $_POST['passwordConf'];
	
	if ($password!=$repassword) {
		$erreur = "Mot de passe non identique";
	}
	else {
		require 'connexion.php';
		$connexion = connect();

		//Vérification du login
		$sql1 = "SELECT * FROM utilisateurs WHERE login = ? LIMIT 1";
		$requete1 = $connexion->prepare($sql1);
		$requete1 -> execute(array($login));
		$result = $requete1->fetchAll();
		if (count($result) > 0) {
			$erreur = "Login existe déjà";
		}
		else{
			$sql2 = "INSERT INTO utilisateurs (nom, prenom, login, pass)
				VALUES('$nom', '$prenom', '$login', '$password')";
		
			$requete2 = $connexion->prepare($sql2);

			$requete2->execute();

			header("location:connecte.php");
		}

		
	}
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inscription</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
	<div class="container-md">
	<h1 class="h1 text-center">Inscription</h1>
		<form class="form-control bg-light" action="#" method="post">

			<input class="form-control mt-3" type="text" id="nom" name="nom" required="required" placeholder="Nom" >

			<input class="form-control mt-3" type="text" id="prenom" name="prenom" required="required" placeholder="Prénom" >

			<input class="form-control mt-3" type="email" id="login" name="login" required="required" placeholder="Login" >

			<input class="form-control mt-3" type="password" id="password" name="password" required="required" placeholder="Mot de passe" >

			<input class="form-control mt-3" type="password" id="passwordConf" name="passwordConf" required="required" placeholder="Confirmer votre mot de passe" >
				<?php

					echo '<div class="text-center text-danger">' . $erreur . '</div>';
				?>

			<div class="text-center">
				<input class="mt-3 btn btn-success" type="submit" name="enregistrer" value="Enregistrer">
			</div>
			
		</form>
	</div>
</body>
</html>