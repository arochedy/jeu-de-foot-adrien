<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

$type=$_POST['type'];

  switch($type)
	{
	case 'cdf':
	$prix=800000;
	break;
	case 'tv':
	$prix=800000;
	break;
	case 'entrainement':
	$prix=800000;
	break;
	default:
	$poste='poste ASC';
	break;
}


include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	
	
	
	
	$sql = 'SELECT argent FROM membre WHERE id="'.$_SESSION['id'].'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	$data = mysql_fetch_array($req);
	$argent=$data['argent'];
	
	if($prix<$data['argent'])
	{
	
	$sql= 'INSERT INTO '.$type.' VALUES("","'.$_SESSION['id'].'","1")';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	$argent-=$prix;
	$sql= 'UPDATE espacem.membre SET argent="'.$argent.'" WHERE id="'.$_SESSION['id'].'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	echo "votre infrastructures a été construite !";
	}
	else 
	echo "vous n'avez pas assez d'argent !";
	


	
	

?>