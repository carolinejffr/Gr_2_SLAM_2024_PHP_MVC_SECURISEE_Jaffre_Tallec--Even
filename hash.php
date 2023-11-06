<?php

$connexion = new PDO("mysql:host=127.0.0.1;dbname=gsbV2;port=3306", "root", "password");

$requeteMdp = "SELECT mdp FROM visiteur ORDER BY mdp";
$resultatsMdp = $connexion->query($requeteMdp);
$arrayMdp[] =  $resultatsMdp->fetchAll();

$requeteId= "SELECT id FROM visiteur ORDER BY mdp";
$resultatsId = $connexion->query($requeteId);
$arrayId[] =  $resultatsId->fetchAll();

for ($i = 0; $i < count($arrayMdp); $i++)
{
    for($j = 0; $j < count($arrayMdp[0]); $j++)
    {
        $mdpActuel = md5($arrayMdp[$i][$j][0]);
        $sth = $connexion->prepare('UPDATE visiteur SET mdp = ? WHERE id = ? ');
        $sth->execute([$mdpActuel,$arrayId[$i][$j][0]]);
        echo($mdpActuel);
        echo(" ");
        echo($arrayId[$i][$j][0]);
        echo("</br>");
    }
}
?>