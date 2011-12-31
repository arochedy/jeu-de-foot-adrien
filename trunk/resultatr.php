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
			 

	 // On assigne notre variable $_POST['annonce_id']

	if (!isset($_POST['joueur']))
	{
	echo 'Choisissez au moins un critere ! '; 
	}
	else
	{
		$nombre=$_POST['joueur'];
		
		$agemin = htmlspecialchars($_POST['agemin']);
		$agemax = htmlspecialchars($_POST['agemax']);

		$erreur=false;

		/* On invoque une variable qui comptera le nombre de checkbox choisis
		gâce à la fonction count() */
		$total=count($nombre);

		if($nombre==0)
		{
			echo 'Choisissez au moins un critere ! '; 
		}
		else
		{
			$sql='SELECT * FROM joueur WHERE idjoueur IS NOT NULL';

			echo "Vous avez sélectionné <b>".$total."</b> critère(s)";
			/* Pour faire bien on va faire une chtit boucle pour prendre les valeurs */
			for($i=0;$i<$total;$i++)
			{
		   
				
				echo '<br>';
				
				// Cas de l'age
				if($nombre[$i]=='age' AND is_numeric($agemin) AND is_numeric($agemax) AND $agemin <= $agemax)
				{	
						$sql=$sql.' AND age BETWEEN '.$agemin.' AND '.$agemax;
						
				} 
				else if(!is_numeric($agemin) OR !is_numeric($agemax))
				{
					echo 'Entrez un nombre dans agemin et age max (entre 0 et 99) </br>';
					$erreur=true;
				}
				else if($agemin > $agemax)
				{
					echo 'Erreur l\'age maximum est plus petit que l\'age minimum';
					$erreur=true;
				}
				//FIN Cas de l'age
				
				
				
			}	


			
			// lancement de la requete SQL
			$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
			$nb = mysql_num_rows($req);
			
			if ($nb == 0)
			{
				echo 'Aucun joueur ne correspond';
			}
			elseif($nb > 30 and !$erreur)
			{
				echo 'Recentrez votre recherche il y a trop de résultats ('.$nb.' résultats)';
			}
			elseif($erreur)
			{
				
			}
			else 
			{
				while ($data = mysql_fetch_array($req)){
				
				echo $data['nom'].'</br>';
				
				}


			}
		}
	}	

?>