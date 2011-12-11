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
	
	$idj="";
	if(isset($_POST['action']))
	{
		$action=$_POST['action'];
		if(isset($_POST['idj']))
			$idj=$_POST['idj'];
		if($action=="ajouter")
		{
		$sql = 'UPDATE `espacem`.`joueur` SET  titulaire="1" WHERE idjoueur ="'.$idj.'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		} 
		if ($action=="enlever")
		{
		$sql = 'UPDATE `espacem`.`joueur` SET  titulaire="0" WHERE idjoueur ="'.$idj.'"';
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
	  
	$sql = 'SELECT nom,prenom,idjoueur as idj,poste,titulaire FROM joueur WHERE idclub="'.$_SESSION['id'].'" ORDER BY poste ';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	$nb = mysql_num_rows($req);
	
	

	
	if ($nb == 0)
	{
		echo 'Vous n\'avez aucun Joueurs.';
	}
	else 
	{
		// si on a des joueurs
		echo 'Joueurs : <br>';
		
		echo 	'<table>';
	/*	echo 	 '<tr>';
		/*echo 	'<th></th>';
		echo 	'<th></th>';
		echo  	'<th></th>';
		echo  	'<th></th>';
		echo	'</tr>';*/
		
		while ($data = mysql_fetch_array($req))
		{
			$idj=$data['idj'];
			
			$joueur=substr($data['prenom'],0,1).'.'.$data['nom'];
			echo '<tr>';
			echo '<td>'.$joueur.'</td>';     
			echo '<td>['.$data['poste'].']</td>';
			if($data['titulaire']==0 and $nbtitu<11)
			{
				if($data['poste']!='GAC' OR $nbgac==0)
				{			
				echo '<td>';
				echo '<FORM METHOD="POST"  ACTION="tactique.php"> ';
				echo '<input type="hidden" name="idj" value="'.$idj.'">';
				echo '<input type="hidden" name="action" value="ajouter">';
				echo '<input type="submit" name="ajouter" value="ajouter"><br>';
				echo '</FORM>';
				echo '</td>';
				}
			}
			if($data['titulaire']==1)
			{
			echo '<td>';
			echo '<FORM METHOD="POST"  ACTION="tactique.php"> ';
			echo '<input type="hidden" name="idj" value="'.$idj.'">';
			echo '<input type="hidden" name="action" value="enlever">';
			echo '<input type="submit" name="enlever" value="enlever"><br>';
			echo '</FORM>';
			echo '</td>';
			
			}
			echo '</tr>';
		}
		echo '</table>';
		echo '<br>';
	}  
	
	
	
	
	
 
echo '</FORM>';		
	echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';
	  
?>