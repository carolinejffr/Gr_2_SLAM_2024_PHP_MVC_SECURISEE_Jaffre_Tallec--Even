<?= $this->extend("layouts/default") ?>

<?= $this->section("preHTML") ?>
    <?php
    $errorMessage = "";

    if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
    {

        
        if (isset($_GET["error"]) )
        {
            if ($_GET["error"] == 1)
            {
                $errorMessage = "Veuillez remplir le formulaire.";
            }
            else if ($_GET["error"] == 2)
            {
                $errorMessage = "Login ou mot de passe incorrect.";
            }
            else if ($_GET["error"] == 3)
            {
                $errorMessage = "Veuillez vous connecter.";
            }
            else if ($_GET["error"] == 4)
            {
                $ip = $_SERVER['REMOTE_ADDR'];
                $str = "L'IP : " . $ip . " a tenté d'utiliser un token invalide.";
			    log_message('info', $str);
                $errorMessage = "Erreur de Token.";
            }
        }
    }
    ?>
<?= $this->endSection() ?>

<?= $this->section("titre") ?>GSB 2SIO<?= $this->endSection() ?>

<?= $this->section("h1") ?>

<?= $this->endSection() ?>

<?= $this->section("contenu") ?>

    <?php
        if (!empty($errorMessage))
        {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>	
            ";
	    }
	?>

    <h2>Bienvenue.</h2>
    <form action='login' method="post">
        <label for="login">Identifiant:</label><br>
        <input type="text" id="login" name="login" value=""><br>
        <label for="mdp">Mot de passe:</label><br>
        <input type="password" id="mdp" name="mdp" value=""><br><br>
        <input type="submit"  class="btn btn-success" value="Connexion">
    </form>

<?= $this->endSection() ?>