<?php
if (! isset ( $_REQUEST ['action'] )) {
	$_REQUEST ['action'] = 'demandeConnexion';
}
$action = $_REQUEST ['action'];
switch ($action) {
	case 'demandeConnexion' :
		{
			include ("vues/v_connexion.php");

			break;
		}
	case 'valideConnexion' :
		{
			$login = $_REQUEST ['login'];
			$mdp = $_REQUEST ['mdp'];
			$mdph=hash('md5',$mdp);
			$visiteur = $pdo->getInfosVisiteur ( $login, $mdph );
			$comptable = $pdo->getInfosComptable ( $login, $mdp );
			if (! is_array ( $visiteur ) && ! is_array ( $comptable )) {
				ajouterErreur ( "Login ou mot de passe incorrect" );
				include ("vues/v_erreurs.php");
				include ("vues/v_connexion.php");
			} elseif (is_array ( $visiteur )) {
				$id = $visiteur ['id'];
				$nom = $visiteur ['nom'];
				$prenom = $visiteur ['prenom'];
				connecter ( $id, $nom, $prenom );
				include ("vues/v_sommaire.php");
			} elseif (is_array ( $comptable )) {
				$id ='comptable';
				$nom = $comptable ['login'];
				$prenom = $comptable [2];
				connecter ( $id, $nom, $prenom );	

				include ("vues/v_sommaireComptable.php");
			}
			break;
		}
		case 'mdp' :
			{
				$login = $_REQUEST ['login'];
				$mdp = $_REQUEST ['mdp'];
				$visiteur = $pdo->getInfosVisiteur ( $login, $mdp );
				$id = $visiteur ['id'];
				$nom = $visiteur ['nom'];
				echo $id;
				//echo hash('md5', );
				break;
			}
		
	default :
		{
			include ("vues/v_connexion.php");
			break;
		}
}
?>
