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
	  
	 

$idj=$_POST['idjoueur'];
$idc=$_POST['idclubacheteur'];	 
$montant=$_POST['montant'];

$sql = 'SELECT argent FROM membre WHERE id="'.$idc.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$data = mysql_fetch_array($req);
$argent=$data['argent'];
$argent-=$montant;

$sql = 'SELECT argent FROM membre WHERE id="'.$_SESSION['id'].'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$data = mysql_fetch_array($req);
$argent2=$data['argent'];
$argent2+=$montant;

$sql = 'UPDATE espacem.joueur SET idclub="'.$idc.'" WHERE idjoueur="'.$idj.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$sql = 'UPDATE espacem.transfert SET accepte="1" WHERE idjoueur="'.$idj.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$sql = 'UPDATE espacem.membre SET argent="'.$argent.'" WHERE id="'.$idc.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$sql = 'UPDATE espacem.membre SET argent="'.$argent2.'" WHERE id="'.$_SESSION['id'].'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

echo 'Le transfert s\'est bien déroulé !';

?>	  