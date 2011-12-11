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

$idmatch=$_GET['id'];

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
	  
	$sql='SELECT valide,idext FROM espacem.match WHERE idmatch="'.$idmatch.'"';
		
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);
	
	if ($nb == 0)
	{
	echo 'Ce match n\'existe pas';
	echo '<title> Match Inexistant </title>';
	}
	else 
	{
		
	
		$data = mysql_fetch_array($req);
		
			if($_SESSION['id']==$data['idext'])
			{
				if($data['valide']==1)
				{
				echo 'Ce match a déjà été validé !';
				echo '<title> Match déja validé ! </title>';
				}
				else
				{
				$sql2='UPDATE espacem.match SET valide="1" WHERE idmatch="'.$idmatch.'"';
				mysql_query($sql2) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				
				echo "le match a été validé !";
				echo '<title> Match Validé ! </title>';
				
				
				}
			}
			else
			{
			echo '<title> Match Validé ! </title>';
			echo 'Vous n\'etes pas concerné par ce match';
			}
		
	}
	  
	  
?>	  