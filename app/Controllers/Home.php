<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{
    public function index(): string
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $str = "L'IP : " . $ip . " vient d'accéder au site.";
		log_message('info', $str);
        return view('Home/index');
    }

    public function login(): string
    {
        $model = new HomeModel;

        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }

        // On test les identifiants de connexion
        $data['login_valide'] = $model::verifLogin($_POST['login']);
        $data['mdp_valide'] = $model::verifPassword(md5($_POST['mdp']), $_POST['login']);

        // Vue
        return view('Login/login', $data);
    }

    public function selectionMois(): string
    {
        session_start();
        if (!isset($_SESSION['token']) || $_SESSION['token'] != $_GET['token'])
        {
            header("location:index.php?error=4");
        }
        $_SESSION['mois'] = date('n');
        // La page sélection n'a pas besoin de la base de données (selection valeur entre 1 et 12)
        return view('Selection/selection');
    }

    public function note(): string
    {

        $model = new HomeModel;
        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }
        $login = $_POST['login'];
        $data['login'] = $login;
        $data['mois'] = $_POST['mois'];
        $data['id'] = $model::getIdUtilisateur($login);
        $data['nom'] = $model::getNomUtilisateur($login);
        $data['prenom'] = $model::getPrenomUtilisateur($login);
        $data['reponse'] = $model::getFicheFrais($_POST['mois']);

        return view('Note/note', $data);
    }

    public function nouveau(): string
    {
        
        session_start();
        if (!isset($_SESSION['token']) || $_SESSION['token'] != $_GET['token'])
        {
            header("location:index.php?error=4");
        }
        $model = new HomeModel;
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }

        $login = $_SESSION['login'];
        $data['login'] = $login;

        $data['id'] = $model::getIdUtilisateur($login);
        $data['mois'] = $_SESSION['mois'];

        date_default_timezone_set('Europe/Paris');
	    $data['aujourdhui'] = date('Y-m-d H:i:s');

        return view('Nouveau/nouveau', $data);
    }

    public function edition(): string
    {
        session_start();
        if (!isset($_SESSION['token']) || $_SESSION['token'] != $_GET['token'])
        {
            header("location:index.php?error=4");
        }
        $model = new HomeModel;
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        $login = $_SESSION['login'];
        $data['login'] = $login;

        $data['id'] = $model::getIdUtilisateur($login);

        date_default_timezone_set('Europe/Paris');
        $data['aujourdhui'] = date('Y-m-d H:i:s');

        $id = $_GET['idFrais'];

        $row = $model::afficherLigne($id);
        $data['row'] = $row;
        $data['nbJustificatifs'] = $row['nbJustificatifs'];
        $data['mois'] = $row['mois'];
        $data['montantValide'] = $row['montantValide'];
        $data['idEtat'] = $row['idEtat'];
        $data['idFrais'] = $_GET["idFrais"];

        return view('Edition/edition', $data);
    }

    public function deconnexion(): string
    {
        return view('Deconnexion/deconnexion');
    }

    public function validation($modeEdition = false): string
    {
        session_start(); 
        // Cas suppression
        if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
        {
            $model = new HomeModel;
            $id = $_GET['idFrais'];
            // On se connecte à la BDD
            try
            {
                $bdd = $model::ConnexionBDD();
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }

            $model::supprimerLigne($bdd, $id);
            $str = "L'utilisateur : " . $_SESSION['login'] . " a supprimé l'entrée " . $id;
			log_message('info', $str);

            return view('Validation/validation');
        }
        else if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {
            $modeEdition = $_POST['modeEdition'];
            if ($modeEdition == 0)
            {
                // Cas nouveau
                $model = new HomeModel;

                // On se connecte à la BDD
                try
                {
                    $bdd = $model::ConnexionBDD();
                }
                catch (Exception $e)
                {
                    die('Erreur : ' . $e->getMessage());
                }

                $idVisiteur = $_POST['idVisiteur'];
                $mois = $_POST['mois'];
                $nbJustificatifs = $_POST['nbJustificatifs'];
                $montantValide = $_POST['montantValide'];
                $aujourdhui = $_POST['aujourdhui'];
                $idEtat = $_POST['idEtat'];
                $model::ajouterLigne($idVisiteur, $mois, $nbJustificatifs, $montantValide, $aujourdhui, $idEtat);

                $str = "L'utilisateur : " . $_SESSION['login'] . " a ajouté une nouvelle entrée.";
			    log_message('info', $str);
                return view('Validation/validation');
            }
            else
            {
                // Cas édition
                $model = new HomeModel;

                // On se connecte à la BDD
                try
                {
                    $bdd = $model::ConnexionBDD();
                }
                catch (Exception $e)
                {
                    die('Erreur : ' . $e->getMessage());
                }
                $mois = $_POST['mois'];
                $nbJustificatifs = $_POST['nbJustificatifs'];
                $montantValide = $_POST['montantValide'];
                $aujourdhui = $_POST['aujourdhui'];
                $idEtat = $_POST['idEtat'];
                $idFrais = $_POST['idFrais'];
                $model::modifierLigne($mois, $nbJustificatifs, $montantValide, $aujourdhui, $idEtat, $idFrais);

                $str = "L'utilisateur : " . $_SESSION['login'] . " a modifié l'entrée " . $idFrais;
			    log_message('info', $str);

                return view('Validation/validation');
            }
        }
    }

    public static function forfait()
    {
        session_start();
        if (!isset($_SESSION['token']) || $_SESSION['token'] != $_GET['token'])
        {
            header("location:index.php?error=4");
        }
        $model = new HomeModel;
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
	    {
		    die('Erreur : ' . $e->getMessage());
	    }

        $login = $_SESSION['login'];
        $data['login'] = $login;

        $data['id'] = $model::getIdUtilisateur($login);
        $data['mois'] = date("n");
        
        return view('Forfait/forfait', $data); 
    }

    public function horsForfait()
    {
        session_start();
        if (!isset($_SESSION['token']) || $_SESSION['token'] != $_GET['token'])
        {
            header("location:index.php?error=4");
        }
        $model = new HomeModel;
           
        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        $login = $_SESSION['login'];
        $data['login'] = $login;

        $data['id'] = $model::getIdUtilisateur($login);
        $data['mois'] = date("n");

        return view('HorsForfait/horsforfait', $data);
    }

    public static function nouvelleFicheForfait()
    {
        session_start();
        if (!isset($_SESSION['token']) || $_SESSION['token'] != $_POST['token'])
        {
            header("location:index.php?error=4");
        }
        $model = new HomeModel;
           
        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

        $idVisiteur = $_POST['idVisiteur'];
        $mois = $_POST['mois'];
        $idFraisForfait = $_POST['idFraisForfait'];
        $quantite = $_POST['quantite'];

        date_default_timezone_set('Europe/Paris');
	    $aujourdhui = date('Y-m-d H:i:s');


        $model::nouveauFraisForfait($idVisiteur, $mois, $idFraisForfait, $quantite, $aujourdhui);

        $str = "L'utilisateur : " . $_SESSION['login'] . " a ajouté une nouvelle fiche forfait.";
		log_message('info', $str);

        return view('Forfait/nouvelleFicheForfait');
    }

    public static function nouvelleHorsForfait()
    {
        session_start();
        if (!isset($_SESSION['token']) || $_SESSION['token'] != $_POST['token'])
        {
            header("location:index.php?error=4");
        }
        $model = new HomeModel;
           
        // On se connecte à la BDD
        try
        {
            $bdd = $model::ConnexionBDD();
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        
        $idVisiteur = $_POST['idVisiteur'];
        $mois = $_POST['mois'];
        $libelle = $_POST['libelle'];
        $montant = $_POST['montant'];

        date_default_timezone_set('Europe/Paris');
	    $aujourdhui = date('Y-m-d H:i:s');

        $model::nouveauHorsForfait($idVisiteur, $mois, $libelle, $aujourdhui, $montant);

        $str = "L'utilisateur : " . $_SESSION['login'] . " a ajouté une nouvelle fiche hors forfait.";
		log_message('info', $str);

        return view('Forfait/nouvelleFicheForfait');
    }
}
