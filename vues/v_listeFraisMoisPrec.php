
<script type="text/javascript">

var idVis=0;
function chgpage(id)
{
idVis=document.getElementById(id);
if (idVis.selectedIndex != 0)
{
location.href = "location:index.php?uc=comptable&action=listeFraisComptable&visiteur="+idVis.options[idVis.selectedIndex].value;
}
}
</script>


<div id="contenu">
	<select name="selectVisiteur"
		onChange="chgpage('selectVisiteur')">
		<?php
		foreach ( $lesVisiteurs as $unVisiteur ) {
			echo '
			<option value=' . $unVisiteur ['id'] . '>' . $unVisiteur ['nom'] . ' ' . $unVisiteur ['prenom'] . '</option>';
		}
		
		if (isset ( $_REQUEST ['test'] )) {
			?>
	</select>
	<table class="listeLegere">
		<caption>Descriptif des éléments Hors Forfait du mois de <?php echo $libelleMois ?></caption>
		<tr>
			<th class="date">Date</th>
			<th class="libelle">Libellé</th>
			<th class="montant">Montant</th>
			<th class="action">&nbsp;</th>
			<th class="action">&nbsp;</th>
			<th class="action">&nbsp;</th>
			<th class="action">&nbsp;</th>
			<th class="action">&nbsp;</th>
		</tr>
          
    <?php
			foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) {
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
				href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>"
				onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer
					ce frais</a></td>
		</tr>
	<?php
			}
		}
		?>	  
                                          
    </table>

</div>


