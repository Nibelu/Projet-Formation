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
       
if ( $connect == 1) // Si le visiteur s'est identifié.
{
	echo "<script>		
		
		alert('Vous n\'avez pas les droit pour acceder a cette page.');
		document.location.href = 'profil.php';
		 </script>";
		
} else if ($connect == 0) {
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
		<title>Equipe</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/bootstrap/css/bootstrap-theme.css" type="text/css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
		<link href="assets/bootstrap/js/bootstrap.js" type="text/javascript" rel="stylesheet">
		<link href="assets/bootstrap/js/npm.js" type="text/javascript" rel="stylesheet">
		<link href="assets/css/style.css" type="text/css" rel="stylesheet">

	</head>
	
	
	<body  >
		<?php 
		require_once("header.php");
		require_once("fonctions.php");
		$queries = new queries;

		
				$i=0;
				

				foreach ($queries->recupEquipe($_SESSION['client']['equipe']) as $row)
					{ 						
		?>
								<div class='container'>	
									<div class='row'>
										<div class='corpsEquipe'>
											<div class='col-md-6 col-lg-6'>
																<div >Nom : <?php echo $row['nom'];?></div>
																<div>Prenom : <?php echo $row['prenom'];?></div>
																<div>Equipe : <?php echo $row['equipe'];?></div>
																<div>Email du membre : <?php echo $row['email'];?></div>
																<div>Crédits : <?php echo $row['credit'];?></div>
																<div>Jours de formation restants : <?php echo $row['nbJrsRestants'];?></div>
																
											</div>
											<div class='  col-md-6  col-lg-6'>
		<?php	
												foreach ($queries->recupEquipeFormation($row['email']) as $formationDemandee) 
													{ 
														if($formationDemandee['statut'] == 'en cours de validation'){
															$newDate = date("d-m-Y", strtotime($formationDemandee['date']));
		?>
															<div class="corpsEquipeFormation">
																		<div style="text-align: center;"><?php echo $formationDemandee['libelle'];?></div>
																		<div style="text-align: center;">
																			<span>Date : <?php echo $newDate;?></span>
																			<span>Lieu : <?php echo $formationDemandee['lieu'];?></span>
																			<span>Durée : <?php echo $formationDemandee['duree'];?></span>
																		</div>																		
																		
																		<div style="text-align: center;">
																			<div>Etat : <?php echo $formationDemandee['statut'];?></div>		
																			<div> 
																				<form class='form-inline' action='validation.php' method='post'>
																						<input type='hidden' name='idFormation' value="<?php echo $formationDemandee['id'];?>"/>
																						<button class="formButton"  type='submit' name='action'  value='accepter'>Accepter</button>
																						<button class="formButton" type='submit' name='action'  value='refuser'>Refuser</button>
																				  </form> 
																			</div>
																		</div>									

																  </div>
		<?php
														}
													}
		?>																									
										</div>					

										</div>
									</div>
								</div>
							
		<?php	$i++;							
					}					
		?>
			<div class='nbEquipe container'>Nombre de membre dans l'equipe : <?php echo $i ;?></div>

		<?php require_once("footer.php");?>

		<script src="js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>
<?php  } ?>