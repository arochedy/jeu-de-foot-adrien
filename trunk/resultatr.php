 <?php
 
 
 session_start();
// on v�rifie toujours qu'il s'agit d'un membre qui est connect�
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
		 
 
		 // On assigne notre variable $_POST['annonce_id']
$nombre=$_POST['joueur'];

$agemin = htmlspecialchars($_POST['agemin']);
$agemax = htmlspecialchars($_POST['agemax']);

echo $agemin;

/* On invoque une variable qui comptera le nombre de checkbox choisis
g�ce � la fonction count() */
$total=count($nombre);

$sql='SELECT * FROM joueur WHERE idjoueur IS NOT NULL';

   echo "Vous avez s�lectionn� <b>".$total."</b> crit�re(s)";
   /* Pour faire bien on va faire une chtit boucle pour prendre les valeurs */
   for($i=0;$i<$total;$i++)
   {
	if($nombre[$i]=='age')
		echo 'bite <br>';
		$sql=$sql.' AND age BETWEEN '.$agemin.' AND '.$agemax;
		echo $sql;
      //  echo "<br />",$i+1,"e choix : ".$nombre[$i];
   }



// lancement de la requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows($req);

if ($nb == 0) {
	echo 'Aucun joeuurs ne correspond.';
}
else {
	while ($data = mysql_fetch_array($req)){
	
	echo $data['nom'].'</br>';
	
	}


}

?>