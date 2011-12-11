<?php

		include_once('fonctions.php');
		$connexion = new Fonctions;
		$connexion->connexion();
	  
		$idj=$_POST['idj'];
		$idcdf=$_POST['idcdf'];
		
		$sql = 'SELECT nom FROM juniors WHERE id="'.$idj.'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

		$nb = mysql_num_rows($req);
	
		if ($nb == 0) 
		{
		echo 'Ce junior n\'existe pas !';
		}
		else
		{
		
			$sql = 'DELETE FROM juniors where id="'.$idj.'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		 
			echo 'le joueur à été renvoyé !';
	
		
		}
	
	
echo '<FORM METHOD="POST"  ACTION="cdf.php?id='.$idcdf.'"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		


?>