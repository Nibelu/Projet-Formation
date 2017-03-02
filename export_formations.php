<?php
session_start();


require('fpdf/fpdf.php');
require_once("fonctions.php");
$queries = new queries;

class PDF extends FPDF {

	function Header() {
	    $this->SetFont('Arial', 'B', 15);
	    $this->Cell(55);
	    $this->Cell(80, 10, 'Convention de formation', 1, 0, 'C');
	    $this->Ln(25);
	}

	function Footer() {
	    $this->SetY(-15);
	    $this->SetFont('Arial', 'I', 8);
	    $this->Cell(70);
	    $this->Cell(60, 10, 'Copyright © 2016 - www.projet-formations.com', 0, 0, 'C');
	    $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'R');
	}

	function afficherProfil() {
		$this->SetFont('Times','BU', 13);
		$this->Cell(0, 15, 'Profil :', 0, 1);
		$this->SetFont('Times', '', 12);
		$this->Cell(0, 10, utf8_decode('Nom : '.$_SESSION['client']['nom']), 0, 1);
		$this->Cell(0, 10, utf8_decode('Prénom : '.$_SESSION['client']['prenom']), 0, 1);
		$this->Cell(0, 10, utf8_decode('Email : '.$_SESSION['client']['email']), 0, 1);
		$this->Ln(25);
	}

	function ajouterFormation($formation) {
		$this->SetFont('Times','B', 12);
		$this->Cell(0, 15, utf8_decode($formation['libelle']), 0, 1, 'C');
		$this->SetFont('Times','', 12);
		$this->Cell(90, 10, utf8_decode('Le '.$formation['date'].' à '.$formation['lieu']), 0, 0, 'C');
		if ($formation['statut'] == 'validée') {
			$this->SetTextColor(0, 128, 0);
		} else if ($formation['statut'] == 'effectuée') {
			$this->SetTextColor(0, 0, 128);
		} else {
			$this->SetTextColor(100);
		}
		$this->Cell(20, 15, '');
		$this->Cell(45, 10, utf8_decode($formation['statut']), 1, 0, 'C');
		$this->Ln(15);
		$this->SetTextColor(0);
		$this->Cell(70, 10, utf8_decode('Animé par '.$formation['prestataire']), 0, 0, 'C');
		$this->Cell(55, 10, utf8_decode('Cout : '.$formation['cout'].' crédits'), 0, 0, 'C');
		$this->Cell(55, 10, utf8_decode('Durée : '.$formation['duree'].' jour(s)'), 0, 1, 'C');
		if ($formation['prerequis'] != 'Aucun') {
			$this->MultiCell(0, 15, utf8_decode('Prérequis : '.$formation['prerequis']), 0, 1);
		}
		$this->MultiCell(0, 5, $formation['description']);
		$this->Ln(20);
	}
}
$id=$_POST['laFormation'];
$formation=$queries->recupLaFormation($_SESSION['client']['email'],$id);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->afficherProfil();
$pdf->ajouterFormation($formation);
$pdf->Output('I', 'Liste des formations', true);
?>