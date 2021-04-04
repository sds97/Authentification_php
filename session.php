<?php 

   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:connecte.php");
      exit();
   }
   if(date("H")<18)
   {
   		$bienvenue="Bonjour et bienvenue ".
    	$_SESSION["prenomNom"].
         " dans votre espace personnel";
   }
      
   else
   {
   		$bienvenue="Bonsoir et bienvenue ".
    	$_SESSION["prenomNom"].
         " dans votre espace personnel";
   }
      

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Session</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<h2><?=$bienvenue?></h2>
 	 <a href="deconnexion.php">Se déconnecter</a>
 </body>
 </html>