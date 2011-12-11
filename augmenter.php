<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

$idj=$_POST['idj'];
$capacite=$_POST['capacite'];
$valeur=$_POST['valeur'];
$valeur++;
$pe=$_POST['pe'];
$valeurpe=$_POST['valeurpe'];
$newpe=$valeurpe-$pe;

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();

$sql = 'UPDATE `espacem`.`joueur` SET '.$capacite.' ="'.$valeur.'" WHERE idjoueur ='.$idj;
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$sql = 'UPDATE `espacem`.`joueur` SET PE ="'.$newpe.'" WHERE idjoueur ='.$idj;
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());		
		
echo 'Le joueur s\'est entrainé';


echo '<FORM METHOD="POST"  ACTION="entrainerj.php?id='.$idj.'"> ';
echo '<input type="submit" name="continuer" value="Continuer">';
 
echo '</FORM>';	



?>