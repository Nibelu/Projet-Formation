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
       
if ($connect == 0) // Si le visiteur s'est identifié.
	{
		//Redirection vers la page d'accueil avec un message d'erreur
		echo "<script> 
		
		alert('Vous n\'avez pas les droit pour acceder a cette page.');
		document.location.href = 'connexion.php';
		 </script>";
	} 
else
{	
// On affiche la page cachée.
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Profil</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap-theme.css" type="text/css" rel="stylesheet">
		<link href="assets/bootstrap/js/bootstrap.js" type="text/javascript" rel="stylesheet">
		<link href="assets/bootstrap/js/npm.js" type="text/javascript" rel="stylesheet">
		<link href="assets/css/style.css" type="text/css" rel="stylesheet">
	</head>		
	<body background="images/wallpaper.jpg">


	<?php 

		require_once("header.php");
		require_once("fonctions.php");
		$queries = new queries;
	?>
		

		<div class="corpsPage container">			
			<div class='corpsProfil container'>
				<div>
					<span>Bonjour M.<?php echo"".$_SESSION['client']['nom']." ".$_SESSION['client']['prenom']."";?></span>
					<span>Equipe : <?php echo $_SESSION['client']['equipe'];?></span></div>
			 	<div>
			 		<span>Crédits restant : <?php echo $_SESSION['client']['credit'];?></span>
			 		<span>Nombre de jours de formation restants : <?php echo $_SESSION['client']['nbJrsRestants'];?></span>
			 	</div>
			</div>
			<div>Liste des formations ou vous êtes inscrit :</div>
			
			<?php
				foreach ($queries->recupEquipeFormation($_SESSION['client']['email']) as $row)
					{ 
					$newDate = date("d-m-Y", strtotime($row['date']));
					$now = date('Y-m-d H:i:s');
		 			$date = $row['date'];
					if($now < $date && $row['cout']){
			?>
					<div class='profil container'>
						
						<div >Nom de la formtaion : <?php echo $row['libelle'];?></div>
						<div>
							<span>Durée : <?php echo $row['duree'];?></span>
							<span>Cout : <?php echo $row['cout'];?></span>
						</div>
						<div>Prérequis : <?php echo $row['prerequis'];?></div>
						<div>
							<span>Préstataire : <?php echo $row['prestataire'];?></span>	
							<span>URL : <?php echo $row['url'];?></span>
						</div>
						<div ><div class='col-md-6 col-lg-6'>Lieu : <?php echo $row['lieu'];?></div><div class='col-md-6 col-lg-6'>	Date : <?php echo $newDate;?></div></div>
						
						
						<div>Etat : <?php echo $row['statut'];?></div>
						<div>Contenu : <?php echo$row['description'];?></div>
						<div >	
							<form class=' formSubmit form-inline' action='export_formations.php' method='post' target='_blank'>
								<input  type='submit'  value='Telercharger le pdf'/>
								<input type='hidden' name='laFormation' value="<?php echo $row['id_formation'];?>"/>
							</form>
						</div>
					</div>					
			<?php
					}}
			?>
			
		</div>

		<?php require_once("footer.php");?>

		<script src="js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>
<?php } ?>