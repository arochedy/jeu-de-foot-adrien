 <?php
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {

		include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();

		$sql = 'SELECT id FROM membre WHERE login="'.mysql_escape_string($_POST['login']).'" AND pass_md5="'.md5(mysql_escape_string($_POST['pass'])).'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		$nb = mysql_num_rows($req);

		if ($nb == 1) {
			$data = mysql_fetch_array($req);

			session_start();
			$_SESSION['login'] = $_POST['login'];
			// on enregistre en plus l'id du membre dans une variable de session
			$_SESSION['id'] = $data['id'];

			

			header('Location: membre.php');
			exit();
		}
		elseif ($nb == 0) {
			$erreur = 'Compte non reconnu.';
		}
		else {
			$erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
		}
		
	}
	else {
		$erreur = 'Au moins un des champs est vide.';
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Au Pavé de Saint-Regis</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" />
   </head>
 
   <body>
 
       <!-- L'en-tête -->
 
       <div id="en_tete">
        <li list-style-type=none><a href="index.php" ><img src="img/facebook.jpg" alt="Facebook" border=0></a></li>
       </div>
 
       <!-- Les menus -->
 
      <?php
	  include_once('fonctions.php');
	  $affichage = new Fonctions;
	  $affichage->menu(FALSE);
	  ?>

       <!-- Le corps -->
 
       <div id="corps">
       
           
           Connexion à l'espace membre :<br />
<form action="index.php" method="post">
Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>"><br />
Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo stripslashes(htmlentities(trim($_POST['pass']))); ?>"><br />
<input type="submit" name="connexion" value="Connexion">
</form>
<a href="inscription.php">Vous inscrire</a>
<?php

if (isset($erreur)) echo '<br /><br />',$erreur;
?>
           <h2>Le Choix</h2>    
           <p>
               Un choix infini... ou presque<br />
              
			   
			

               
           </p>
       </div>
 
       <!-- Le pied de page -->
	<?php
	  $affichage->pied();
	?>
   </body>
</html>





