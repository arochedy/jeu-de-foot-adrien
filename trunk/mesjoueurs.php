<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

echo "<title>Mes joueurs </title>";
$id=$_SESSION['id'];
$ordre=0;
$ordre=$_GET['ordre'];


include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();

	  switch($ordre)
	{
	case 0:
	$poste='poste ASC';
	break;
	case 1:
	$poste='gardien  DESC';
	break;
	case 2:
	$poste='defense DESC';
	break;
	case 3:
	$poste='attaque DESC';
	break;
	case 4:
	$poste='endurance DESC';
	break;
	case 5:
	$poste='titulaire DESC,poste';
	break;
	default:
	$poste='poste ASC';
	break;
}
	  
	  
$sql = 'SELECT * FROM joueur WHERE idclub="'.$_SESSION['id'].'" ORDER BY '.$poste.'';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


$nb = mysql_num_rows($req);

if ($nb == 0) {
	echo 'Vous n\'avez aucun Joueurs.';
}
else {
	// si on a des joueurs
	
	echo 	'<table>';
	echo 'Nombre de joueurs : '.$nb.'/33 <br> ';
	echo 'Joueurs : ';
		echo 	 '<tr>';
		echo 	'<th>Joueur</th>';
		echo 	'<th><a href="mesjoueurs.php?ordre=0">Poste</a></th>';
		echo 	'<th><a href="mesjoueurs.php?ordre=1">Gardien</a></th>';
		echo  	'<th><a href="mesjoueurs.php?ordre=2">Defense</a></th>';
		echo  	'<th><a href="mesjoueurs.php?ordre=3">Attaque</a></th>';
		echo  	'<th><a href="mesjoueurs.php?ordre=4">Endurance</a></th>';
		echo  	'<th><a href="mesjoueurs.php?ordre=5">Statut</a></th>';
		echo  	'<th></th>';
		echo	'</tr>';
		
	while ($data = mysql_fetch_array($req))
	{
		
		echo '<tr>';
		echo '<td>';
		$joueur=substr($data['prenom'],0,1).'.'.$data['nom'];
		echo '<a href="joueur.php?id=' ,$data['idjoueur'].'">'.$joueur.'</a>';
		echo '</td>';
		echo '<td>';
		echo  $data['poste'];
		echo '</td>';
		echo '<td>';
		echo  $data['gardien'];
		echo '</td>';
		echo '<td>';
		echo  $data['defense'];
		echo '</td>';
		echo '<td>';
		echo  $data['attaque'];
		echo '</td>';
		echo '<td>';
		echo  $data['endurance'];
		echo '</td>';
		echo '<td>';
		echo  $data['titulaire'];
		echo '</td>';
		echo '</tr>';
	}
	echo 	'</table>';
	echo '<br>';
	
}
echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		



?>