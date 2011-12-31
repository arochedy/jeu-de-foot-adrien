<?php
class Fonctions
{
   
   
    
    public function menu($accueil=true)
    {
		echo'<div id="menu">'  ;   
		echo'<div class="element_menu"> ';
		echo	'<h3>Au Pavé de Saint-Regis</h3>';
		echo'<ul class=ulmenu list-style-type=none>';
		if($accueil)
		echo	'<li list-style-type=none align=right><a href="index.php" ><img src="img/accueil.png" alt="Acceuil" border=0>Accueil</a></li><br>';
		echo	'<li list-style-type=none><a href=http://www.lalouvesc.com/ title= "Decouvrez La louvesc"><img  src="img/tourisme.png" alt="La louvesc" border=0>La Louvesc</a></li><br>' ;
		echo	'<li list-style-type=none><a href=http://www.google.fr><img border=0 src="img/decouverte.png" alt="google" title="clique là pour aller sur google" ></a></li><br>';
		echo	' <li list-style-type=none><a href="pdf/pdf2.php">PDF</a></li><br>';
		echo	'<li list-style-type=none><a href="form.php">Contactez-nous</a></li><br>';
		echo	'<li><a href="img/image.php">Image</a></li><br>';
		echo'</ul>';

		echo'</div>';

		echo'<div class="element_menu">';
		echo	'<h3>Informations</h3>';
		echo'<ul>';
		echo	'<li><a href="salon.php">Salon de thé</a></li><br>';
		echo	'<li><a href="boulangerie.php">Boulangerie</a></li><br>';
		echo	'<li><a href="patisserie.php">Patisserie</a></li><br>';
		echo	'<li><a href="trouve.php">Nous trouver</a></li><br>';
		echo	'<li><a href="patisserie.php">Commander</a></li><br>';
		echo'</ul>';
		echo'</div>'  ;      
		echo'</div>';
		
        
    }
	
	public function pied()
	{
	
	  echo '<div id="bas">';
      echo  '<p>Au Pavé de saint régis depuis 1960 </p>';
      echo  '</div>';
	}
	
	function connexion()
	{
	$base = mysql_connect ('localhost', 'root', '');
		mysql_select_db ('lefande4', $base);
	}
	
    
	
	
	
	
	
    
}