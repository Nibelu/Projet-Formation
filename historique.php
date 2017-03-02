<?php
session_start();


if (isset($_SESSION['client']['niveau']))//On vérifie que le variable existe.
{
        $connect=$_SESSION['client']['niveau'];//On récupère la valeur de la variable de session.
}
else
{
        $connect=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}
       
if ($connect = 0) // Si le visiteur s'est identifié.
{
//Redirection vers la page d'accueil avec un message d'erreur
			echo "<script> 
			
			alert('Vous n\'avez pas les droit pour acceder a cette page.');
			document.location.href = 'connexion.php';
			 </script>";
			  } else {

	
// On affiche la page cachée.
?>


<!DOCTYPE HTML>

<html>
	<head>
		<title>Historique</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap-theme.css" type="text/css" rel="stylesheet">
		<link href="assets/bootstrap/js/bootstrap.js" type="text/javascript" rel="stylesheet">
		<link href="assets/bootstrap/js/npm.js" type="text/javascript" rel="stylesheet">
		<link href="assets/css/style.css" type="text/css" rel="stylesheet">

	</head>
	
	
	<body background="images/wallpaper.jpg" >

	<?php 
		
		require_once("header.php");
		require_once("fonctions.php");
		$queries = new queries;
		$now = date('Y-m-d H:i:s');	
		foreach ($queries->historique() as $row )		
		{
			if($now > $row['date'])
				{
				$newDate = date("d-m-Y", strtotime($row['date']));
	?>

				<div class='corps container'>
					<div>Nom de la formation : <?php echo $row['libelle'];?> </div>					
					<div>Date : <?php echo $newDate;?></div>
					<div>Durée : <?php echo $row['duree'];?></div>
					<div>Prérequis : <?php echo $row['prerequis'];?></div>
					<div>Préstataire : <?php echo $row['prestataire'];?></div>
					<div>Lieu : <?php echo $row['lieu'];?></div>
					<div>Cout : <?php echo $row['cout'];?></div>
					<div>URL : <?php echo $row['url'];?></div>
					<div>Contenu : <?php echo $row['description'];?></div>
				</div>
	
	<?php		}

		}	
		require_once("footer.php");
	?>

	<script src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>
<?php } ?>
