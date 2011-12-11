<?php

$idc=$_GET['id'];

echo '<title> Infrastructures </title>';

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	

$sql = 'SELECT login,nomclub,id,datedecreation as date FROM membre WHERE id="'.$idc.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$nb = mysql_num_rows($req);

if ($nb == 0) 
{
	echo 'Ce club n\'existe pas.';
}
else
{
	echo 'Liste des infrasrtuctures : <br><br>' ;
	
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
	}
	else
	{
		while ($data = mysql_fetch_array($req))
		{	
			echo '<a href="cdf.php?id='.$data['idcdf'].'">Centre de formation (Niveau : '.$data['niveau'].')</a><br>';
		}
	}
	echo '<br>';
}	
echo '<FORM METHOD="POST"  ACTION="club.php?id='.$idc.'"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		
	
		
		
?>		
