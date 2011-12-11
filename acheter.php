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


$idj=$_POST['idjoueur'];
$idc=$_POST['idclub'];
// on teste si le formulaire a bien été soumis
if (isset($_POST['go']) && $_POST['go'] == 'Envoyer') 
{
	if (empty($_POST['montant'])) 
	{
		$erreur = 'Au moins un des champs est vide.';
	}
	else
	{
		include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
		
		$montant=mysql_real_escape_string($_POST['montant']);
		$montant*=1;
		
		$sql = 'SELECT argent FROM membre WHERE id="'.$_SESSION['id'].'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
		
		$data = mysql_fetch_array($req);
		
		$argent=$data['argent'];
		
		
		if($montant<$argent)
		{
		// si tout a été bien rempli, on insère le transfert dans notre table SQL
		$sql = 'INSERT INTO espacem.transfert VALUES("","'.$montant.'","'.$idc.'", "'.$_SESSION['id'].'", "'.$idj.'","")';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		header('Location: membre.php');
		exit();
		}
		else
		{
		echo 'Vous n\'avez pas assez d\'argent pour acheter ce joueur !';
		}
		
		
	}
}

?>

<?
$idj=$_POST['idjoueur'];
$idc=$_POST['idclub'];
?>
<form action="acheter.php" method="post">
	Montant :<input type="text" name="montant" value="<?php if (isset($_POST['montant'])) echo stripslashes(htmlentities(trim($_POST['montant']))); ?>"><br />
	<?php
	echo '<input type="hidden" name="idjoueur" value="'.$idj.'">';
	echo '<input type="hidden" name="idclub" value="'.$idc.'">';
	?>
	<input type="submit" name="go" value="Envoyer">
	</form>


<?php
// si une erreur est survenue lors de la soumission du formulaire, on l'affiche
if (isset($erreur)) echo '<br /><br />',$erreur;
?>