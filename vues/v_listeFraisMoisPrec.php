
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
			if (! empty ( $lesFraisForfait ) || ! empty ( $lesFraisHorsForfait )) {
				
				?>
				<a
		href="index.php?uc=comptable&action=validerFicheFrais&mois=<?php echo $moisA?>&visiteur=<?php echo $_REQUEST["visiteur"]?>"
		onclick="return confirm('Voulez-vous vraiment valider cette fiche defrais?');">Valider
		cette fiche de frais ?</a>
				<?php
			}
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
			if (! empty ( $lesFraisHorsForfait )) {
				?>
	<table class="listeLegere">
			<caption>Descriptif des éléments Hors Forfait du mois de <?php echo $libelleMois ?></caption>
			<tr>
				<th class="date">Date</th>
				<th class="libelle">Libellé</th>
				<th class="montant">Montant</th>
				<th class="action">Refuser</th>
				<th class="action">Reporter</th>
			</tr>
          
    <?php
				foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) {
					if (substr ( $unFraisHorsForfait ['libelle'], 0, 9 ) != "REFUSE : ") {
						$libelle = $unFraisHorsForfait ['libelle'];
						$date = $unFraisHorsForfait ['date'];
						$montant = $unFraisHorsForfait ['montant'];
						$id = $unFraisHorsForfait ['id'];
						?>		
            <tr>

				<td> <?php echo $date ?></td>
				<td><?php echo $libelle ?></td>
				<td><?php echo $montant ?></td>
				<td><a
					href="index.php?uc=comptable&action=refuserFrais&idFrais=<?php echo $id ?>&mois=<?php echo $moisA ?>&visiteur=<?php echo $_REQUEST['visiteur'] ?>"
					onclick="return confirm('Voulez-vous vraiment refuser ce frais?');">Refuser</a></td>
				<td><a
					href="index.php?uc=comptable&action=reporterFrais&idFrais=<?php echo $id ?>&visiteur=<?php echo $_REQUEST['visiteur'] ?>"
					onclick="return confirm('Voulez-vous vraiment repporter ce frais?');">Reporter</a></td>
			</tr>
	<?php
					}
				}
			}
		}
		?>	  
                                          
    </table>

		</div>