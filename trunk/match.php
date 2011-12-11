<?php

$idm=$_GET['id'];


include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	
	
	echo 'Match: <br><br>' ;
	echo '<title>Résumé du match</title>';
	$sql = 'SELECT * FROM espacem.match WHERE idmatch="'.$idm.'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	$nb = mysql_num_rows($req);
	
	
	if ($nb == 0) 
	{
		echo 'Aucun Match ne correpond';
	}
	else
	{
		$data = mysql_fetch_array($req);
		
		$sql = 'SELECT * FROM espacem.membre WHERE id="'.$data['iddom'].'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
		$data2 = mysql_fetch_array($req);
		
		$sql = 'SELECT * FROM espacem.membre WHERE id="'.$data['idext'].'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
		$data3 = mysql_fetch_array($req);
		
		
		echo $data['date'];
		echo '<br>';
		
		echo $data2['nomclub'].'-'.$data3['nomclub'].'<br>';
		
		echo 'score : '.$data['scoredom'].'-'.$data['scoreext'];	
		
		
		
	}
	echo '<br>';
			
	session_start();
	// on vérifie toujours qu'il s'agit d'un membre qui est connecté
	if (isset($_SESSION['login']))
	{
	
	}
	
echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		
	
		
		
?>		
