<?php

namespace App\Models;

use CodeIgniter\Model;
use \PDO;

class HomeModel extends Model
{
    // On est obligé de définir la table par défaut pour CodeIgniter, pour passer par PDO
    protected $table = "FicheFrais";

    // Variables PDO
    // Base de données
    protected static $bdd;
    protected static $bddName;
    protected static $bddHost = "mysql:host=localhost;dbname=gsbV2;charset=utf8";
    protected static $bddLogin = "root";
    protected static $bddPassword = "password";
    // Tables utilisées
    protected static $visiteur = "Visiteur";
    protected static $ficheFrais = "FicheFrais";

    public static function connexionBDD()
    {
        $bdd = new PDO(HomeModel::$bddHost, HomeModel::$bddLogin, HomeModel::$bddPassword);
        self::$bdd = $bdd;

        return $bdd;
    }

    public static function verifLogin($login)
    {
        $reponse = self::$bdd->prepare('SELECT * FROM gsbV2.Visiteur WHERE login = ?');
        $reponse->execute(array($login));
        if ($reponse->rowCount() < 1)
        {
            $login = "";
        }
        return $login;
    }

    public static function verifPassword($mdp, $login)
    {
        $reponse = self::$bdd->prepare('SELECT * FROM gsbV2.Visiteur WHERE mdp = ? AND login =' . '\'' . $login . '\'');
        $reponse->execute(array($mdp));
        if ($reponse->rowCount() < 1)
        {
            $mdp = "";
        }
        return $mdp;
    }

    public static function getIdUtilisateur($login)
    {
        // Récupération de l'ID
        $reponse = self::$bdd->prepare('SELECT id FROM gsbV2.Visiteur WHERE login = ?');
        $reponse->execute(array($login));
        $id = $reponse->fetch()[0];
        return $id;
    }

    public static function getNomUtilisateur($login)
    {
       // Récupération du nom
       $reponse = self::$bdd->prepare('SELECT nom FROM gsbV2.Visiteur WHERE login = ?');
       $reponse->execute(array($login));
       $nom = $reponse->fetch()[0];
       return $nom; 
    }

    public static function getPrenomUtilisateur($login)
    {
       // Récupération du nom
       $reponse = self::$bdd->prepare('SELECT prenom FROM gsbV2.Visiteur WHERE login = ?');
       $reponse->execute(array($login));
       $prenom = $reponse->fetch()[0];
       return $prenom; 
    }

    public static function getReponse()
    {
        $reponse = self::$bdd->prepare('SELECT * FROM gsbV2.FicheFrais');
        return $reponse;
    }

    public static function getRow()
    {
        $sql = "SELECT * FROM FicheFrais";
        $result = self::$bdd->prepare('SELECT * FROM gsbV2.FicheFrais');
        $result = self::$bdd->query($sql);
        $row = $result->fetch();

        return $row;
    }

    public static function getFicheFrais($mois)
    {
        $reponse = self::$bdd->prepare('SELECT * FROM gsbV2.FicheFrais WHERE FicheFrais.mois = ?');
        $reponse->execute(array($mois));
        return $reponse;
    }

    public static function supprimerLigne($bdd, $id)
    {
        
        // supprimer de Forfait
        $reponse = self::$bdd->prepare('DELETE FROM gsbV2.LigneFraisForfait WHERE idFrais = ?');
	    $reponse->execute(array($id));

        // supprimer de Hors Forfait
        $reponse = self::$bdd->prepare('DELETE FROM gsbV2.LigneFraisHorsForfait WHERE idFrais = ?');
	    $reponse->execute(array($id));

        // supprimer de FicheFrais
        $reponse = self::$bdd->prepare('DELETE FROM gsbV2.FicheFrais WHERE idFrais = ?');
	    $reponse->execute(array($id));
    }

    public static function ajouterLigne($idVisiteur, $mois, $nbJustificatifs, $montantValide, $aujourdhui, $idEtat)
    {
        $reponse = self::$bdd->prepare("INSERT INTO `gsbV2`.`FicheFrais` 
        (`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`) 
        VALUES ('$idVisiteur', '$mois', '$nbJustificatifs', '$montantValide', '$aujourdhui', '$idEtat');");
		$reponse->execute(array());
    }

    public static function afficherLigne($idFrais)
    {
        $sql = "SELECT * FROM FicheFrais WHERE idFrais = $idFrais";
        $result = self::$bdd->query($sql);
        
        $row = $result->fetch();

        return $row;
    }

    public static function modifierLigne($mois, $nbJustificatifs, $montantValide, $aujourdhui, $idEtat, $idFrais)
    {
        $reponse = self::$bdd->prepare("UPDATE FicheFrais ".
        "SET mois = '$mois', nbJustificatifs = '$nbJustificatifs', montantValide = '$montantValide', dateModif = '$aujourdhui', idEtat = '$idEtat' " .
        "WHERE idFrais = '$idFrais'");
        $reponse->execute(array());
    }

    public static function nouveauFraisForfait($idVisiteur, $mois, $idFraisForfait, $quantite, $aujourdhui)
    {
        // fiche frais
        $reponse = self::$bdd->prepare("INSERT INTO `gsbV2`.`FicheFrais` 
        (`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`) 
        VALUES ('$idVisiteur', '$mois', '0', '0', '$aujourdhui', 'CR');");
		$reponse->execute(array());

        // Récupération de l'idFrais
       $reponse = self::$bdd->prepare('SELECT idFrais FROM gsbV2.FicheFrais WHERE idVisiteur = ? AND dateModif = ?');
       $reponse->execute(array($idVisiteur, $aujourdhui));
       $idFrais = $reponse->fetch()[0];

        // frais forfait
        $reponse = self::$bdd->prepare("INSERT INTO `gsbV2`.`LigneFraisForfait` 
        (`idVisiteur`, `idFrais`, `mois`, `idFraisForfait`, `quantite`) 
        VALUES ('$idVisiteur', '$idFrais', '$mois', '$idFraisForfait', '$quantite');");
		$reponse->execute(array());

        
    }

    public static function nouveauHorsForfait($idVisiteur, $mois, $libelle, $date, $montant)
    {
        // fiche frais
        $reponse = self::$bdd->prepare("INSERT INTO `gsbV2`.`FicheFrais` 
        (`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`) 
        VALUES ('$idVisiteur', '$mois', '0', '0', '$date', 'CR');");
		$reponse->execute(array());

        // Récupération de l'idFrais
       $reponse = self::$bdd->prepare('SELECT idFrais FROM gsbV2.FicheFrais WHERE idVisiteur = ? AND dateModif = ?');
       $reponse->execute(array($idVisiteur, $date));
       $idFrais = $reponse->fetch()[0];

        // frais hors forfait
        $reponse = self::$bdd->prepare("INSERT INTO `gsbV2`.`LigneFraisHorsForfait` 
        (`idVisiteur`, `mois`, `idFrais`, `libelle`, `date`, `montant`) 
        VALUES ('$idVisiteur', '$mois', '$idFrais', '$libelle', '$date', '$montant');");
		$reponse->execute(array());
    }
}
