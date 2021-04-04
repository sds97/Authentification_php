<?php

session_start();

$erreur = "";

if (isset($_POST['connecte'])) {
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	require 'connexion.php';
	$connexion = connect();

	//Vérification du login
	$sql = "SELECT * FROM utilisateurs WHERE login = ? AND pass = ? LIMIT 1";
	$requete = $connexion->prepare($sql);
	$requete -> execute(array($login,$password));
	$result = $requete->fetchAll();
	if (count($result) <= 0) {
		$erreur = "Login ou mot de passe invalide";
	}
	else{
		$_SESSION["prenomNom"]=ucfirst(strtolower($result[0]["prenom"])).
         " ".strtoupper($result[0]["nom"]);
         $_SESSION["autoriser"]="oui";
         header("location:session.php");	
	}
		
}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Connexion</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
	<div class="container-md">
	<h1 class="h1 text-center mt-3">Connexion</h1>
		<form class="form-control bg-light" action="#" method="post">
			
			<input class="form-control mt-3" type="email" id="login" name="login" required="required" placeholder="Login" >

			<input class="form-control mt-3" type="password" id="password" name="password" required="required" placeholder="Mot de passe" >
				<?php

					echo '<div class="text-center text-danger">' . $erreur . '</div>';
				?>

			<div class="text-center">
				<input class="mt-3 btn btn-success" type="submit" name="connecte" value="Se connecter">
			</div>
			
		</form>
	</div>
</body>
</html>