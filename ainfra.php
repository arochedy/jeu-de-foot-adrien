<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

$type=$_POST['type'];
$idc=$_POST['idc'];
$idinfra=$_POST['idinfra'];
$prix=$_POST['prix'];


include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	
	$sql = 'SELECT niveau FROM '.$type.' WHERE idclub="'.$_SESSION['id'].'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	$nb = mysql_num_rows($req);
	$data = mysql_fetch_array($req);
	$niveau=$data['niveau'];
	
	
	$sql = 'SELECT argent FROM membre WHERE id="'.$_SESSION['id'].'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	$data = mysql_fetch_array($req);
	$argent=$data['argent'];
	
	if($prix<$data['argent'])
	{
	$niveau+=1;
	
	if($niveau<21)
	{
	$sql= 'UPDATE espacem.'.$type.' SET niveau="'.$niveau.'" WHERE idclub="'.$idc.'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	$argent-=$prix;
	$sql= 'UPDATE espacem.membre SET argent="'.$argent.'" WHERE id="'.$idc.'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	echo 'Votre infrastructure est desormais niveau '.$niveau.' !';
	}
	else
	echo 'Votre infrastructures a atteint le niveau maximum !';
	
	}
	else 
	echo "vous n'avez pas assez d'argent !";
	


	
	

?>