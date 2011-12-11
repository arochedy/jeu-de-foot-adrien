<?php
header ("Content-type: image/jpeg"); // L'image que l'on va cr�er est un jpeg

// On charge d'abord les images
$source = imagecreatefrompng("commerces.png"); // Le logo est la source
$destination = imagecreatefromjpeg("2.jpg"); // La photo est la destination

// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

// On veut placer le logo en bas � droite, on calcule les coordonn�es o� on doit placer le logo sur la photo
$destination_x = $largeur_destination - $largeur_source;
$destination_y =  $hauteur_destination - $hauteur_source;

// On met le logo (source) dans l'image de destination (la photo)
imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 60);

// On affiche l'image de destination qui a �t� fusionn�e avec le logo
imagejpeg($destination);
?>