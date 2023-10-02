<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
<?= $this->endSection() ?>


<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

<h2>Nouvelle fiche forfait</h2>
<form action="nouvelleFicheForfait" method="post">
    <input type="hidden" id="idVisiteur" name="idVisiteur"  value="<?php echo esc($id); ?>"/>
    <label>Mois en cours (non-modifiable)</label>
	<input type="number" class="form-control" name="mois" value="<?php echo esc($mois); ?>" min="1" max="12" step="1" readonly>
    <label>ID Frais forfait</label>
	<select id="idFraisForfait" class="form-control" name="idFraisForfait" value="ETP">
		<option selected="selected" value="ETP">Forfait étape</option>
		<option value="KM">Frais kilométrique</option>
		<option value="NUI">Nuitée hôtel</option>
		<option value="REP">Repas restaurant</option>
	</select>
    <label>Quantité</label> <br/>
    <input type="number" name="quantite" id="quantite" step="1" value="1"/><br/>
    
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?= $this->endSection() ?>