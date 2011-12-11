<?php


session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login']))
 {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

$idj=$_GET['id'];
$coef=50;



include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	

$sql = 'SELECT nom,prenom,idclub,PE,poste FROM joueur WHERE idjoueur="'.$idj.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$nb = mysql_num_rows($req);

if ($nb == 0) 
{
	echo 'Ce joueur n\'existe pas.';
}
else 
{
	
	
	$data = mysql_fetch_array($req);
	if ($data['idclub']==$_SESSION['id'])
	{
		echo '<br>';
		$joueur=substr($data['prenom'],0,1).'.'.$data['nom'];
		echo $joueur.'<br>';
		$idclub=$data['idclub'];
		echo 'PE : '.$data['PE'].'<br>';
		$valeurpe=$data['PE'];
		echo '['.$data['poste'].']';

		echo '<br>';
		echo'<title>'.$joueur.'</title>'; 

		$sql = 'SELECT gardien,endurance,defense,attaque FROM joueur WHERE idjoueur="'.$idj.'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


			echo 	'<table>';
			echo 	 '<tr>';
			echo 	'<th>Caracteristique</th>';
			echo 	'<th>Valeur</th>';
			echo  	'<th>Pe necessaires</th>';
			echo  	'<th></th>';
			echo	'</tr>';

		$data = mysql_fetch_array($req);
		
			echo '<br>';
			echo '<tr>';
				echo '<td>Endurance   </td>';
				echo '<td>'.$data['endurance'].'</td>';
					$pe=$data['endurance']*$coef;
				echo '<td>'.$pe.'</td>';
				
				if($valeurpe>=$pe)
				{
				echo '<td>';
				echo '<FORM METHOD="POST"  ACTION="augmenter.php"> ';
				echo '<input type="hidden" name="idj" value="'.$idj.'">';
				echo '<input type="hidden" name="capacite" value="endurance">';
				echo '<input type="hidden" name="valeur" value="'.$data['endurance'].'">';
				echo '<input type="hidden" name="pe" value="'.$pe.'">';
				echo '<input type="hidden" name="valeurpe" value="'.$valeurpe.'">';
				
				echo '<input type="submit" name="augmenter" value="+">';
				echo '</FORM>';
				}
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Gardien   </td>';
				echo '<td>'.$data['gardien'].'</td>';
					$pe=$data['gardien']*$coef;
				echo '<td>'.$pe.'</td>';
				if($valeurpe>=$pe)
				{
				echo '<td>';
				echo '<FORM METHOD="POST"  ACTION="augmenter.php"> ';
				echo '<input type="hidden" name="idj" value="'.$idj.'">';
				echo '<input type="hidden" name="capacite" value="gardien">';
				echo '<input type="hidden" name="valeur" value="'.$data['gardien'].'">';
				echo '<input type="hidden" name="pe" value="'.$pe.'">';
				echo '<input type="hidden" name="valeurpe" value="'.$valeurpe.'">';
				echo '<input type="submit" name="augmenter" value="+">';
				echo '</FORM>';
				echo '</td>';
				}
			echo '</tr>';
			echo '<tr>';
				echo '<td>Defense   </td>';
				echo '<td>'.$data['defense'].'</td>';
					$pe=$data['defense']*$coef;
				echo '<td>'.$pe.'</td>';
				if($valeurpe>=$pe)
				{
				echo '<td>';
				echo '<FORM METHOD="POST"  ACTION="augmenter.php"> ';
				echo '<input type="hidden" name="idj" value="'.$idj.'">';
				echo '<input type="hidden" name="capacite" value="defense">';
				echo '<input type="hidden" name="pe" value="'.$pe.'">';
				echo '<input type="hidden" name="valeur" value="'.$data['defense'].'">';
				echo '<input type="hidden" name="valeurpe" value="'.$valeurpe.'">';
				echo '<input type="submit" name="augmenter" value="+">';
				echo '</FORM>';
				echo '</td>';
				}
			echo '</tr>';
			echo '<tr>';
				echo '<td>Attaque   </td>';
				echo '<td>'.$data['attaque'].'</td>';
					$pe=$data['attaque']*$coef;
				echo '<td>'.$pe.'</td>';
				if($valeurpe>=$pe)
				{
				echo '<td>';
				echo '<FORM METHOD="POST"  ACTION="augmenter.php"> ';
				echo '<input type="hidden" name="idj" value="'.$idj.'">';
				echo '<input type="hidden" name="capacite" value="attaque">';
				echo '<input type="hidden" name="valeur" value="'.$data['attaque'].'">';
				echo '<input type="hidden" name="pe" value="'.$pe.'">';
				echo '<input type="hidden" name="valeurpe" value="'.$valeurpe.'">';
				echo '<input type="submit" name="augmenter" value="+">';
				echo '</FORM>';
				echo '</td>';
				}
			echo '</tr>';
		echo '</table>';	
		
		echo '<br>';
			
		
	}
	else
	echo 'Ce joueur ne fait pas partie de votre club ';
}	
	
echo '<FORM METHOD="POST"  ACTION="entrainer.php?id='.$_SESSION['id'].'"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		
		
		
		
?>		