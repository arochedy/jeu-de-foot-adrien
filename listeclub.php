<?php

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
echo '<title>Liste des clubs</title>';



$sql = 'SELECT * FROM espacem.membre where id!="7"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

while ($data = mysql_fetch_array($req))
		{
		
		echo '<a href="club.php?id='.$data['id'].'">'.$data['nomclub'].'</a><br>';
		
		}
	  
?>	  