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
<title>Espace membre</title>
</head>

<body>
Bienvenue  <?php echo stripslashes(htmlentities(trim($_SESSION['login']))); ?>!<br /><br />
<?php
$base = mysql_connect ('localhost', 'root', '');
		mysql_select_db ('espacem', $base);

// on prépare une requete SQL cherchant tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
$sql = 'SELECT titre, date, membre.login as expediteur, messages.id as id_message FROM messages, membre WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=membre.id ORDER BY date DESC';
// lancement de la requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows($req);

if ($nb == 0) {
	echo 'Vous n\'avez aucun message.';
}
else {
	// si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
	echo 'message(s)';
	while ($data = mysql_fetch_array($req)) {
		echo $data['date'] , ' - <a href="lire.php?id_message=' , $data['id_message'] , '">' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message de ' , stripslashes(htmlentities(trim($data['expediteur']))) , ' ]<br />';
	}
}

?>
<br />
<br/>
<FORM METHOD="POST"  ACTION="envoyer.php"> 
<input type="submit" name="envoyer" value="Envoyer un message">

</FORM>

<br /><br />

<FORM METHOD="POST"  ACTION="deconnexion.php"> 

<INPUT border=0 src="img/fermer.gif" type=image Value=submit align="middle" > 
</FORM>

</body>
</html>