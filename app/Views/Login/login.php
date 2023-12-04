<?php
    if (isset($_POST['login']) && isset($_POST['mdp'])) {
        
		$mdp = md5($_POST['mdp']);
        echo(esc($mdp_valide));

		$ip = $_SERVER['REMOTE_ADDR'];
        
		if ($_POST['login'] == "" || $mdp == "")
		{
			$str = "L'IP : " . $ip . " a tenté de se connecter sans remplir les champs.";
			log_message('info', $str);
			header("location:index.php?error=1");
			exit;
		}
		else
		{
			if (esc($login_valide) == $_POST['login'] && esc($mdp_valide) == $mdp) {
    		// on redirige notre visiteur vers une page de notre section membre
			session_start();
			$_SESSION['login'] = $_POST['login'];
			// Access Token
			$token  = bin2hex(random_bytes(32));
			$_SESSION['token'] = $token;
			$token;
			$str = "L'utilisateur : " . $_SESSION['login'] . " s'est connecté avec l'IP : " . $ip;
			log_message('info', $str);

    		header ('location:selection?token=' . $token);
			exit;
    	    }
    	    else {
				$str = "L'IP : " . $ip . " a tenté de se connecter avec de mauvaises informations.";
			log_message('info', $str);
    		  header("location:index.php?error=2");
			  exit;
    	    }
		}


    }
    else {
		$str = "L'IP : " . $ip . " a tenté de se connecter sans remplir les champs.";
		log_message('info', $str);
		header("location:index.php?error=1");
		exit;
    }
    ?>