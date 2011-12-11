<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

$idj=$_POST['idj'];


include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();

$sql = 'UPDATE `espacem`.`joueur` SET  titulaire="0" WHERE idjoueur ="'.$idj.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


		
echo 'Le joueur est desormais remplaçant';


echo '<FORM METHOD="POST"  ACTION="tactique.php"> ';
echo '<input type="submit" name="continuer" value="Continuer">';
 
echo '</FORM>';	



?>