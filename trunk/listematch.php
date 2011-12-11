<?php
session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}
?>

<html>
<head>
<title>Liste des matchs</title>
</head>

<body>
<a href="membre.php">Retour à l'accueil</a><br /><br />
<?php

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();


	$sql = 'SELECT date,idext,scoredom,scoreext,iddom,idmatch,fini FROM espacem.match WHERE (iddom="'.$_SESSION['id'].'" OR idext="'.$_SESSION['id'].'") AND valide="1" ORDER BY date';

	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);

	if ($nb == 0) {
		echo 'Aucun Match';
	}
	else {

		while ($data = mysql_fetch_array($req))
		{
		$idmatch=$data['idmatch'];
		$fini=$data['fini'];
		
		$sql2 = 'SELECT nomclub FROM espacem.membre WHERE id="'.$data['iddom'].'"';

		$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
		$nb2 = mysql_num_rows($req2);
		$data2 = mysql_fetch_array($req2);
		
		if($nb2==0)
		$nomdom='Aucun club';
		else
		$nomdom=$data2['nomclub'];
		
		$sql3 = 'SELECT nomclub FROM espacem.membre WHERE id="'.$data['idext'].'"';

		$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
		$nb3 = mysql_num_rows($req3);
		$data3 = mysql_fetch_array($req3);
		
		if($nb3==0)
		$nomext='Aucun club';
		else
		$nomext=$data3['nomclub'];
		if($fini)
		$match=$data['date'].'       '.$nomdom.'-'.$nomext.'  '.$data['scoredom'].'-'.$data['scoreext'].'<br>';
		else
		$match=$data['date'].'       '.$nomdom.'-'.$nomext.'  - <br>';
		echo '<a href="match.php?id=' ,$idmatch.'">'.$match.'</a>';
		
		
		}
		
	}
	



?>
<br /><br /><a href="deconnexion.php">Déconnexion</a>
</body>
</html>