<?php
session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) {
	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}
?>


<?php

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();



	 
		$sql = 'SELECT * FROM espacem.transfert WHERE idcvendeur="'.$_SESSION['id'].'" AND accepte="0"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$nb = mysql_num_rows($req);

	if ($nb == 0) {
		echo 'Aucune negociation';
	}
	else 
	{

		while ($data = mysql_fetch_array($req))
		{
			$sql2 = 'SELECT nom,prenom FROM espacem.joueur WHERE idjoueur="'.$data['idjoueur'].'" AND idclub="'.$_SESSION['id'].'"';
			$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
			$nb2= mysql_num_rows($req2);
			$data2 = mysql_fetch_array($req2);
			
			if($nb2!=0)
			{
			echo $data2['nom'];
			echo '<br>';
			echo  'Montant : '.$data['montant'];
			
			echo '<FORM METHOD="POST"  ACTION="acceptertransfert.php"> ';
			echo '<input type="hidden" name="idjoueur" value="'.$data['idjoueur'].'">';
			echo '<input type="hidden" name="idclubacheteur" value="'.$data['idcacheteur'].'">';
			echo '<input type="hidden" name="montant" value="'.$data['montant'].'">';
			echo '<input type="submit" name="Accepter" value="Accepter">';
	 
			echo '</FORM>';	
			
			echo '<FORM METHOD="POST"  ACTION="refusertransfert.php"> ';
			echo '<input type="hidden" name="idtransfert" value="'.$data['idtransfert'].'">';
			echo '<input type="submit" name="Refuser" value="Refuser">';
	 
			echo '</FORM>';	
			}
			else
			{
				$sql3 = 'DELETE FROM `espacem`.`transfert` WHERE `transfert`.`idtransfert` ="'.$data['idtransfert'].'"';
				$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error());
			}
		}
		
		


	}

?>