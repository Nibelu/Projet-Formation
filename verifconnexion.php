<?php
//Page permettant la connexion au site
session_start();
$login= $_POST['login'];
$mdp = $_POST['mdp'];

require_once("fonctions.php");

$queries = new queries;

if(empty($login) || empty($mdp))
	{
		//Redirection vers la page d'accueil avec un message d'erreur
				echo "<script> 
				alert('Combinaison login/motdepasse inexistant');
				document.location.href = 'connexion.php';
				
				 </script>";
	}
//Si le login et le mot de passe sont renseignés
if( isset($login) && isset($mdp) ){
	//Si ils ne sont pas vide
	if(!empty($login) && !empty($mdp)){


		//le niveau determine si l'utilisateur est administrateur ou simple client
		if($queries->verifEmpty($login, $mdp) !=0){
		
		//On stocke le résultat dans une variable de Session
		$client =$queries->recupClient($login, $mdp);
		$_SESSION['client']=$client;
		$clientId = $_SESSION['client']['email'];

		
		$queries->MAJStatutFormation($clientId);

		//Message de bienvenue et redirection vers la page d'accueil

		if($_SESSION['client']['niveau']==1){

		echo "<script>		
		
		alert('Bienvenue dans la M2L');
		document.location.href = 'profil.php';
		 </script>";
		}
		else if($_SESSION['client']['niveau']==2){

		echo "<script>		
		
		alert('Bienvenue dans la M2L');
		document.location.href = 'equipe.php';
		 </script>";
		}

		}
		
		//Si la combinaison login/mdp est fausse
		else{
			//Redirection vers la page d'accueil avec un message d'erreur
			echo "<script> 
			
			alert('Combinaison login/motdepasse inexistant');
			document.location.href = 'connexion.php';
			 </script>";
		}
	}
}
?>