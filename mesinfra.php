<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

echo "<title>Infrastructures</title>";



include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
$idc=$_SESSION['id'];
	  
	  $sql = 'SELECT idstade,nom,places FROM stade WHERE idclub="'.$idc.'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	$nb = mysql_num_rows($req);
	
	echo 'Stade : <br>';
	if ($nb == 0) 
	{
		echo 'Aucun stade';
	}
	else
	{
		while ($data = mysql_fetch_array($req))
		{	
			echo '<a href="stade.php?id='.$data['idstade'].'">'.$data['nom'].' ('.$data['places'].' places)</a><br>';
		}
	}
	echo '<br>';
			
	$sql = 'SELECT idcdf,niveau FROM cdf WHERE idclub="'.$idc.'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	$nb = mysql_num_rows($req);
	
	echo 'Centre de formation: <br>';
	if ($nb == 0) 
	{	
		echo 'Pas construit';
		
		echo '<FORM METHOD="POST"  ACTION="cinfra.php"> ';
		echo '<input type="hidden" name="type" value="cdf">';
		
		echo '<input type="submit" name="construire" value="Construire">';
	 
		echo '</FORM>';	
	}
	else
	{
		while ($data = mysql_fetch_array($req))
		{	
			echo '<a href="cdf.php?id='.$data['idcdf'].'">Centre de formation (Niveau : '.$data['niveau'].')</a><br>';
		}
	}
	echo '<br>';
	
	echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
		echo '<input type="submit" name="retour" value="Retour">';
	 
		echo '</FORM>';	
	
?>	