<?php

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
for($i=0;$i<5;$i++)
{
	$numposte=1;
	while($numposte%2!=0)
	{
		$numposte=rand(0,16);

	}

	$numposte/=2;
	
	$poste="";
	switch($numposte)
	{
	case 0:
	$poste='GAC';
	break;
	case 1:
	$poste='DFC';
	break;
	case 2:
	$poste='DFD';
	break;
	case 3:
	$poste='DFG';
	break;
	case 4:
	$poste='MDC';
	break;
	case 5:
	$poste='MOC';
	break;
	case 6:
	$poste='MOD';
	break;
	case 7:
	$poste='MOG';
	break;
	case 8:
	$poste='ATC';
	break;

	default:
	echo "Probléme !";
	break;
	}

	$age=rand(17,35);
	$taille=rand(160,205);
	$talent=rand(5,27);
	$gardien=rand(1,20);
	$defense=rand(1,20);
	$attaque=rand(1,20);
	$endurance=rand(1,20);
	
	$id_file=fopen('prenom.txt','r');
	$prenom=rand(1,50);
	$j=1;

	while($ligne=fgets($id_file,300) )
	{
	if($j==$prenom)
	{
	
	$prenomc=$ligne;
	}
	$j++;
	}
	fclose($id_file);
	
	$nom=rand(1,50);
	$j=1;
	$id_file=fopen('nom.txt','r');
	
	$pe=rand(10,200);
	
	while($ligne=fgets($id_file,300) )
	{
	if($j==$nom)
	{
	
	$nomc=$ligne;
	}
	$j++;
	}
	fclose($id_file);
	
	$sql = 'INSERT INTO espacem.joueur VALUES("","7","'.$nomc.'","'.$prenomc.'","'.$taille.'","'.$age.'","'.$poste.'","'.$talent.'","'.$pe.'","'.$gardien.'","'.$defense.'","'.$attaque.'","'.$endurance.'","")';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
}

echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		


?>