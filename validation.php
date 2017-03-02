<?php 
session_start();



require_once("fonctions.php");
$queries = new queries;

if(isset($_POST['action'])) 
{
	$idFormation=$_POST['idFormation'];


	if($_POST['action']=='accepter')
		{

			//$validation= $dbh->prepare("UPDATE effectuer SET statut='validée'  WHERE  id=?;");
			//$validation->execute(array($idFormation));
			$queries->setValidee($idFormation);
			

			//$appel= $dbh->prepare('CALL decrementSalarie(?);');
			//$appel->execute(array($idFormation));
			$queries->MAJCreditsSalarie($idFormation);

			$client =$queries->recupClient($_SESSION['client']['email'], $_SESSION['client']['mdp']);
			$_SESSION['client']=$client;

			echo "<script>		
				
				alert('Demande mise a jour : ok');
				document.location.href = 'equipe.php';
				 </script>";


		}
	else 
		{
			$queries->setRefusee($idFormation);
			echo "<script>		
					alert('Demande mise a jour : refus');
					document.location.href = 'equipe.php';
				 </script>";

		}

}
else 
{
	echo "<script>		
				alert('Demande mise a jour : Echec');
				document.location.href = 'equipe.php';
			 </script>";
}


?>