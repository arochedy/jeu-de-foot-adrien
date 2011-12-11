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
           AU Pavé de saint-Regis
       </div>
 
       <!-- Les menus -->
 
       <?php
	  include_once('fonctions.php');
	  $affichage = new Fonctions;
	  $affichage->menu();
	  ?>
       <!-- Le corps -->
 
       <div id="corps">
           <h1>Au Pavé de Saint-Regis</h1>
       
           <p>
               Bienvenue <br />
               Vous allez adorer ici, c'est super bon !
           </p>
       
           <h2>Ou nous trouver</h2>    
          
		   
		   
		   <iframe width="350" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps/ms?ie=UTF8&amp;hl=fr&amp;msa=0&amp;msid=102454982744556520069.00048aaa43c648e4b6cf5&amp;ll=46.860191,2.329102&amp;spn=10.519099,18.676758&amp;z=5&amp;output=embed"></iframe>
		   <iframe width="350" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps/ms?ie=UTF8&amp;hl=fr&amp;msa=0&amp;msid=102454982744556520069.00048aaa43c648e4b6cf5&amp;ll=45.309666,4.438477&amp;spn=1.352122,2.334595&amp;z=8&amp;output=embed"></iframe><br />
		<br /><small>Afficher <a href="http://maps.google.fr/maps/ms?ie=UTF8&amp;hl=fr&amp;msa=0&amp;msid=102454982744556520069.00048aaa43c648e4b6cf5&amp;ll=46.860191,2.329102&amp;spn=10.519099,18.676758&amp;z=5&amp;source=embed" style="color:#0000FF;text-align:left">Lalouvesc</a> sur une carte plus grande</small>
		   
		   
               
           <
           
			   

               
           </p>
       </div>
 
       <!-- Le pied de page -->
 
     <?php
       
	  $affichage->pied();
	?>
 
   </body>
</html>


		

