<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

echo '<title>Entrainement</title>';
include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
	  
	  
	$sql = 'SELECT nom,prenom,PE,idjoueur as idj FROM joueur WHERE idclub="'.$_SESSION['id'].'" ORDER BY joueur.PE DESC';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


	$nb = mysql_num_rows($req);

	if ($nb == 0)
	{
		echo 'Vous n\'avez aucun Joueurs.';
	}
	else 
	{
		// si on a des joueurs
	
		echo 'Joueurs : <br>';
		while ($data = mysql_fetch_array($req))
		{
			echo '<br>';
			$joueur=substr($data['prenom'],0,1).'.'.$data['nom'];
			echo '<a href="entrainerj.php?id=' ,$data['idj'].'">'.$joueur.'</a> PE : '.$data['PE'];
		}
		echo '<br>';
	}  
	
	echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';
	  
?>	  