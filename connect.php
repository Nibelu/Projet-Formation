

<?php 
function connect()
{
$dsn = 'mysql:dbname=projet_formation;host=localhost';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
	}
return $dbh;
}


		?>