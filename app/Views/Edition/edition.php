<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
<?= $this->endSection() ?>


<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

<h2>modification</h2>
<form action="validation" method="post">
    <input type="hidden" id="modeEdition" name="modeEdition"  value="1"/>
	<input type="hidden" id="idVisiteur" name="idVisiteur"  value="<?php echo esc($id); ?>"/>
	<input type="hidden" id="idFrais" name="idFrais"  value="<?php echo esc($idFrais); ?>"/>
	
	<label>Mois en cours (non-modifiable)</label>
	<input type="number" class="form-control" name="mois" value="<?php echo esc($mois); ?>" min="1" max="12" step="1" readonly>
	
	<label>Nombre de justificatifs</label>
	<input type="number" class="form-control" name="nbJustificatifs" value="<?php echo esc($nbJustificatifs); ?>">

	<label>Montant valide</label>
	<input type="number" class="form-control" name="montantValide" value="<?php echo esc($montantValide); ?>" min="0.01" step="0.01">

	<label>ID état</label>
	<select id="idEtat" class="form-control" name="idEtat" value="<?php echo esc($idEtat); ?>">
		<option value="CL">Saisie clôturée</option>
		<option selected="selected" value="CR">Fiche créée, saisie en cours</option>
		<option value="RB">Remboursée</option>
		<option value="VA">Validée et mise en paiement</option>
	</select>

	<input type="hidden" id="aujourdhui" name="aujourdhui"  value="<?php echo esc($aujourdhui) ?>"/>
	<button type="submit" class="btn btn-primary">Valider</button>
</form>

<form action="note" method="post">
	<input type='hidden' id='login' name='login' value='<?php echo $_SESSION['login'] ?>'/>
	<input type='hidden' id='mois' name='mois' value='<?php echo esc($mois); ?>'/>
	<button type="submit" class="btn btn-outline-primary">Annuler</button>
</form>
<?= $this->endSection() ?>