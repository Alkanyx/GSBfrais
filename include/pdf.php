<?php 
require("fpdf.php");
class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('images/logo-infiniblog.jpg',8,2,80);
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
}
?>