<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}




include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	
	$sql = 'SELECT idcdf,niveau FROM cdf WHERE idclub="'.$_SESSION['id'].'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	$nb = mysql_num_rows($req);
	
	$data = mysql_fetch_array($req);
	
	$idcdf=$data['idcdf'];
	
	echo 'Centre de formation: <br><br>' ;
	
	$niveau=$data['niveau'];
	$prix=$data['niveau'];
	$prix*=400000;
	
	if($niveau<20)
	{
	echo 'ça coute : '.$prix.' €';
	
	
	echo '<FORM METHOD="POST"  ACTION="ainfra.php"> ';
	echo '<input type="hidden" name="type" value="cdf">';
	echo '<input type="hidden" name="idinfra" value="'.$idcdf.'">';
	echo '<input type="hidden" name="idc" value="'.$_SESSION['id'].'">';
	echo '<input type="hidden" name="prix" value="'.$prix.'">';
	echo '<input type="submit" name="augmenterinfra" value="Ameliorer">';
 
	echo '</FORM>';	
	}	
	else
	{
	echo 'Niveau maximal impossible d\'ameliorer !';
	
	echo '<FORM METHOD="POST"  ACTION="cdf.php?id='.$idcdf.'"> ';
	echo '<input type="submit" name="augmenterinfra" value="retour">';
 
	echo '</FORM>';	
	}
	?>
	
	
	