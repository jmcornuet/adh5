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
    <script src="fonctions.js"></script>
</head>
<body onload="resizemenu()" onresize="resizemenu()">
	<?php 
        include("menus.php");
        include("liOptions.php"); 
    ?>
    <div class="titre1">Encaissement d'un chèque pour un(e) adhérent(e)</div>
    <div class="champ">
        <fieldset class="champemprunteurs">
            <form name="encaisseAd" method="post" action="encaisseAd.php">
                Choisissez la personne pour laquelle vous encaissez un chèque : <br><br>
                <select name="id"><?php echo $optionspersonne ?></select></td>
                 <input type="submit" value="VALIDER">
            </form>
        </fieldset>
    </div> 
</body>
</html>

