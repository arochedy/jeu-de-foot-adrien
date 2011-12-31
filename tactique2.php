<?php

session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

echo '<title>Tactique</title>';
include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
	  
/*if(isset($POST['idtactique']))
$tactique=$POST['idtactique'];*/

	
	$sql = 'SELECT numero as num, idtactique FROM tactiqueclub WHERE idclub="'.$_SESSION['id'].'" AND aligne=1';
	echo $sql;
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	while ($data = mysql_fetch_array($req))
	{
	
	$numero=$data['num'];
	$idtactique=$data['idtactique'];
	}
	echo '</br>';
	echo $idtactique; 
	echo '</br>';
	
	
if(isset($_GET['id']))
$tactique=$_GET['id'];	
else
$tactique=$numero;

	if(isset($_POST['action']))
	{
		$action=$_POST['action'];
		$idj=$_POST['idj'];


		if($action=='ajouter')
		{
			$sql = 'INSERT INTO tactiquejoueur VALUES ("","'.$idtactique.'","'.$idj.'")';
			$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
			echo $sql;
			echo '<br>';
		

		}
		else if($action=='enlever')
		{
			echo 'enlever <br>';
			$sql = 'DELETE FROM tactiquejoueur WHERE idjoueur="'.$idj.'"';
			$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
			echo $sql;
			echo '<br>';

		}
	}

	echo 'Tactique en place : '.$numero;
	echo '</br>';
	
	echo '<FORM METHOD="POST"  ACTION="alignertactique.php"> ';
				echo '<input type="hidden" name="aligner" value="1">';
				echo '<input type="hidden" name="idtactique" value="'.$idtactique.'">';
				echo '<input type="submit" name="aligner" value="aligner"><br>';
		echo '</FORM>';
	
	echo 'Tactique 1 : <a href="tactique2.php?id=1">toto</a>';
	echo 'bite';
	
	
	 //Affichage de la liste des joueurs non titulaire sur cette tactique
	
	echo '<div id=tactique style="position:relative;float:left;">';
	echo 'Listes des joueurs  <br>';
		//selectionne tous les joueurs de la tactique
		$sql = 'SELECT idjoueur as idj
				FROM tactiquejoueur t, tactiqueclub c
				WHERE c.idtactique = t.idtactique 
				AND c.idtactique="'.$idtactique.'"
				AND idclub="'.$_SESSION['id'].'";';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$nb =mysql_num_rows($req);
		
	
		
		$sql='SELECT * FROM joueur WHERE idclub="'.$_SESSION['id'].'"';
		if ($nb == 0)
		{
			//echo 'Vous n\'avez aucun Joueurs. <br>';
			
		}
		else 
		{
			while ($data = mysql_fetch_array($req))
			{	//suprime les joueurs dejà presents dans la tactique
				$sql=$sql.'AND idjoueur !="'.$data['idj'].'"';
			}	
		}	

		//affiche tous les joueurs non present dans la tactique
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$nb =mysql_num_rows($req);
		if ($nb == 0)
		{
			echo 'Vous n\'avez aucun Joueur. <br>';
		}
		else 
		{
			
			while ($data = mysql_fetch_array($req))
			{
				$joueur=substr($data['prenom'],0,1).'.'.$data['nom'];
				$idj=$data['idjoueur'];
			
				echo $joueur;     
				echo '['.$data['poste'].']';
				echo '<br>';
				
						
				
					echo '<FORM METHOD="POST"  ACTION="tactique2.php"> ';
					echo '<input type="hidden" name="idj" value="'.$idj.'">';
					echo '<input type="hidden" name="action" value="ajouter">';
					echo '<input type="hidden" name="idtactique" value="'.$idtactique.'">';
					echo '<input type="submit" name="ajouter" value="ajouter"><br>';
					echo '</FORM>';
				
					
				
			}
			echo '<br>';
		}
		
				
	echo'</div>';		
		
	// Affichage de tous les joueurs dans la tactique
			
	echo '<div id=tactique style="position:relative">';	
	echo 'liste de vos joueurs dasn la tactique </br>';
		$sql = 'SELECT idjoueur as idj
				FROM tactiquejoueur t, tactiqueclub c
				WHERE c.idtactique = t.idtactique 
				AND c.idtactique="'.$idtactique.'"
				AND idclub="'.$_SESSION['id'].'";';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);
	
	
	$sql='SELECT *, idjoueur as idj FROM joueur WHERE idjoueur IS NULL ';
		if ($nb == 0)
		{
			//echo 'Vous n\'avez aucun Joueurs. <br>';
			
		}
		else 
		{
			while ($data = mysql_fetch_array($req))
			{	//suprime les joueurs dejà presents dans la tactique
				$sql=$sql.'OR idjoueur ="'.$data['idj'].'"';
			}	
		}	
	
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);
	if ($nb == 0)
	{
		echo 'Vous n\'avez aucun Joueurs. </br>';
	}
	else 
	{
		// si on a des joueurs
		echo 'Joueurs : <br>';
		
			
		while ($data = mysql_fetch_array($req))
		{
			$idj=$data['idj'];
			
			$joueur=substr($data['prenom'],0,1).'.'.$data['nom'];
	
			echo $joueur;     
			echo ' ['.$data['poste'].']<br>';
			
			
		
			echo '<FORM METHOD="POST"  ACTION="tactique2.php"> ';
			echo '<input type="hidden" name="idj" value="'.$idj.'">';
			echo '<input type="hidden" name="action" value="enlever">';
			echo '<input type="submit" name="enlever" value="enlever"><br>';
			echo '</FORM>';
			
			
			
		}
	
		echo '<br>';
	}  
	
			
	echo'</div>';		
	
	
	
