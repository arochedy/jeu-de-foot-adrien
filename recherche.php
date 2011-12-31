 <?php
 
 
 session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}


	   include_once('fonctions.php');
	  $affichage = new Fonctions;
	  $affichage->menu(FALSE);
	  include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
		 
	echo'
<form action="resultatr.php" method="post">


Nom<input type="checkbox" name="joueur[]" value="nom" />
<input type="text" name="nom" id="pseudo" /><br />

 Age<input type="checkbox" name="joueur[]" value="age" />
<input type="text" name="agemin" id="pseudo" size="2" maxlength="2"/>
<input type="text" name="agemax" id="pseudo" size="2" maxlength="2"/><br />

Talent <input type="checkbox" name="joueur[]" value="talent" /><br />
Attaque  <input type="checkbox" name="joueur[]" value="attaque" /><br />
<input type="submit" />


</form>';
	
   
 
		 
		  
// on prépare une requete SQL cherchant tous les titres, les dates ainsi que l'auteur des messages pour le membre connecté
$sql = 'SELECT titre,lu, date,id_expediteur, membre.login as expediteur, messages.id as id_message FROM messages, membre WHERE id_destinataire="'.$_SESSION['id'].'" AND id_expediteur=membre.id AND lu="0" ORDER BY date DESC';
// lancement de la requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows($req);

if ($nb == 0) {
	echo 'Vous n\'avez aucun nouveau message.';
}
else {


}

?>