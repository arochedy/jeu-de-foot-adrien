<?php
session_start();
// on v�rifie toujours qu'il s'agit d'un membre qui est connect�
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}
?>

<html>
<head>
<title>Espace membre</title>
</head>

<body>
<a href="membre.php">Retour � l'accueil</a><br /><br />
<?php
// on teste si notre param�tre existe bien et qu'il n'est pas vide
if (!isset($_GET['id_message']) || empty($_GET['id_message'])) {
	echo 'Aucun message reconnu.';
}
else {
	$base = mysql_connect ('localhost', 'root', '');
		mysql_select_db ('espacem', $base);

	// on pr�pare une requete SQL selectionnant la date, le titre et l'expediteur du message que l'on souhaite lire, tout en prenant soin de v�rifier que le message appartient bien au membre connect�
	$sql = 'SELECT titre, date, message, membre.login as expediteur FROM messages, membre WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=membre.id AND messages.id="'.$_GET['id_message'].'"';
	// on lance cette requete SQL � MySQL
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);

	if ($nb == 0) {
		echo 'Aucun message reconnu.';
	}
	else {
		// si le message a �t� trouv�, on l'affiche
		$data = mysql_fetch_array($req);
		echo $data['date'] , ' - ' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message de ' , stripslashes(htmlentities(trim($data['expediteur']))) , ' ]<br /><br />';
		echo nl2br(stripslashes(htmlentities(trim($data['message']))));

		// on affiche �galement un lien permettant de supprimer ce message de la boite de r�ception
		echo '<br /><br /><a href="supprimer.php?id_message=' , $_GET['id_message'] , '">Supprimer ce message</a>';
	}

}
?>
<br /><br /><a href="deconnexion.php">D�connexion</a>
</body>
</html>