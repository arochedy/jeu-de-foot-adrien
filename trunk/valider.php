<?php
session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}
?>

<?php
include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
	$date=date('Y-m-d');
	 
	$sql='SELECT date,iddom,idmatch FROM espacem.match WHERE idext="'.$_SESSION['id'].'" AND valide="0" AND date>="'.$date.'"';
		
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);
	echo '<title> Liste des matchs à valider</title>';
	if ($nb == 0)
	{
	echo 'Vous n\'avez aucun match en attente de validation.';
	}
	else 
	{
	
	if($nb==1)
		echo 'Match: <br><br>';
	else
		echo 'Matchs : <br><br>';
	
		while ($data = mysql_fetch_array($req))
		{
		$date=$data['date'];
		$sql2='SELECT nomclub FROM membre WHERE id="'.$data['iddom'].'"';
		$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$result = mysql_query($sql2);
		$nomclub=mysql_result($result, 0);
		echo 'date : '.$date.'  Adversaire : '.$nomclub.'<a href="validerm.php?id='.$data['idmatch'].'">Valider</a><br> ';
		
		}
	
	}

		echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
		echo '<input type="submit" name="retour" value="Retour">';
	 
		echo '</FORM>';	
	  
	  
?>	  