<?php

$idj=$_POST['idjoueur'];



include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();

$sql = 'UPDATE `espacem`.`joueur` SET `idclub` ="7" WHERE `joueur`.`idjoueur` ='.$idj;
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		
		
echo 'Le joueur fait desormais partie des joueurs libres ';


echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';	

echo '<FORM METHOD="POST"  ACTION="libres.php"> ';
echo '<input type="submit" name="libres" value="Liste des joueurs libres">';
 
echo '</FORM>';	

?>