<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
<?php session_start(); 

// On vérifie que l'utilisateur est connecté.
if ($_SESSION['login'] == NULL)
{
	header("location:index.php?error=3");
	exit;
}
if (!isset($_SESSION['token']))
{
	if (isset($_GET['token']))
	{
		if ($_SESSION['token'] != $_GET['token'])
		{
			header("location:index.php?error=4");
		}
	}
	else if (isset($_POST['token']))
	{
		if ($_SESSION['token'] != $_POST['token'])
		{
			header("location:index.php?error=4");
		}
	}
	else
	{
		header("location:index.php?error=4");
	}
}
?>
<?= $this->endSection() ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

<p>La modification de vos notes de frais a bien été prise en compte.</p>
<form action="note" method="post">
<input type='hidden' id='login' name='login' value='<?php echo $_SESSION['login'] ?>'/>
<input type='hidden' id='mois' name='mois' value='<?php echo $_SESSION['mois'] ?>'/>
<input type='submit' class='btn btn-success btn-sm'value='OK'/>
</form>
<?= $this->endSection() ?>