/*			
	$idj="";
	if(isset($_POST['action']))
	{
		$action=$_POST['action'];
		if(isset($_POST['idj']))
			$idj=$_POST['idj'];
		if($action=="ajouter")
		{
		$sql = 'UPDATE joueur SET  titulaire="1" WHERE idjoueur ="'.$idj.'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		} 
		if ($action=="enlever")
		{
		$sql = 'UPDATE joueur SET  titulaire="0" WHERE idjoueur ="'.$idj.'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		}
	}
	
		$sql = 'SELECT idjoueur as idj FROM joueur WHERE idclub="'.$_SESSION['id'].'" AND titulaire="1"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

		$nbtitu = mysql_num_rows($req);
	
		echo 'Nombre de joueurs titulaires : '.$nbtitu.'/11<br><br>';
	  
		//verification nombre de joeurs aux bons postes !
		$sql = 'SELECT idjoueur as idj FROM joueur WHERE idclub="'.$_SESSION['id'].'" AND poste="GAC" AND titulaire="1"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

		$nbgac = mysql_num_rows($req);
		
		$sql = 'SELECT idjoueur as idj FROM joueur WHERE idclub="'.$_SESSION['id'].'" AND poste="DFD" AND titulaire="1"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

		$nbdfd = mysql_num_rows($req);
	
		$sql = 'SELECT idjoueur as idj FROM joueur WHERE idclub="'.$_SESSION['id'].'" AND poste="DFG" AND titulaire="1"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$nbdfg = mysql_num_rows($req);
		
		$sql = 'SELECT idjoueur as idj FROM joueur WHERE idclub="'.$_SESSION['id'].'" AND poste="DFC" AND titulaire="1"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$nbdfc = mysql_num_rows($req);
		
		$sql = 'SELECT idjoueur as idj FROM joueur WHERE idclub="'.$_SESSION['id'].'" AND poste="MDC" AND titulaire="1"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$nbmdc = mysql_num_rows($req);
		
	if($nbgac==0)
		echo "Attention vous n'avez pas de gardien titulaire !<br><br>";
	  
	
	
	
	
	
 
echo '</FORM>';		
	echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';
	  */
?>