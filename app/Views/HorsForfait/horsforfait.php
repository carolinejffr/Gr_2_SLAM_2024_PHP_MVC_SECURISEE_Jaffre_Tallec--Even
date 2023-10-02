<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
<?= $this->endSection() ?>


<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

<h2>Nouvelle fiche hors-forfait</h2>
<form action="nouvelleHorsForfait" method="post">
    <input type="hidden" id="idVisiteur" name="idVisiteur"  value="<?php echo esc($id); ?>"/>
    <label>Mois en cours (non-modifiable)</label>
	<input type="number" class="form-control" name="mois" value="<?php echo esc($mois); ?>" min="1" max="12" step="1" readonly>
    <label>Libellé</label><br/>
	<input type="text" name="libelle" id="libelle" value=""/>
	<br/>
	<label>Montant</label>
	<input type="number" class="form-control" name="montant" value="0.01" min="0.01" step="0.01">
    
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?= $this->endSection() ?>