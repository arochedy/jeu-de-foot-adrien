<?php
session_start();
// on v�rifie toujours qu'il s'agit d'un membre qui est connect�

if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

// on teste si l'id du message a bien �t� fourni en argument au script envoyer.php
if (!isset($_GET['id_message']) || empty($_GET['id_message'])) {
	header ('Location: membre.php');
	exit();
}
else {
	$base = mysql_connect ('localhost', 'root', '');
		mysql_select_db ('espacem', $base);

	// on pr�pare une requ�te SQL permettant de supprimer le message tout en v�rifiant qu'il appartient bien au membre qui essaye de le supprimer
	$sql = 'DELETE FROM messages WHERE id_destinataire="'.$_SESSION['id'].'" AND id="'.$_GET['id_message'].'"';
	// on lance cette requ�te SQL
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	

	header ('Location: membre.php');
	exit();
}
?>