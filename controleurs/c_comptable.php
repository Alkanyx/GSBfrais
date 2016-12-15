
<?php
if ($_SESSION ['idVisiteur'] == 'comptable')
	include ("vues/v_sommaireComptable.php");
else
	include ("vues/v_sommaire.php");
$idVisiteur = $_SESSION ['idVisiteur'];
$mois = getMois ( date ( "d/m/Y" ) );
$numAnnee = substr ( $mois, 0, 4 );
$numMois = substr ( $mois, 4, 2 );
$action = $_REQUEST ['action'];
$mois = '11';
$libelleMois = getLibelleMoisActuel ( $mois );
$moisA = date ( "Y" ) . $mois;
switch ($action) {
	case 'saisirFrais' :
		{
			if ($pdo->estPremierFraisMois ( $idVisiteur, $mois )) {
				$pdo->creeNouvellesLignesFrais ( $idVisiteur, $mois );
			}
			break;
		}
	case 'validerMajFraisForfait' :
		{
			$lesFrais = $_REQUEST ['lesFrais'];
			if (lesQteFraisValides ( $lesFrais )) {
				$pdo->majFraisForfait ( $idVisiteur, $mois, $lesFrais );
			} else {
				ajouterErreur ( "Les valeurs des frais doivent être numériques" );
				include ("vues/v_erreurs.php");
			}
			break;
		}
	case 'validerCreationFrais' :
		{
			$dateFrais = $_REQUEST ['dateFrais'];
			$libelle = $_REQUEST ['libelle'];
			$montant = $_REQUEST ['montant'];
			$id = $pdo->getMaxIdHorsForfait () [0] + 1;
			valideInfosFrais ( $dateFrais, $libelle, $montant );
			if (nbErreurs () != 0) {
				include ("vues/v_erreurs.php");
			} else {
				$pdo->creeNouveauFraisHorsForfait ( $id, $idVisiteur, $mois, $libelle, $dateFrais, $montant );
			}
			break;
		}
	case 'refuserFrais' :
		{
			$idFrais = $_REQUEST ['idFrais'];
			$moisFrais = $_REQUEST ['mois'];
			$visiteur = $_REQUEST ['visiteur'];
			$test = $pdo->refuserFrais ( $visiteur, $moisFrais, $idFrais );
			if (! $test) {
				$erreur = 'Erreur lors de la refusation';
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
				$erreur = 'Erreur lors de la déportation';
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
				$check='check'.$n;
				if ($_REQUEST [$check]) {
					$pdo->miseEnPaiement ( $_REQUEST [$n], $moisA );
				}
			}
			echo $_REQUEST ['i'];
			break;
		}
	case 'remboursement' :
		{
			$lesFichesFrais = $pdo->getFicheFraisPaye ( $moisA );
			include ('vues/v_remboursement.php');
			break;
		}
}
?>
