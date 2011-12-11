<?php

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
	  
	 $date=date('Y-m-d');
	
	  
	//selectionne tous les matchs du jour validés et non joués !  
	
	$sql = 'SELECT * FROM espacem.match WHERE date="'.$date.'" AND fini=0 AND valide="1"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	$nb = mysql_num_rows($req);

	if ($nb == 0) 
	{	
	echo 'Aucun match aujourd\'hui.';
	}
	else 
	{
	
		while ($data = mysql_fetch_array($req))
		{
			$idm=$data['idmatch'];
			$iddom=$data['iddom'];
			$idext=$data['idext'];
			
			
			$sql2 = 'SELECT attaque,defense,endurance FROM espacem.joueur WHERE titulaire="1" and idclub="'.$iddom.'"';
			$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());

			$nb2 = mysql_num_rows($req2);
			$attaquedom=0;
			$defensedom=0;
			
			$nbjdom=$nb2;
			
			while ($data2 = mysql_fetch_array($req2))
			{
			$attaquedom+=$data2['attaque'];
			$defensedom+=$data2['defense'];
			
			}
			
			$sql2 = 'SELECT attaque,defense,endurance FROM espacem.joueur WHERE titulaire="1" and idclub="'.$idext.'"';
			$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());

			$nb2 = mysql_num_rows($req2);
			$attaqueext=0;
			$defenseext=0;
			
			$nbjext=$nb2;
			
			while ($data2 = mysql_fetch_array($req2))
			{
			$attaqueext+=$data2['attaque'];
			$defenseext+=$data2['defense'];
			
			}
			if($nbjext>7 and $nbjdom>7)
			{
				$scoredom=0;
				$scoreext=0;
				
				//calcul du score (et donc du vainqueur !)
				$sql2 = 'SELECT gardien FROM espacem.joueur WHERE titulaire="1" and idclub="'.$iddom.'" AND poste="GAC"';
				$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());

				$nb2 = mysql_num_rows($req2);
				$gardiendom=$data2['gardien'];
				
				$sql2 = 'SELECT gardien FROM espacem.joueur WHERE titulaire="1" and idclub="'.$idext.'" AND poste="GAC"';
				$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());

				$nb2 = mysql_num_rows($req2);
				$gardienext=$data2['gardien'];
				
				
				if($attaquedom>($defenseext+$gardiendom))
					$scoredom=1;
				if($attaqueext>($defenseext+$gardienext))
					$scoreext=1;
					
				//Modifications base de données	
				$sql2 = 'UPDATE espacem.match SET fini="1" WHERE idmatch ="'.$idm.'"';
				$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());	
				
				$sql2 = 'UPDATE espacem.match SET scoredom="'.$scoredom.'" WHERE idmatch ="'.$idm.'"';
				$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
				
				$sql2 = 'UPDATE espacem.match SET scoreext="'.$scoreext.'" WHERE idmatch ="'.$idm.'"';
				$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
				
				$sql2 = 'SELECT PE,talent,nom,endurance,physique,idjoueur as idj FROM espacem.joueur WHERE titulaire="1" AND (idclub="'.$iddom.'" OR idclub="'.$idext.'")';
				$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
				$nb2 = mysql_num_rows($req2);
				
				
				while ($data2 = mysql_fetch_array($req2))
				{
				
				$pe=$data2['PE'];
				$talent=$data2['talent'];
				$idj=$data2['idj'];
				$endurance=$data2['endurance'];
				$physique=$data2['physique'];
				
				$pe+=3*$talent;
				
				$sql3 = 'UPDATE espacem.joueur SET PE="'.$pe.'" WHERE idjoueur="'.$idj.'"';
				$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error());
				
				
				$physique-=((100-$endurance)*0.5);
				$physique=max($physique,0);
				$sql4 = 'UPDATE espacem.joueur SET physique="'.$physique.'" WHERE idjoueur="'.$idj.'"';
				$req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error());
				}
				
				//envoie des messages de fin de match !
				$sql = 'INSERT INTO messages VALUES("", "7", "'.$iddom.'","'.date("Y-m-d H:i:s").'", "Rapport de Match", "Le match du jour est terminé !<br> Résultat : '.$scoredom.'-'.$scoreext.'<br>Cliquer <a href=\"match.php?id='.$idm.'\">ici</a> pour voir le résumé du match","")';
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
						
				$sql = 'INSERT INTO messages VALUES("", "7", "'.$idext.'","'.date("Y-m-d H:i:s").'", "Rapport de Match", "Le match du jour est terminé !<br> Résultat : '.$scoredom.'-'.$scoreext.'<br>Cliquer <a href=\"match.php?id='.$idm.'\">ici</a> pour voir le résumé du match","")';
						mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
			}
			else
			{
				if($nbjext<8 and $nbjext<8)
				{
				//Les 2 sont forfaits penalité aux 2 !!!
				}
				else
				{
					if($nbjext<8)
					{
					//cas du match forfait à cause de l'equipe exterieur !
					}
					else
					{
					if($nbjdom<8)
					{
					//forfait à cause de l'equipe domicile
					//ajouté un champ forfait à la table match
					}
					}
				}
			}
		}
		
	  
	}  
	
	echo '<FORM METHOD="POST"  ACTION="membre.php"> ';
echo '<input type="submit" name="retour" value="Retour">';
 
echo '</FORM>';		
	  
	  
?>	  