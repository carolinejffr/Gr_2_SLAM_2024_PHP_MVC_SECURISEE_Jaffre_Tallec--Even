<?php
    if (isset($_POST['login']) && isset($_POST['mdp'])) {
		
		if ($_POST['login'] == "" || $_POST['mdp'] == "")
		{
			header("location:index.php?error=1");
			exit;
		}
		else
		{
			if (esc($login_valide) == $_POST['login'] && esc($mdp_valide) == $_POST['mdp']) {
    		// on redirige notre visiteur vers une page de notre section membre
			session_start();
			$_SESSION['login'] = $_POST['login'];
    		header ('location:selection');
			exit;
    	}
    	else {
    		header("location:index.php?error=2");
			exit;
    	}
		}


    }
    else {
		header("location:index.php?error=1");
		exit;
    }
    ?>