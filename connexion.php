<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap-theme.css" type="text/css" rel="stylesheet">
		<link href="assets/bootstrap/js/bootstrap.js" type="text/javascript" rel="stylesheet">
		<link href="assets/bootstrap/js/npm.js" type="text/javascript" rel="stylesheet">
		<link href="assets/css/style.css" type="text/css" rel="stylesheet">
	</head>	
	<body >
		<div class="corps container" style="margin-top: 200px;"  >
			<h1>Connexion à votre profil</h1>
		</div>
		<div class="corpConnexion container" style="padding-top: 40px;" >
			<form class="form-inline" name="connexion" action="verifconnexion.php" method="post" >
				<div class="form-group">
					<input type="text" name="login" placeholder="Identifiant"><br>
				</div>
				<div class="form-group">
					<input type="password" name="mdp" placeholder="Password"><br>
				</div>
			</form>
		</div>
		<div class="corpConnexion container" style="padding-top: 40px;" >
			<div class="form-group">
				<button class="btn btn-default" onclick="document.connexion.submit()" type="submit" >Connexion</button>
			</div>
		</div>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	</body>
</html>