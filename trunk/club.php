<?php

$idc=$_GET['id'];




include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	

$sql = 'SELECT login,nomclub,id,datedecreation as date FROM membre WHERE id="'.$idc.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$nb = mysql_num_rows($req);

if ($nb == 0) 
{
	echo 'Ce club n\'existe pas.';
	echo '<title>Club inexistant </title>';
}
else 
{
	
	
	while ($data = mysql_fetch_array($req))
	{
		if($data['id']==7)
			continue;
		echo '<br>';
		echo '<title>'.$data['nomclub'].'</title>';
		echo 'Pseudo : '.$data['login'];
		
	}
	echo '<br><br>';
	

	$sql = 'SELECT nom,prenom,age,taille,idjoueur as idj,talent,poste,titulaire FROM joueur WHERE idclub="'.$idc.'" ORDER by titulaire DESC ,poste';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$nb = mysql_num_rows($req);
		if($idc!=7)
		echo 'Joueurs du club : <br>';
		
		echo 	'<table>';
	echo 'Nombre de joueurs : '.$nb.'/33 <br> ';
	echo 'Joueurs : ';
		echo 	 '<tr>';
		echo 	'<th>Joueur</th>';
		
		echo 	'<th><a href="mesjoueurs.php?ordre=1">Poste</a></th>';//changer les url !
		echo  	'<th><a href="mesjoueurs.php?ordre=2">Statut</a></th>';
		echo  	'<th><a href="mesjoueurs.php?ordre=3">Taille</a></th>';
		echo  	'<th><a href="mesjoueurs.php?ordre=4">Age</a></th>';
		echo  	'<th><a href="mesjoueurs.php?ordre=5">Talent</a></th>';//Rajouter le physique
		echo  	'<th></th>';
		echo	'</tr>';
		
	while ($data = mysql_fetch_array($req))
	{	$idj=$data['idj'];
		
		
		//echo '<a href="joueur.php?id='.$idj.'">'.$data['prenom'].' '.$data['nom'].'</a> '.$data['poste'].' '.$data['talent'].'<br>';
	
	///////////////////////
	
		
	
		
		echo '<tr>';
		echo '<td>';
		$joueur=substr($data['prenom'],0,1).'.'.$data['nom'];
		echo '<a href="joueur.php?id=' ,$data['idjoueur'].'">'.$joueur.'</a>';
		echo '</td>';
		echo '<td>';
		echo  $data['poste'];
		echo '</td>';
		echo '<td>';
		echo  $data['titulaire'];
		echo '</td>';
		echo '<td>';
		echo  $data['taille'];
		echo '</td>';
		echo '<td>';
		echo  $data['age'];
		echo '</td>';
		echo '<td>';
		echo  $data['talent'];
		echo '</td>';
		/*echo '<td>';
		echo  $data['titulaire']; //Remplacer par physique
		echo '</td>';*/
		echo '</tr>';
	}
	echo 	'</table>';
	echo '<br>';
	/////////////////////////////////////////////////////////////
		
	
	echo '<br>';
			
	session_start();
	// on vérifie toujours qu'il s'agit d'un membre qui est connecté
	if (isset($_SESSION['login']))
	{
	
	}
	
	
}

echo '<a href="infra.php?id='.$idc.'" >Infrastructures du club</a><br>';	
	echo '<a href="collectif.php?id='.$idc.'" >Collectif</a><br>';	
echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		
		
		
		
?>		
