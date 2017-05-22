
<?php
include ("vues/v_sommaireComptable.php");
$mois = getMoisActuel();
$libelleMois = getLibelleMoisActuel ( $mois );
$moisA = date ( "Y" ) . $mois;
if(!isset($action)){
	$_REQUEST ['action']='listeFraisComptable';
}

$action = $_REQUEST ['action'];
switch ($action) {
	case 'refuserFrais' :
		{
			$idFrais = $_REQUEST ['idFrais'];
			$moisFrais = $_REQUEST ['mois'];
			$visiteur = $_REQUEST ['visiteur'];
			$test = $pdo->refuserFrais ( $visiteur, $moisFrais, $idFrais );
			if (! $test) {
				$erreur = 'Erreur lors de refus';
			}
			header ( 'location:index.php?uc=comptable&action=listeFraisComptable&visiteur=' . $visiteur );
			break;
		}
	
	case 'reporterFrais' :
		{
			$idFrais = $_REQUEST ['idFrais'];
			$idVisiteur = $_REQUEST ['visiteur'];
			$test = $pdo->reporterFrais ( $idFrais, $idVisiteur );
			if (! $test) {
				$erreur = 'Erreur lors du report';
			}
			header ( 'location:index.php?uc=comptable&action=listeFraisComptable&visiteur=' . $idVisiteur );
			break;
		}
	
	case 'validerFicheFrais' :
		{
			$idVisiteur = $_REQUEST ['visiteur'];
			$moisFrais = $_REQUEST ['mois'];
			$test = $pdo->validerFrais ( $idVisiteur, $moisFrais );
			if (! $test) {
				$erreur = 'Erreur lors de la reportation';
			}
			header ( 'location:index.php?uc=comptable&action=listeFraisComptable' );
			break;
		}
	
	case 'listeFraisComptable' :
		{
			if (isset ( $_REQUEST ['visiteur'] )) {
				$leVisiteur = $pdo->getInfosVisiteurComptable ( $_REQUEST ['visiteur'] );
				$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait ( $_REQUEST ['visiteur'], $moisA );
				$lesFraisForfait = $pdo->getLesFraisForfait ( $_REQUEST ['visiteur'], $moisA );
			}
			$lesVisiteurs = $pdo->getListeFraisVisiteur ( $mois );
			include ('vues/v_listeFraisMoisPrec.php');
			break;
		}
	case 'paiement' :
		{
			$lesFichesFrais = $pdo->getFicheFrais ( $moisA );
			include ('vues/v_paiement.php');
			break;
		}
	case 'misepaiement' :
		{
			for($n = 0; $n <= $_REQUEST ['i']; $n ++) {
				$check = 'check' . $n;
				
				if ($_REQUEST [$check]) {
					$idVis='idVisiteur'.$n;
					$mois='mois'.$n;
					$montantValide = 'montantValide'.$n;
					$nomVis='nomVis'.$n;
					$pdo->miseEnPaiement($_REQUEST[$n],$_REQUEST[$mois]);
					// Création du pdf personalisé pour chaque personne et mise à jour dans la BDD
					$pdf = new PDF ( 'P', 'mm', 'A4' );
					$pdf->AddPage ();
					$pdf->SetFont ( 'Helvetica', '', 11 );
					$pdf->SetTextColor ( 0 );
					$pdf->Text ( 8, 38, 'Numero Client : ' . $_REQUEST [$idVis] );
					$pdf->Text ( 8, 43, 'Montant valide : ' . $_REQUEST [$montantValide].' euros' );
					$pdf->Text ( 8, 48, 'Mois : ' . $_REQUEST [$mois] );
					$nomPdf = 'pdf/Remboursement_' . $_REQUEST [$nomVis] . '_'.$_REQUEST [$mois].'pdf';
					// Titres des colonnes
					$entete = array (
							'Libelle',
							'Qte',
							'P.U.',
							'Montant HT' 
					);
					$pdf->SetDrawColor ( 183 ); // Couleur du fond
					$pdf->SetFillColor ( 221 ); // Couleur des filets
					$pdf->SetTextColor ( 0 ); // Couleur du texte
					$pdf->SetY ( 58 );
					$pdf->SetX ( 8 );
					$pdf->Cell ( 86, 8, 'Designation', 1, 0, 'L', 1 );
					$pdf->SetX ( 94 ); // 8 + 96
					$pdf->Cell ( 10, 8, 'Qte', 1, 0, 'C', 1 );
					$pdf->SetX ( 104 ); // 104 + 10
					$pdf->Cell ( 48, 8, 'Prix Unitaire (euros)', 1, 0, 'C', 1 );
					$pdf->SetX ( 152 ); // 104 + 10
					$pdf->Cell ( 48, 8, 'Total (euros)', 1, 0, 'C', 1 );
					$pdf->Ln (); // Retour à la ligne
					$position_detail = 66;
					$idVisiteur = $_REQUEST [$n];
					$mois = $_REQUEST ['mois'];
					$lesFraisForfait = $pdo->getLesFraisForfait ( $idVisiteur, $mois );

					foreach ( $lesFraisForfait as $unFraisForfait ) {
				 		$montant=$unFraisForfait ['quantite']*$unFraisForfait ['montant'];
						$pdf->SetY ( $position_detail );
						$pdf->SetX ( 8 );
						$pdf->MultiCell ( 86, 8,utf8_decode($unFraisForfait['libelle']), 1, 'L' );
						$pdf->SetY ( $position_detail );
						$pdf->SetX ( 94 );
						$pdf->MultiCell ( 10, 8, $unFraisForfait ['quantite'], 1, 'C' );
						$pdf->SetY ( $position_detail );
						$pdf->SetX ( 104 );
						$pdf->MultiCell ( 48, 8,$unFraisForfait['montant'], 1, 'R' );
						$pdf->SetY ( $position_detail );
						$pdf->SetX ( 152 );
						$pdf->MultiCell ( 48, 8,  $montant,1, 'R' );
						$position_detail += 8;
					}
					
					$pdf->Output ( $nomPdf, 'F' );
				}
			}
			
			header ( 'location:index.php?uc=comptable&action=paiement' );
			break;
		}
	case 'remboursement' :
		{
			$lesFichesFrais = $pdo->getFicheFraisPaye ( $moisA );
			include ('vues/v_remboursement.php');
			break;
		}
	case 'rembourser' :
		{
			for($n = 0; $n <= $_REQUEST ['i']; $n ++) {
				$check = 'check' . $n;
				if ($_REQUEST [$check]) {
					$pdo->validerRemboursement ( $_REQUEST [$n], $moisA );
				}
			}
			header ( 'location:index.php?uc=comptable&action=paiement' );
			break;
		}
	case 'majfraisforfait' :
		{
			
			$lesFrais = $_REQUEST ['lesFrais'];
			$idVisiteur = $_REQUEST ['visiteur'];
			var_dump ( $mois );
			if (lesQteFraisValides ( $lesFrais )) {
				$pdo->majFraisForfait ( $idVisiteur, $moisA, $lesFrais );
			} else {
				ajouterErreur ( "Les valeurs des frais doivent être numériques" );
				include ("vues/v_erreurs.php");
			}
			header ( 'location:index.php?uc=comptable&action=listeFraisComptable&visiteur=' . $idVisiteur );
			break;
		}
	case 'cloturer' :
		{
			$dateCL=date('Y').'-'.$mois.'10';
			$pdo->cloturerFDF($dateCL);
			header ( 'location:index.php?uc=comptable&action=listeFraisComptable');
			break;
		}
}
?>
