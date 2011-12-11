<?php

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
	  

$idcdf=$_POST['idcdf'];
$idc=$_POST['idc'];
$idj=$_POST['idj'];
$duree=$_POST['duree'];
if($duree>30)//Pour eviter de laisser traienr le junior 1 an et avoir un joueur trop fort !
	$duree=30;

$niveau=$_POST['niveau'];

		$sql = 'SELECT id,nom,prenom,age,poste FROM juniors WHERE id="'.$idj.'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		
		$nb = mysql_num_rows($req);
		
		if ($nb == 0) 
		{
			echo 'Aucun junior';
		}
		else
		{
			$data = mysql_fetch_array($req);
			$nomc=$data['nom'];
			$prenomc=$data['prenom'];
			$taille=rand(160,205);
			$age=$data['age'];
			$poste=$data['poste'];
			
			$plus=rand(0,1);//sert pour savoir si on ajoute un nb aleatoir au talent ou si on l'enleve !
			if($plus==1)
				$talent=$niveau*10*$duree/30+rand(0,5);//ajouter le niveau du formateur dans la formule !
			else
				$talent=$niveau*10*$duree/30-rand(0,5); 
			
			if($talent<1)
				$talent=1;
			
			if($talent>100)
				$talent=100;
			
			$pe=1;//a modifier quand je voudrais mettre des pe qui dependent de la durée de formation etc ...
			
			//on supprime le junior !
			$sql = 'DELETE FROM juniors where id="'.$idj.'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
			
			//et on crée le joueur !
		$sql = 'INSERT INTO espacem.joueur VALUES("","'.$idc.'","'.$nomc.'","'.$prenomc.'","'.$taille.'","'.$age.'","'.$poste.'","'.$talent.'","'.$pe.'","1","1","1","1","0","99")';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		
		echo "le Joueur a été promu dans l'effectif pro !";
		
		$sql = 'SELECT idjoueur FROM joueur WHERE idclub="'.$idc.'" and nom="'.$nomc.'" and prenom="'.$prenomc.'" and taille="'.$taille.'" and PE="'.$pe.'" and talent="'.$talent.'" and physique="99" and attaque="1" and defense="1" and poste="'.$poste.'" and gardien="1" ' ;
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$data = mysql_fetch_array($req);
		
		$id=$data['idjoueur'];
		
		echo '<FORM METHOD="POST"  ACTION="joueur.php?id='.$id.'"> ';
		echo '<input type="submit" name="voir" value="Voir">';
		echo '</FORM>';	
		}	
		
		echo '<FORM METHOD="POST"  ACTION="cdf.php?id='.$idcdf.'"> ';
		echo '<input type="submit" name="retour" value="Retour">';
		echo '</FORM>';	
		
		

?>