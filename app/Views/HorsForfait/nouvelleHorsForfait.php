<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
<?php

// On vérifie que l'utilisateur est connecté.
if ($_SESSION['login'] == NULL)
{
	header("location:index.php?error=3");
	exit;
}
?>
<?= $this->endSection() ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

<p>La fiche frais forfait a été ajoutée.</p>
<form action="note" method="post">
<input type='hidden' id='login' name='login' value='<?php echo $_SESSION['login'] ?>'/>
<input type='hidden' id='mois' name='mois' value='<?php echo $_SESSION['mois'] ?>'/>
<input type='submit' class='btn btn-success btn-sm'value='OK'/>
</form>
<?= $this->endSection() ?>