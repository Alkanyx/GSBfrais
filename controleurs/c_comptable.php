
<?php
include ("vues/v_sommaireComptable.php");
$mois = getMois ( date ( "d/m/Y" ) );
$numAnnee = substr ( $mois, 0, 4 );
$numMois = substr ( $mois, 4, 2 );
$action = $_REQUEST ['action'];
$mois = '11';
$libelleMois = getLibelleMoisActuel ( $mois );
$moisA = date ( "Y" ) . $mois;
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
					$pdo->miseEnPaiement ( $_REQUEST [$n], $moisA );
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
			var_dump($mois);
			if (lesQteFraisValides ( $lesFrais )) {
				$pdo->majFraisForfait ( $idVisiteur, $moisA, $lesFrais );
			} else {
				ajouterErreur ( "Les valeurs des frais doivent être numériques" );
				include ("vues/v_erreurs.php");
			}
			header('location:index.php?uc=comptable&action=listeFraisComptable&visiteur='.$idVisiteur);
			break;
		}
}
?>
