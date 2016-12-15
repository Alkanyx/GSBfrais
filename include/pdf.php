<?php 
require("fpdf.php");
class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('images/logo.jpg',100,2,80);
        // Saut de ligne
        $this->Ln(20);
    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(196,5,'Mes coordonnées - Mon téléphone',0,0,'C');
    }
    
    function entete_table($position_entete){
    	global $pdf;
    	$pdf->SetDrawColor(183); // Couleur du fond
    	$pdf->SetFillColor(221); // Couleur des filets
    	$pdf->SetTextColor(0); // Couleur du texte
    	$pdf->SetY($position_entete);
    	$pdf->SetX(8);
    	$pdf->Cell(158,8,'Désignation',1,0,'L',1);
    	$pdf->SetX(166); // 8 + 96
    	$pdf->Cell(10,8,'Qté',1,0,'C',1);
    	$pdf->SetX(176); // 104 + 10
    	$pdf->Cell(24,8,'Prix Unitaire',1,0,'C',1);
    	$pdf->SetX(200); // 104 + 10
    	$pdf->Cell(24,8,'Total',1,0,'C',1);
    	$pdf->Ln(); // Retour à la ligne
    }
}
?>