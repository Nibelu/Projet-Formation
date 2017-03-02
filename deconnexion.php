<?php
//Deconnexion
//Fermeture de la session et retour à la page d'accueil
session_start();
session_destroy();
header('Location: connexion.php?');
exit;
?>