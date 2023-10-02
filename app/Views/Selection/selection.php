<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
    <?php
    $mois = date('n');
    ?>
<?= $this->endSection() ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>
    <h2>Bienvenue chez GSB !</h2>
    
    <h3>Créer une nouvelle fiche</h3>
    <a class="btn btn-primary" href="forfait" role="button">Fiche forfait</a>
    <a class="btn btn-primary" href="horsforfait" role="button">Fiche hors-forfait</a>
    <br/>
    <h3>Consulter toutes mes fiches frais</h3>
    <p>Choississez le mois à afficher</p>
    <form action="note" method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Mois (1 = janvier, etc.)</label>
            <div class="col-sm-6">
            <input type="hidden" name="login" value="<?php echo $_SESSION['login'] ?>">
            <input type="number" class="form-control" name="mois" value="<?php echo $mois; ?>" min="1" max="12" step="1">
        </div>
        <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>

<?= $this->endSection() ?>