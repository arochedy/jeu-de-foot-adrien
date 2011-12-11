<?php
session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}
?>


<?php

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
$idt=$_POST['idtransfert'];



$sql = 'DELETE FROM `espacem`.`transfert` WHERE `transfert`.`idtransfert` ="'.$idt.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

echo "le transfert est annulé !";	  
	  
?>	  