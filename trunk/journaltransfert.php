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
	  
echo '<title>Journal des transferts</title>';



$sql = 'SELECT * FROM espacem.transfert WHERE accepte="1"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

while ($data = mysql_fetch_array($req))
		{
		
		$sql2 = 'SELECT * FROM espacem.joueur WHERE idjoueur="'.$data['idjoueur'].'"';
		$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
		$data2 = mysql_fetch_array($req2);
		
		echo $data2['prenom'].'  '.$data2['nom'];
		echo '   '.$data['montant'];
		echo '<br>';
	
		
		}
	  
?>	  