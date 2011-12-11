<?php

$id=$_GET['id'];


echo '<title>Collectif</title>';

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	
$sql = 'SELECT attaque,defense,endurance,gardien FROM espacem.joueur WHERE titulaire="1" and idclub="'.$id.'"';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


$nb = mysql_num_rows($req);

if ($nb == 0) 
{
	echo 'Ce club n\'existe pas ou il n\'y pas de joueurs titulaires.';
}
else 
{
	$attaque=0;
	$defense=0;
	$gardien=0;
	
	while ($data = mysql_fetch_array($req))
	{
		$attaque+=$data['attaque'];
		$defense+=$data['defense'];
		$gardien+=$data['gardien'];
	
	}
		echo "Collectif du club <br><br>";
		echo 'Attaque :   '.$attaque.'<br>';
		echo 'Defense :   '.$defense.'<br>';
		echo 'Gardien :   '.$gardien.'<br>';
	
}

echo '<FORM METHOD="POST"  ACTION="club.php?id='.$id.'"> ';
echo '<input type="submit" name="retour" value="Retour">';
	 
echo '</FORM>';			
		
		
?>		
