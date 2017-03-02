
<?php 
session_start();
require_once("fonctions.php");
$queries = new queries;
$laFormation=$_POST['laFormation'];
$queries->ajoutEffectuer($laFormation,$_SESSION['client']['email'] );
?>