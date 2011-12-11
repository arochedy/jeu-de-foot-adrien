<?php

$idcdf=$_GET['id'];


include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	
	
	echo 'Centre de formation: <br><br>' ;
	
	$sql = 'SELECT idclub,niveau FROM cdf WHERE idcdf="'.$idcdf.'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	
	$nb = mysql_num_rows($req);
	
	
	if ($nb == 0) 
	{
		echo 'Pas construit';
		$idc=7;
	}
	else
	{
		while ($data = mysql_fetch_array($req))
		{	
			$idc=$data['idclub'];
			$niveau=$data['niveau'];
			echo 'Niveau: '.$data['niveau'].'<br>';
			
	
		
		}
	}
	echo '<br>';
			
	session_start();
	
	if ($_SESSION['id']==$idc)
	{
		echo "Liste des juniors : <br>";
		
		$sql = 'SELECT id,nom,prenom,age,date,poste FROM juniors WHERE idclub="'.$idc.'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		
		$nb = mysql_num_rows($req);
		
		if ($nb == 0) 
		{
			echo 'Aucun junior';
		}
		else
		{
			while ($data = mysql_fetch_array($req))
			{	
			
			$date=$data['date'];
			$t1=mktime(0,0,0);
			$y2=substr($date,0,4);
			$m2=substr($date,5,2);
			$d2=substr($date,8,2);
			$t2=mktime(0,0,0,$m2,$d2,$y2);
			$idj=$data['id'];
			$poste=$data['poste'];
			
			 $duree=($t1-$t2)/(24*3600);
				
			echo 'Nom : '.$data['nom'].'  '.$data['prenom'].'  '.$poste.'  '.$d2.'-'.$m2.'  durée de formation : '.$duree.'<br>';
				
			echo '<FORM METHOD="POST"  ACTION="virerj.php"> ';
			echo '<input type="hidden" name="idj" value="'.$idj.'">';
			echo '<input type="hidden" name="idcdf" value="'.$idcdf.'">';
			echo '<input type="submit" name="virerj" value="Virer">';
		 
			echo '</FORM>';	
			
			echo '<FORM METHOD="POST"  ACTION="promouvoirj.php"> ';
			echo '<input type="hidden" name="idcdf" value="'.$idcdf.'">';
			echo '<input type="hidden" name="idj" value="'.$idj.'">';
			echo '<input type="hidden" name="duree" value="'.$duree.'">';
			echo '<input type="hidden" name="niveau" value="'.$niveau.'">';
			echo '<input type="hidden" name="idc" value="'.$_SESSION['id'].'">';
			echo '<input type="submit" name="promouvoirj" value="Promouvoir dans l\'effectif pro">';
		 
			echo '</FORM>';	
				
		
			
			}
	
		}
			echo '<FORM METHOD="POST"  ACTION="recruterj.php"> ';
			echo '<input type="hidden" name="idcdf" value="'.$idcdf.'">';
			echo '<input type="hidden" name="nbj" value="'.$nb.'">';
			echo '<input type="hidden" name="idc" value="'.$_SESSION['id'].'">';
			echo '<input type="submit" name="recruterj" value="Recruter">';
		 
			echo '</FORM>';	
	}
	
	echo '<FORM METHOD="POST"  ACTION="acdf.php"> ';
	echo '<input type="submit" name="augmentercdf" value="Ameliorer">';
 
	echo '</FORM>';		
	
	
	
echo '<FORM METHOD="POST"  ACTION="infra.php?id='.$idc.'"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		
	
	?>	