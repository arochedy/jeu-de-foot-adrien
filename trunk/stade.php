<?php

$ids=$_GET['id'];


include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	
	
	echo 'Stade : <br><br>' ;
	
	$sql = 'SELECT idclub,nom,places FROM stade WHERE idstade="'.$ids.'"';
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
			
			echo 'Nom : '.$data['nom'].'<br>';
			echo $data['places'].' places <br>';
			$idc=$data['idclub'];
	
		
		}
	}
	echo '<br>';
			
	session_start();
	
	if ($_SESSION['id']==$idc)
	{
	echo "c ton stade !";
	
	
	}
	
echo '<FORM METHOD="POST"  ACTION="infra.php?id='.$idc.'"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		
	
		
		
?>		
