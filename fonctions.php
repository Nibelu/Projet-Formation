<?php

	
require("connect.php");

class queries
	{
		private $dbh;

		public function __construct()
			{
				$this->dbh =connect();
			}

		function historique ()
			{				
				$sql= $this->dbh->prepare ("SELECT * FROM formation ORDER BY date DESC");		
				$sql->execute();
				return $sql;
			}

		function verifEmpty ($login,$mdp)
			{
				$sqlverif= $this->dbh->prepare ("SELECT email, mdp FROM salarie WHERE email=".$this->dbh->quote($login)." AND mdp=".$this->dbh->quote($mdp).";");		
				$sqlverif->execute();
				$count=$sqlverif->rowCount();
				return $count;
			}

		function recupClient ($login,$mdp)
			{
			// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
				$sqlClient= $this->dbh->prepare ("SELECT * FROM salarie WHERE email=".$this->dbh->quote($login)." AND mdp =".$this->dbh->quote($mdp).";");		
				$sqlClient->execute() or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				$client= $sqlClient->fetch();
				return $client;
			}
//A modifier !!!
		function MAJStatutFormation ($user)
			{ 		
				$date = date('Y-m-d H:i:s');		
				$appel= $this->dbh->prepare('CALL formationEffectuee(?,?)');
				$appel->execute(array($user,$date));				

				/*
				$appel= $this->dbh->prepare ("UPDATE effectuer SET statut = 'effectuée' WHERE id_salarie = ? AND statut = 'validée' AND id_formation IN (SELECT id FROM formation WHERE date < ?);");
				$appel->execute(array($user,$date));*/
			}

		function recupEquipe ($user)
			{
				$sql= $this->dbh->prepare("SELECT * FROM salarie  WHERE equipe = ?;");
				$sql->execute(array($user));				
				return $sql;
			}

		function recupEquipeFormation ($idMembreEquipe)
			{
				$formEquipe= $this->dbh->prepare("SELECT * FROM formation INNER JOIN effectuer ON formation.id = effectuer.id_formation WHERE id_salarie =? ORDER BY date ASC;");
				$formEquipe->execute(array($idMembreEquipe));				
				return $formEquipe;

			}

		function setValidee ($idFormation)
		{
			$validation= $this->dbh->prepare("UPDATE effectuer SET statut='validée'  WHERE  id=?;");
			$validation->execute(array($idFormation));				
		}

		function MAJCreditsSalarie($idEffectuer)
			{
				$appel= $this->dbh->prepare('CALL decrementSalarie(?);');
				$appel->execute(array($idEffectuer));
				

				/*$creditS = 0;
				$nbJrsS = 0;
				$coutF = 0;
				$dureeF = 0;
    
				$appel1= $this->dbh->prepare ("SELECT nbJrsRestants, credit FROM salarie WHERE email = (SELECT id_salarie FROM effectuer WHERE id = ?);");
				$appel1->execute(array($idEffectuer));
				$resAppel1= $appel1->fetch();

				$nbJrsS=$resAppel1['nbJrsRestants'];
				$creditS=$resAppel1['credit'];
    
				$appel2= $this->dbh->prepare ("SELECT cout, duree FROM formation WHERE id = (SELECT id_formation FROM effectuer WHERE id = ?);");
				$appel2->execute(array($idEffectuer));
				$resAppel2= $appel2->fetch();

				$coutF=$resAppel2['cout'];	
				$dureeF=$resAppel2['duree'];

    
				if ($creditS > $coutF && $nbJrsS >= $dureeF)
					{
						$jrsTotal = $nbJrsS - $dureeF;
						$creditsTotal = $creditS - $coutF;
						$appel3= $this->dbh->prepare ("UPDATE salarie SET nbJrsRestants = $jrsTotal, credit = $creditsTotal
						WHERE email = (SELECT id_salarie FROM effectuer WHERE id = ?);");
						$appel3->execute(array($idEffectuer));	
					}
				else 
					{ echo "<script>		
				
				alert('Demande mise a jour : pb');
				document.location.href = 'equipe.php';
				 </script>";
					}*/

			}

			function setRefusee ($idFormation)
				{
					$delete= $this->dbh->prepare("DELETE FROM effectuer WHERE id=? ");
					$delete->execute(array($idFormation));
				}

			function recherche($recherche)
				{
					$rech=$this->dbh->prepare("SELECT * FROM formation WHERE libelle LIKE '%".$recherche."%' OR description LIKE '%".$recherche."%'  ;");
					$rech->execute();
					return $rech;
				}

			function inscrire($laFormation)
				{
					$sql= $this->dbh->prepare("SELECT cout,duree FROM formation WHERE id= '?';");
					$sql->execute(array($laFormation));
					$sinscrire=$sql->fetch();
					return $sinscrire;
				}

			function ajoutEffectuer($laFormation,$leClient)
				{
					$insert=$this->dbh->prepare("INSERT INTO effectuer ( id_formation, id_salarie, statut) VALUES ( ".$laFormation.", '".$leClient."', 'en cours de validation');");
					if($insert->execute())
						{
	
						echo "<script>		
							
							alert('Demande transmise');
							document.location.href = 'recherche.php';
							 </script>";
						}
					else 
						{
							echo "<script>		
							
							alert('Echec');
							document.location.href = 'recherche.php';
							 </script>";
						}

				}

				function recherchePPE($cred)
				{
					$reich=$this->dbh->prepare("SELECT * FROM formation WHERE cout <=".$cred."  ;");
					$reich->execute();
					return $reich;
				}

				function recupLaFormation ($idMembreEquipe,$id)
			{
				$formEquipe= $this->dbh->prepare("SELECT * FROM formation INNER JOIN effectuer ON formation.id = effectuer.id_formation WHERE effectuer.id_salarie = ? AND effectuer.id_formation = ?;");
				$formEquipe->execute(array($idMembreEquipe,$id));
				$laFormation=$formEquipe->fetch();
				return $laFormation;

			}

				




	}



?>