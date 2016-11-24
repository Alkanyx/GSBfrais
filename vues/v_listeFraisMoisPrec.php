
<div id="contenu">
	<select name="select" id="selectVisiteur"
		onChange="javascript:location.href = this.value;">
		
		<?php
		if (! isset ( $_REQUEST ['visiteur'] )) {
			echo '<option value=0> { Sélectionner un visiteur } </option>';
		} else {
			echo '<option value=0>' . $leVisiteur ['nom'] . ' ' . $leVisiteur ['prenom'] . '</option>';
		}
		foreach ( $lesVisiteurs as $unVisiteur ) {
			if (! isset ( $_REQUEST ['visiteur'] ) || $unVisiteur ['id'] != $leVisiteur ['id']) {
				echo '
			<option value=index.php?uc=comptable&action=listeFraisComptable&visiteur=' . $unVisiteur ['id'] . '>' . $unVisiteur ['nom'] . ' ' . $unVisiteur ['prenom'] . '</option>';
			}
		}
		
		if (isset ( $_REQUEST ['visiteur'] )) {
			?>
	</select>

	<?php
			if (! empty ( $lesFraisForfait )) {
				?>
	<table class="listeLegere">
		<caption>Descriptif des éléments forfaitisés du mois de <?php echo $libelleMois ?></caption>
		<tr>
			<th>Frais Forfaitaires</th>
			<th>Qté</th>
			<th>Montant unitaire</th>
			<th>Total</th>
		</tr>
          
    <?php
				foreach ( $lesFraisForfait as $unFraisForfait ) {
					$libelle = $unFraisForfait ['libelle'];
					$qte = $unFraisForfait ['montant'];
					$montant = $unFraisForfait ['quantite'];
					$total = $qte * $montant;
					?>		
            <tr>
			<td> <?php echo $libelle ?></td>
			<td><?php echo $qte ?></td>
			<td><?php echo $montant ?></td>
			<td><?php echo $total ?></td>

		</tr>
	<?php
				}
			}
			if (! empty ( $lesFraisForfait )) {
				?>
	<table class="listeLegere">
			<caption>Descriptif des éléments Forfait du mois de <?php echo $libelleMois ?></caption>
			<tr>
				<th class="date">Date</th>
				<th class="libelle">Libellé</th>
				<th class="montant">Montant</th>
				<th class="action">Etat</th>
				<th class="action">Valider</th>
				<th class="action">Refuser</th>
				<th class="action">Reporter</th>
			</tr>
          
    <?php
				foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) {
					$libelle = $unFraisHorsForfait ['libelle'];
					$date = $unFraisHorsForfait ['date'];
					$montant = $unFraisHorsForfait ['montant'];
					$id = $unFraisHorsForfait ['id'];
					$etat = $unFraisHorsForfait ['libelEtat'];
					?>		
            <tr>
            
				<td> <?php echo $date ?></td>
				<td><?php echo $libelle ?></td>
				<td><?php echo $montant ?></td>
				<td><?php echo $etat ?></td>
				<td><a
					href="index.php?uc=comptable&action=validerFrais&idFrais=<?php echo $id ?>"
					onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Valider</a></td>
				<td><a
					href="index.php?uc=comptable&action=refuserFrais&idFrais=<?php echo $id ?>&mois=<?php echo $moisA ?>&visiteur=<?php echo $_REQUEST['visiteur'] ?>"
					onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Refuser</a></td>
				<td><a
					href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>"
					onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Reporter</a></td>
			</tr>
	<?php
				}
			}
		}
		?>	  
                                          
    </table>

		</div>