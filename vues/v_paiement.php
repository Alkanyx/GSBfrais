
</h3>
<div class="encadre">
	<p>Fiches validées non payées :</p>
	<form>
		<table class="listeLegere">
			<tr>
				<th class="date">Visiteur</th>
				<th class="montant">Montant validé</th>
				<th class='mois'>Mois</th>
				<th class='mois'>Mise en paiement</th>
			</tr>
<?php
foreach ( $lesFichesFrais as $uneFicheFrais ) {
	$nomVis = $uneFicheFrais ['nom'] . ' ' . $uneFicheFrais ['prenom'];
	$montantValide = $uneFicheFrais ['montantValide'];
	$mois = $uneFicheFrais ['mois'];
	?>
             <tr>
				<td><?php echo $nomVis ?></td>
				<td><?php echo $montantValide ?></td>
				<td><?php echo $mois ?></td>
				<td><input type='checkbox' checked></input></td>
			</tr>
        <?php
}
?>	
	<tr>
				<input type="submit" name="validation" value="Valider"></input>
			</tr>
		</table>
	</form>
</div>
</div>














