
</h3>
<div class="encadre">
	<p>Fiches validées non payées du mois de <?php echo $libelleMois?>:</p>
	<form method='post' action='index.php?uc=comptable&action=misepaiement'>
<?php
$i = 0;
if (empty ( $lesFichesFrais )) {
	echo 'Pas de fiche de frais ce mois !';
} else {
	?>
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
			<input type='hidden'
				value='<?php echo $uneFicheFrais['idVisiteur'];?>'
				name='<?php echo $i?>'>
			<input type='hidden' value='<?php echo $i?>' name='i'>
			<tr>
				<td><?php echo $nomVis ?></td>
				<td><?php echo $montantValide ?></td>
				<td><?php echo $mois ?></td>
				<td><input type='checkbox' name='<?php echo 'check'.$i?>' checked></input></td>
			</tr>
        <?php
		$i ++;
	}
	?>	
	<tr>
				<input type="submit" name="validation" value="Valider"></input>
			</tr>
		</table>
	</form>
<?php }?>
</div>
</div>














