<?php
session_start();
// on vérifie toujours qu'il s'agit d'un membre qui est connecté
if (!isset($_SESSION['login'])) 
{

	// si ce n'est pas le cas, on le redirige vers l'accueil
	header ('Location: index.php');
	exit();
}

echo '<title>Organiser</title>';

include_once('fonctions.php');
	  $connexion = new Fonctions;
	  $connexion->connexion();
	  
$date=date('Y-m-d');

// on teste si le formulaire a bien été soumis
if (isset($_POST['go']) && $_POST['go'] == 'Envoyer') 
{
	if (empty($_POST['date']) || empty($_POST['adversaire']))
	{
		$erreur = 'Au moins un des champs est vide.';
	}
	else 
	{
		include_once('fonctions.php');
		$connexion = new Fonctions;
		$connexion->connexion();
		if($_POST['date']<$date)
		{
		echo "La date est déja passée !";
		}
		else
		{
			$adversaire=mysql_real_escape_string($_POST['adversaire']);
			$sql = 'SELECT id FROM membre WHERE login="'.$adversaire.'"';
			$result = mysql_query($sql);
			$req=mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
			$nb = mysql_num_rows ($req);
			
			if($nb==0)
			echo "Ce Club n'existe pas !";
			else
			{	
				$id=mysql_result($result, 0);
				if($id!=$_SESSION['id'])
				{
					$sql='SELECT nomclub FROM membre WHERE id ="'.$_SESSION['id'].'"';
					$result = mysql_query($sql);
					
					$clubdom=mysql_result($result, 0);
					$espace='  ';
					
					$sql='SELECT idmatch FROM espacem.match WHERE (idext="'.$id.'" OR iddom="'.$id.'") AND date="'.$_POST['date'].'"';
					$req=mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
					$nb = mysql_num_rows ($req);
					
					if($nb!=0)
					{
						echo "Ce club a déjà un match de prevu ce jour là !";
					}
					else
					{
					
						$sql='SELECT idmatch FROM espacem.match WHERE (idext="'.$_SESSION['id'].'" OR iddom="'.$_SESSION['id'].'") AND date="'.$_POST['date'].'"';
						$req=mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
						$nb = mysql_num_rows ($req);
					
						if($nb!=0)
						{
							echo "Vous avez déjà un match de prévu ce jourr là !";
						}
						else
						{
							// si tout a été bien rempli, on insère le message dans notre table SQL
							$sql = 'INSERT INTO messages VALUES("", "7", "'.$id.'","'.date("Y-m-d H:i:s").'", "Demande de match", "'.$clubdom.'&nbsp;vous a fait une demande de match<br>Cliquer <a href=\"valider.php\">ici</a> pour valider","")';
							mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

							$sql = 'INSERT INTO espacem.match VALUES(NULL,"'.$_POST['date'].'","'.$_SESSION['id'].'","'.$id.'","","","","")';
							mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
					
					

							header('Location: membre.php');
							exit();
						}
					}
				}
				else
					echo "Vous ne pouvez pas jouer un match contre vous même !";
			}		
		}
	}
}

?>


<title>Organiser</title>


<body>
<a href="membre.php">Retour à l'accueil</a><br /><br />
Organiser un match : <br /><br />

<?php

$connexion->connexion();

// on prépare une requete SQL selectionnant tous les login des membres du site en prenant soin de ne pas selectionner notre propre login, le tout, servant à alimenter le menu déroulant spécifiant le destinataire du message
$sql = 'SELECT membre.login as nom_destinataire, membre.id as id_destinataire FROM membre WHERE id <> "'.$_SESSION['id'].'" ORDER BY login ASC';
// on lance notre requete SQL
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$nb = mysql_num_rows ($req);

