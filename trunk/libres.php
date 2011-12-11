<?php


echo '<title>Liste des joueurs libres</libres>';

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
		
$sql = 'SELECT nom,prenom,idjoueur as idj,poste FROM joueur WHERE idclub="7"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$nb = mysql_num_rows($req);

if ($nb == 0) 
{
	echo 'Il n\'y a pas de joueurs libres';
}
else
 {
	
	//echo 'Joueurs';
	while ($data = mysql_fetch_array($req))
	{
		echo '<br>';
		$joueur=substr($data['prenom'],0,1).'.'.$data['nom'].'    ['.$data['poste'].']';
		echo '<a href="joueur.php?id='.$data['idj'].'">'.$joueur.'</a>';
	}
	echo '<br>';
}

echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';	

?>