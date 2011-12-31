<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

echo '<title>Tactique</title>';
include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();	
	
	
$aligner=false;
if(isset($_POST['aligner']))
$aligner=true;

if(isset($_POST['idtactique']))
$idtactique=$_POST['idtactique'];
	
echo $idtactique;
if($aligner)
{
$sql = 'UPDATE tactiqueclub SET aligne="1" WHERE idtactique="'.$idtactique.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
echo $sql;

$sql = 'UPDATE tactiqueclub SET aligne="0" WHERE idtactique!="'.$idtactique.'" AND idclub="'.$_SESSION['id'].'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

echo 'La nouvelle tactique est alignée';
}

?>