if ($nb == 0) {
	// si aucun membre n'a été trouvé, on affiche tout simplement aucun formulaire
	echo 'Vous êtes le seul membre inscrit.';
}
else {
	// si au moins un membre qui n'est pas nous même a été trouvé, on affiche le formulaire d'envoie de message
	
	?>
	<form action="organiser.php" method="post">
	
	<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
<tr><td id="ds_calclass">
</td></tr>
</table>

<script type="text/javascript">
// <!-- <![CDATA[

// Project: Dynamic Date Selector (DtTvB) - 2006-03-16
// Script featured on JavaScript Kit- http://www.javascriptkit.com
// Code begin...
// Set the initial date.
var ds_i_date = new Date();
ds_c_month = ds_i_date.getMonth() + 1;
ds_c_year = ds_i_date.getFullYear();

// Get Element By Id
function ds_getel(id) {
	return document.getElementById(id);
}

// Get the left and the top of the element.
function ds_getleft(el) {
	var tmp = el.offsetLeft;
	el = el.offsetParent
	while(el) {
		tmp += el.offsetLeft;
		el = el.offsetParent;
	}
	return tmp;
}
function ds_gettop(el) {
	var tmp = el.offsetTop;
	el = el.offsetParent
	while(el) {
		tmp += el.offsetTop;
		el = el.offsetParent;
	}
	return tmp;
}

// Output Element
var ds_oe = ds_getel('ds_calclass');
// Container
var ds_ce = ds_getel('ds_conclass');

// Output Buffering
var ds_ob = ''; 
function ds_ob_clean() {
	ds_ob = '';
}
function ds_ob_flush() {
	ds_oe.innerHTML = ds_ob;
	ds_ob_clean();
}
function ds_echo(t) {
	ds_ob += t;
}

var ds_element; // Text Element...

var ds_monthnames = [
'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
]; // You can translate it for your language.

var ds_daynames = [
'Dim', 'Lun', 'Mar', 'Me', 'Jeu', 'Ven', 'Sam'
]; // You can translate it for your language.

// Calendar template
function ds_template_main_above(t) {
	return '<table cellpadding="3" cellspacing="1" class="ds_tbl">'
	     + '<tr>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_py();">&lt;&lt;</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_pm();">&lt;</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_hi();" colspan="3">[Fermer]</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_nm();">&gt;</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_ny();">&gt;&gt;</td>'
		 + '</tr>'
	     + '<tr>'
		 + '<td colspan="7" class="ds_head">' + t + '</td>'
		 + '</tr>'
		 + '<tr>';
}

function ds_template_day_row(t) {
	return '<td class="ds_subhead">' + t + '</td>';
	// Define width in CSS, XHTML 1.0 Strict doesn't have width property for it.
}

function ds_template_new_week() {
	return '</tr><tr>';
}

function ds_template_blank_cell(colspan) {
	return '<td colspan="' + colspan + '"></td>'
}

function ds_template_day(d, m, y) {
	return '<td class="ds_cell" onclick="ds_onclick(' + d + ',' + m + ',' + y + ')">' + d + '</td>';
	// Define width the day row.
}

function ds_template_main_below() {
	return '</tr>'
	     + '</table>';
}

// This one draws calendar...
function ds_draw_calendar(m, y) {
	// First clean the output buffer.
	ds_ob_clean();
	// Here we go, do the header
	ds_echo (ds_template_main_above(ds_monthnames[m - 1] + ' ' + y));
	for (i = 0; i < 7; i ++) {
		ds_echo (ds_template_day_row(ds_daynames[i]));
	}
	// Make a date object.
	var ds_dc_date = new Date();
	ds_dc_date.setMonth(m - 1);
	ds_dc_date.setFullYear(y);
	ds_dc_date.setDate(1);
	if (m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10 || m == 12) {
		days = 31;
	} else if (m == 4 || m == 6 || m == 9 || m == 11) {
		days = 30;
	} else {
		days = (y % 4 == 0) ? 29 : 28;
	}
	var first_day = ds_dc_date.getDay();
	var first_loop = 1;
	// Start the first week
	ds_echo (ds_template_new_week());
	// If sunday is not the first day of the month, make a blank cell...
	if (first_day != 0) {
		ds_echo (ds_template_blank_cell(first_day));
	}
	var j = first_day;
	for (i = 0; i < days; i ++) {
		// Today is sunday, make a new week.
		// If this sunday is the first day of the month,
		// we've made a new row for you already.
		if (j == 0 && !first_loop) {
			// New week!!
			ds_echo (ds_template_new_week());
		}
		// Make a row of that day!
		ds_echo (ds_template_day(i + 1, m, y));
		// This is not first loop anymore...
		first_loop = 0;
		// What is the next day?
		j ++;
		j %= 7;
	}
	// Do the footer
	ds_echo (ds_template_main_below());
	// And let's display..
	ds_ob_flush();
	// Scroll it into view.
	ds_ce.scrollIntoView();
}

// A function to show the calendar.
// When user click on the date, it will set the content of t.
function ds_sh(t) {
	// Set the element to set...
	ds_element = t;
	// Make a new date, and set the current month and year.
	var ds_sh_date = new Date();
	ds_c_month = ds_sh_date.getMonth() + 1;
	ds_c_year = ds_sh_date.getFullYear();
	// Draw the calendar
	ds_draw_calendar(ds_c_month, ds_c_year);
	// To change the position properly, we must show it first.
	ds_ce.style.display = '';
	// Move the calendar container!
	the_left = ds_getleft(t);
	the_top = ds_gettop(t) + t.offsetHeight;
	ds_ce.style.left = the_left + 'px';
	ds_ce.style.top = the_top + 'px';
	// Scroll it into view.
	ds_ce.scrollIntoView();
}

// Hide the calendar.
function ds_hi() {
	ds_ce.style.display = 'none';
}

// Moves to the next month...
function ds_nm() {
	// Increase the current month.
	ds_c_month ++;
	// We have passed December, let's go to the next year.
	// Increase the current year, and set the current month to January.
	if (ds_c_month > 12) {
		ds_c_month = 1; 
		ds_c_year++;
	}
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Moves to the previous month...
function ds_pm() {
	ds_c_month = ds_c_month - 1; // Can't use dash-dash here, it will make the page invalid.
	// We have passed January, let's go back to the previous year.
	// Decrease the current year, and set the current month to December.
	if (ds_c_month < 1) {
		ds_c_month = 12; 
		ds_c_year = ds_c_year - 1; // Can't use dash-dash here, it will make the page invalid.
	}
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Moves to the next year...
function ds_ny() {
	// Increase the current year.
	ds_c_year++;
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Moves to the previous year...
function ds_py() {
	// Decrease the current year.
	ds_c_year = ds_c_year - 1; // Can't use dash-dash here, it will make the page invalid.
	// Redraw the calendar.
	ds_draw_calendar(ds_c_month, ds_c_year);
}

// Format the date to output.
function ds_format_date(d, m, y) {
	// 2 digits month.
	m2 = '00' + m;
	m2 = m2.substr(m2.length - 2);
	// 2 digits day.
	d2 = '00' + d;
	d2 = d2.substr(d2.length - 2);
	// YYYY-MM-DD
	return y + '-' + m2 + '-' + d2;
}

// When the user clicks the day.
function ds_onclick(d, m, y) {
	// Hide the calendar.
	ds_hi();
	// Set the value of it, if we can.
	if (typeof(ds_element.value) != 'undefined') {
		ds_element.value = ds_format_date(d, m, y);
	// Maybe we want to set the HTML in it.
	} else if (typeof(ds_element.innerHTML) != 'undefined') {
		ds_element.innerHTML = ds_format_date(d, m, y);
	// I don't know how should we display it, just alert it to user.
	} else {
		alert (ds_format_date(d, m, y));
	}
}

// And here is the end.

// ]]> -->
</script>


<form action="" method="post">
<div>

Date : <input onclick="ds_sh(this);" name="date" readonly="readonly" style="cursor: text" /><br />


</form>

	
	Adversaire	<input type="text" name="adversaire" value="<?php if (isset($_POST['adversaire'])) echo stripslashes(htmlentities(trim($_POST['adversaire']))); ?>"><br />

	<input type="submit" name="go" value="Envoyer">
	</form>
	<?php
}

?>
</select>

<br /><br />
<FORM METHOD="POST"  ACTION="deconnexion.php"> 

<INPUT border=0 src="img/fermer.gif" type=image Value=submit align="middle" > 
</FORM>

<?php
// si une erreur est survenue lors de la soumission du formulaire, on l'affiche
if (isset($erreur)) echo '<br /><br />',$erreur;
?>


