 <?php
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['nomclub']) && !empty($_POST['nomclub'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm']))) {
		if ($_POST['pass'] != $_POST['pass_confirm']) {
			$erreur = 'Les 2 mots de passe sont diff�rents.';
		}
		else {
	include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();

			$sql = 'SELECT id FROM membre WHERE login="'.mysql_escape_string($_POST['login']).'"';
			$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
			$nb = mysql_num_rows($req);

			if ($nb == 0) {
				$date=date('Y-m-d');
				$sql = 'INSERT INTO membre VALUES("", "'.mysql_escape_string($_POST['login']).'", "'.md5(mysql_escape_string($_POST['pass'])).'", "'.mysql_escape_string($_POST['nomclub']).'","'.$date.'","1","500000")';
				mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

				
				// on r�cup�re l'id de notre nouveau membre
				$id = mysql_insert_id();

				session_start();
				$_SESSION['login'] = $_POST['login'];

				// on stocke cet id dans une variable de session
				$_SESSION['id'] = $id;
				
				$sql = 'INSERT INTO stade VALUES("", "'.$id.'","5000","Stade municipal")';
				mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
				
				header('Location: membre.php');
				exit();
			}
			else {
				$erreur = 'Un membre poss�de d�j� ce login.';
			}
		}
	}
	else {
		$erreur = 'Au moins un des champs est vide.';
	}
}
?>
<html>
<head>
<title>Inscription</title>
</head>

<body>
Inscription � l'espace membre :<br />
<form action="inscription.php" method="post">
Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>"><br />
Nom du club <input type="text" name="nomclub" value="<?php if (isset($_POST['nomclub'])) echo stripslashes(htmlentities(trim($_POST['nomclub']))); ?>"><br />
Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo stripslashes(htmlentities(trim($_POST['pass']))); ?>"><br />
Confirmation du mot de passe : <input type="password" name="pass_confirm" value="<?php if (isset($_POST['pass_confirm'])) echo stripslashes(htmlentities(trim($_POST['pass_confirm']))); ?>"><br />
<input type="submit" name="inscription" value="Inscription">
</form>
<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
</body>
</html>