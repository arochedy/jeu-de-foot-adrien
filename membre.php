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
include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();

// on prépare une requete SQL cherchant tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
$sql = 'SELECT titre,lu, date,id_expediteur, membre.login as expediteur, messages.id as id_message FROM messages, membre WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=membre.id AND lu="0" ORDER BY date DESC';
// lancement de la requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows($req);

if ($nb == 0) {
	echo 'Vous n\'avez aucun nouveau message.';
}
else {
	// si on a des messages, on affiche la date, un lien vers la page lire.php ainsi que le titre et l'auteur du message
	if($nb==1)
		echo 'Message : <br><br>';
	else
		echo 'Messages : <br><br>';
	
		while ($data = mysql_fetch_array($req))
		{
			if($data['lu']==1)
			{
			if($data['id_expediteur']!=7)
			echo $data['date'] , ' - <a href="lire.php?id_message=' , $data['id_message'] , '">' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message de ' , stripslashes(htmlentities(trim($data['expediteur']))) , ' ]<br />';
			else
			echo $data['date'] , ' - <a href="lire.php?id_message=' , $data['id_message'] , '">' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message officiel ]<br />';
			}
			else
			{
			if($data['id_expediteur']!=7)
			echo '<b>'.$data['date'] , ' - <a href="lire.php?id_message=' , $data['id_message'] , '">' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message de ' , stripslashes(htmlentities(trim($data['expediteur']))) , ' ]</b><br />';
			else
			echo '<b>'.$data['date'] , ' - <a href="lire.php?id_message=' , $data['id_message'] , '">' , stripslashes(htmlentities(trim($data['titre']))) , '</a> [ Message officiel ]</b><br />';
			
			}
			
		}
	
}

?>
<br />
<br/>
<FORM METHOD="POST"  ACTION="envoyer.php"> 
<input type="submit" name="envoyer" value="Envoyer un message">

</FORM>

<?php

$sql = 'SELECT argent FROM membre WHERE id="'.$_SESSION['id'].'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$data = mysql_fetch_array($req);

setlocale(LC_MONETARY, 'fr_FR');
$argent=number_format($data['argent'], 0, ',', ' ');
echo 'Argent : '.$argent.' € <br>';

//////////// Affichage du nombre de joueurs
$sql = 'SELECT nom,prenom,idjoueur as idj,poste FROM joueur WHERE idclub="'.$_SESSION['id'].'" ORDER BY poste';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows($req);

if ($nb == 0) {
	echo 'Vous n\'avez aucun Joueurs.';
}
else {
	// si on a des joueurs
	echo 'Nombre de joueurs : '.$nb.'/32 <br> ';
	
}
//FIN
	echo '<br>';

echo '<FORM METHOD="POST"  ACTION="entrainer.php"> ';
echo '<input type="submit" name="entrainer" value="Entrainer">';
 
echo '</FORM>';

echo '<a href="mesjoueurs.php?id='.$_SESSION['id'].'&ordre=0" >Mes joueurs</a><br>';
echo '<a href="libres.php" >Joueurs libres</a><br>';
echo '<a href="messages.php" >Messages</a><br>';
echo '<a href="mesinfra.php" >Infrastructures</a><br>';
echo '<a href="modifcompte.php">Modifier mon compte</a><br>';
echo '<a href="organiser.php">Organiser</a><br>';
echo '<a href="listematch.php" >Matchs</a><br>';
echo '<a href="tactique.php" >Tactique</a><br>';
echo '<a href="listeclub.php" >Clubs</a><br>';

if($_SESSION['id']==7 OR $_SESSION['id']==6)
{
echo '<b>Administration</b><br>';

echo '<a href="aleatoire.php" >Créer des joueurs</a><br>';
echo '<a href="jouermatch.php" >Jouer les matchs</a><br>';
}
?>

<br /><br />

<FORM METHOD="POST"  ACTION="deconnexion.php"> 

<INPUT border=0 src="img/fermer.gif" type=image Value=submit align="middle" > 
</FORM>

</body>
</html>