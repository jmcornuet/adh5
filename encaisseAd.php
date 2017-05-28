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
</head>
<body onload="resizemenu()" onresize="resizemenu()">
	<?php 
		include("menus.php");
		include("liOptions.php");
		include("adherents.inc");
		$ad = new Adherent;
		$ad->id = $_POST['id'];//echo $ad->id."<br>";
		$ad->getadh($tadh);
		$ad->getactivites($tact);
		$nadh = " (".$ad->numMGEN;
		if ($ad->qualite=="M") $nadh .="M)"; else $nadh .="C)";
		
		//echo $ad->activite1."-".$ad->particip1."   ".$ad->activite2."-".$ad->particip2."   ".$ad->activite3."-".$ad->particip3."   ";
		//echo $ad->activite4."-".$ad->particip4."   ".$ad->activite5."-".$ad->particip5."   ".$ad->activite6."-".$ad->particip6."<br>   ";
        $act=array();$part=array();
		if ($ad->activite1 != "Pas d'activité") {if ($ad->particip1 != "P") {array_push($act, $ad->activite1);array_push($part,"particip1");}}
		if ($ad->activite2 != "Pas d'activité") {if ($ad->particip2 != "P") {array_push($act, $ad->activite2);array_push($part,"particip2");}}
		if ($ad->activite3 != "Pas d'activité") {if ($ad->particip3 != "P") {array_push($act, $ad->activite3);array_push($part,"particip3");}}
		if ($ad->activite4 != "Pas d'activité") {if ($ad->particip4 != "P") {array_push($act, $ad->activite4);array_push($part,"particip4");}}
		if ($ad->activite5 != "Pas d'activité") {if ($ad->particip5 != "P") {array_push($act, $ad->activite5);array_push($part,"particip5");}}
		if ($ad->activite6 != "Pas d'activité") {if ($ad->particip6 != "P") {array_push($act, $ad->activite6);array_push($part,"particip6");}}
?>		
	<div class="champ">
		<fieldset class="champemprunteurs">
			<form name="encAd" action="encAdherent.php" method="post">
				<input type="hidden" name="idbeneficiaire" value="<?php echo $ad->id ?>">
			<table  class="saisie">
				<tr> 
					<td style="width:200px">Montant du chèque : </td>
					<td><input name="montant" type="text" size=30></td>
					<td>euros</td>
				</tr>
				<tr>
					<td>Numéro du chèque : </td>
					<td><input name="numcheque" type="text" size=30><td>
				<tr>
				<tr>
					<td>Banque : </td>
					<td><input name="banque" type="text" size=30><td>
				<tr>
				<tr>
					<td>Titulaire(s) du chèque<sup>*</sup> : </td>
					<td><input name="titulaire" type="text" size=30><td>
				</tr>
				<tr>
					<td style="font-size:70%"><sup>*</sup>Si différent de l'adhérent concerné</span></td>
				</tr>

			</table>
			<br><br>
			<table  class="saisie">
				<tr>
					<td>Adhérent concerné : <?php echo "<span style='font-size:130%'>".$ad->prenomnom.$nadh."</span>" ?></td>					
				</tr>
				<tr>
					<td>Chèque reçu pour le règlement de :
				</tr>
			</table> 
			</br>
			<table  class="saisie">
				<?php 
					if ($ad->cotisation > 0) {
						$msg="<tr><td>La cotisation au club : </td>";
						$msg .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
						$msg .= "<td><input id='cotisationP' type='checkbox' name='cotisation' value='' ></td></tr>";
						echo $msg;
					}
					$msg="<tr><td></td><td><td></tr>"; 
					for ($i=0;$i<count($act);$i++) {
						$msg .= "<tr> <td>L'activité : ".$act[$i]."</td>";
						$msg .= "<td> </td>";
						$msg .= "<td> <input type='checkbox' name=".$part[$i]." value='' ></td></tr>";
					}
					echo $msg;
				?>
			</table>
			<br><br>
					<input id="go" type="hidden"  value="CONFIRMER">
			</form>
			
			<button id="bouton0" class="bouton"  onclick="validecheque()">VALIDER</button> 
		</fieldset>
	</br>

	</div>  
	<div id="message"></div>
</body>
</html>