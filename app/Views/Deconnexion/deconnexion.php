<?php
// Déconnexion de l'utilisateur
session_start();

$str = "L'utilisateur : " . $_SESSION['login'] . " s'est déconnecté.";
log_message('info', $str);
session_unset();
session_destroy();
header("location:index.php");
exit;
?>