<?php
    session_start();
    require_once("session.php");
    if (!$prenom) die();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Club MGEN</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="bibglobal0.css" type="text/css" rel="stylesheet" media="screen"/>
    <link href="msgBoxLight.css" rel="stylesheet">
    <script src="jquery-2.1.4.min.js"></script>
    <script src="jquery.msgBox.js"></script>
    <script src="fonctions.js"></script>
    <script type="text/javascript"></script>
</head>
<body onload="resizemenu()" onresize="resizemenu()">
    <?php 
        include("menus.php");
    ?>
    <div class="titre1">Importation de la table des adhérents dans la base de données</div>
	<div class="champ">
		<fieldset class="champemprunteurs">

			<form method="POST" action="upload.php" enctype="multipart/form-data">
			     <!-- On limite le fichier à 500Ko -->
			     <input type="hidden" name="MAX_FILE_SIZE" value="500000">
			     Fichier : <input type="file" name="avatar">
			     <input type="submit" name="envoyer" value="Envoyer le fichier">
			</form>			

		</fieldset>
	</div>
</body>
</html>