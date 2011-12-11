<?php

$idj=$_GET['id'];




include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	

$sql = 'SELECT * FROM joueur WHERE idjoueur="'.$idj.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$nb = mysql_num_rows($req);

if ($nb == 0) 
{
	echo 'Ce joueur n\'existe pas.';
}
else 
{
	
	
	while ($data = mysql_fetch_array($req))
	{
		echo '<br>';
		$joueur=$data['prenom'].' '.$data['nom'];
		echo $joueur;
		$idclub=$data['idclub'];
	}
	
	echo'<title>'.$joueur.'</title>'; 

	$sql = 'SELECT * FROM joueur WHERE idjoueur="'.$idj.'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	
		
	while ($data = mysql_fetch_array($req))
	{
		echo '<br>';
		echo $data['poste'].'<br><br>';
		echo 'Talent : '.$data['talent'].'<br><br>';
		echo 'Gardien :'.$data['gardien'].'<br>';
		echo 'Defense :'.$data['defense'].'<br>';
		echo 'Attaque :'.$data['attaque'].'<br><br>';
		
		echo 'Endurance :'.$data['endurance'].'<br>';
	}
	echo '<br>';
			
	session_start();
	// on vérifie toujours qu'il s'agit d'un membre qui est connecté
	if (isset($_SESSION['login']))
	{
	
	
		if($idclub==7)
		{	echo 'Aucun club <br><br>';
			echo '<FORM METHOD="POST"  ACTION="recruterl.php"> ';
			echo '<input type="hidden" name="idjoueur" value='.$idj.'>';
			echo '<input type="submit" name="recruterl" value="Recruter">';
 
			echo '</FORM>';	
	
	
		}
		else
		{
			$sql = 'SELECT nomclub FROM membre WHERE id="'.$idclub.'"';
			$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
			$data = mysql_fetch_array($req);
			
			echo 'Club : ' ;
			echo '<a href="club.php?id='.$idclub.'">'.$data['nomclub'].'</a>';
			
			if($idclub==$_SESSION['id'])
			{
			echo '<FORM METHOD="POST"  ACTION="liberer.php"> ';
			echo '<input type="hidden" name="idjoueur" value='.$idj.'>';
			echo '<input type="submit" name="liberer" value="Liberer">';
 
			echo '</FORM>';	
			}
			else
			{
			echo '<FORM METHOD="POST"  ACTION="acheter.php"> ';
			echo '<input type="hidden" name="idjoueur" value='.$idj.'>';
			echo '<input type="hidden" name="idclub" value='.$idclub.'>';
			echo '<input type="submit" name="acheter" value="Ouvrir des negociations">';
 
			echo '</FORM>';	
			
			
			}
		}	
	}
	
	
	
	if($idclub!=7)
	{	
		echo '<FORM METHOD="POST"  ACTION="club.php?id='.$idclub.'"> ';
		echo '<input type="submit" name="retour" value="Retour">';
	 
		echo '</FORM>';	
	}
	else
	{
		echo '<FORM METHOD="POST"  ACTION="libres.php"> ';
		echo '<input type="submit" name="retour" value="Retour">';
	 
		echo '</FORM>';	
	}
	
}		
		
		
?>		
