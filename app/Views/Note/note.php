<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
<?php session_start(); 
$_SESSION['mois'] = $_POST['mois'];

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


// On vérifie que l'utilisateur est connecté.
if (esc($login) == NULL)
{
	$ip = $_SERVER['REMOTE_ADDR'];
	$str = "L'IP : " . $ip . " n'est plus connectée.";
	log_message('info', $str);
	header("location:index.php?error=3");
	exit;
}
?>
<?= $this->endSection() ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>
	<a class='btn btn-success btn-sm' href= <?php echo("\"selection?token=$_SESSION[token]\"")?>>Retour au menu principal</a>
	<a class='btn btn-danger btn-sm' href= <?php echo("\"deconnexion?token=$_SESSION[token]\"")?>>Se déconnecter</a>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

<p> Vous êtes connecté en tant que 
	<?php 
		echo esc($prenom); 
	?> 
	<?php 
		echo esc($nom);
	?>.
	</p>
	<!--
	<form action='nouveau' method='post'>
		<input type='hidden' id='login' name='login' value='<?php // $_SESSION['login'] ?>'/>
		<input type='submit' class="btn btn-primary" value='Nouveau'/>
	</form> -->
	
	<table class="table">
		<thead class="text-bg-dark p-3">
			<tr>
				<!--<th>ID</th> -->
				<th>Visiteur</th>
				<th>Mois</th>
				<th>Nombre justificatifs</th>
				<th>Montant validé</th>
				<th>Date modification</th>
				<th>État</th>
				<th>Édition</th>
			</tr>
		</thead>	
			<tbody>
			<?php
			
		$reponse = esc($reponse);

		while ($donnees = $reponse->fetch())
		{
			echo "
				<tr class='text-bg-dark p-3'>
					<!-- <td>$donnees[idFrais]</td> -->
					<td>$donnees[idVisiteur]</td>
					<td>$donnees[mois]</td>
					<td>$donnees[nbJustificatifs]</td>
					<td>$donnees[montantValide]</td>
					<td>$donnees[dateModif]</td>
					<td>$donnees[idEtat]</td>
					<td>";

					if ($donnees['idVisiteur'] == esc($id))
					{
						echo "
						<a class='btn btn-primary btn-sm' href='edition?idFrais=$donnees[idFrais]&token=$_SESSION[token]'>Modifier</a>
						<a class='btn btn-danger btn-sm' href='validation?idFrais=$donnees[idFrais]&token=$_SESSION[token]'>Supprimer</a>
						";
					}
					echo 
					"</td>
				</tr>";
		}
		
		$reponse->closeCursor();
	?>

			</tbody>
		</table>

<?= $this->endSection() ?>