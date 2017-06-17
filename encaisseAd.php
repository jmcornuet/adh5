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
    <script>
    	function updatetotal(origine) {
    		//document.getElementById('message').innerHTML=String(origine);
    		var stotal=document.getElementById('total').innerHTML;stotal=stotal.substr(0,stotal.length-2);
    		document.getElementById('total').innerHTML="";
    		var total=Number(stotal);var s="";    		
     		switch(origine) {
     			case 0 :  if (document.forms["encAd"]["cotisation"].checked) {
     						total = total+Number(document.forms["encAd"]["valcotisation"].value);
     						document.forms["encAd"]["excotisation"].checked=false;
     					  } else total = total-Number(document.forms["encAd"]["valcotisation"].value);
     					  break;
    			case 1 :  s=document.getElementById("tarif1").innerHTML;s=s.substr(0,s.length-2);
    			 		  if (document.forms["encAd"]["particip1"].checked) {total = total+Number(s);document.forms["encAd"]["exparticip1"].checked=false;}
    			 		  else total = total-Number(s);
    			 		  break;
    			case 2 :  s=document.getElementById("tarif2").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip2"].checked) {total = total+Number(s);document.forms["encAd"]["exparticip2"].checked=false;}
    			 		  else total = total-Number(s);
    			 		  break;
    			case 3 :  s=document.getElementById("tarif3").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip3"].checked) {total = total+Number(s);document.forms["encAd"]["exparticip3"].checked=false;}
    			 		  else total = total-Number(s);
    			 		  break;
    			case 4 :  s=document.getElementById("tarif4").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip4"].checked)  {total = total+Number(s);document.forms["encAd"]["exparticip4"].checked=false;}
    			 		  else total = total-Number(s);
    			 		  break;
    			case 5 :  s=document.getElementById("tarif5").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip5"].checked)  {total = total+Number(s);document.forms["encAd"]["exparticip5"].checked=false;}
    			 		  else total = total-Number(s);
    			 		  break;
    			case 6 :  s=document.getElementById("tarif6").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip6"].checked)  {total = total+Number(s);document.forms["encAd"]["exparticip6"].checked=false;}
    			 		  else total = total-Number(s);
    			 		  break;
    		}
    		document.getElementById('total').innerHTML=total+" €";
    	}

    	function exempt(origine) {
    		//document.getElementById('message').innerHTML=document.forms["encAd"]["valcotisation"].value;
    		var stotal=document.getElementById('total').innerHTML;stotal=stotal.substr(0,stotal.length-2);
    		document.getElementById('total').innerHTML="";
    		var total=Number(stotal);var s="";    		
     		switch(origine) {
     			case 0 :  if (document.forms["encAd"]["cotisation"].checked) {
     						total = total-Number(document.forms["encAd"]["valcotisation"].value);
     						document.forms["encAd"]["cotisation"].checked=false;
     					  }
     					  break;
    			case 1 :  s=document.getElementById("tarif1").innerHTML;s=s.substr(0,s.length-2);
    			 		  if (document.forms["encAd"]["particip1"].checked) {
    			 		  	total = total-Number(s);document.forms["encAd"]["particip1"].checked=false;}
    			 		  break;
    			case 2 :  s=document.getElementById("tarif2").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip2"].checked) {
    					  	total = total-Number(s);document.forms["encAd"]["particip2"].checked=false;}
    			 		  break;
    			case 3 :  s=document.getElementById("tarif3").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip3"].checked) {
    					  	total = total-Number(s);document.forms["encAd"]["particip3"].checked=false;}
    			 		  break;
    			case 4 :  s=document.getElementById("tarif4").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip4"].checked) {
    					  	total = total-Number(s);document.forms["encAd"]["particip4"].checked=false;}
    			 		  break;
    			case 5 :  s=document.getElementById("tarif5").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip5"].checked) {
    					  	total = total-Number(s);document.forms["encAd"]["particip5"].checked=false;}
    			 		  break;
    			case 6 :  s=document.getElementById("tarif6").innerHTML;s=s.substr(0,s.length-2);
    					  if (document.forms["encAd"]["particip6"].checked) {
    					  	total = total-Number(s);document.forms["encAd"]["particip6"].checked=false;}
    			 		  break;
    		}
    		document.getElementById('total').innerHTML=total+" €";
    	}    	
    </script>
</head>
<body onload="resizemenu()" onresize="resizemenu()">
	<?php 
		include("menus.php");
		include("liOptions.php");
		include("adherents.inc");
		include("gract.inc");
		function putSelected($opt,$sel) {
			$f=strpos($opt,$sel)+strlen($sel)+1;
			$s1=substr($opt,0,$f);
			$s2=substr($opt,$f,strlen($opt));
			return $s1." selected".$s2;
		}
        function putSelected2($opt,$sel) {
        	if ($sel=='0') return $opt;
            $f=strpos($opt,$sel)+strlen($sel);
            $s1=substr($opt,0,$f);
            $s2=substr($opt,$f,strlen($opt));
            return $s1." selected".$s2;
        }
        function putSelected3($opt,$sel) {
            $f=strpos($opt,$sel)-1;
            $s1=substr($opt,0,$f);
            $s2=substr($opt,$f,strlen($opt));
            return $s1." selected".$s2;            
        }

        function tarifAC($n,$qual,$ac,$acs,$tarA,$tarC) {
        	$trouve=false;$k=0;
        	while ((!$trouve)&&($k<$n)) {
        		$trouve = ($ac==$acs[$k]);
        		if (!$trouve) $k++;
        	}
        	if ($qual=="M") $t=$tarA[$k];
        	else $t=$tarC[$k];
        	return $t;
        }

		$ad = new Adherent;
		$ad->id = $_POST['id'];//echo $ad->id."<br>";
		$ad->getadh($tadh);
		$ad->getactivites($tact);
		$nadh = " (".$ad->numMGEN;
		if ($ad->qualite=="M") {$nadh .="M)";$cotisation=12; } else {$nadh .="C)";$cotisation=22;}
		$ga = new Gracts;
		$sql = "SELECT * FROM $tact";
		$ga->cherche($sql);
		$listact=array();$tarA=array();$tarC=array();
		for ($i=0;$i<$ga->n;$i++) {
			array_push($listact,$ga->gract[$i]->activite);
			array_push($tarA,$ga->gract[$i]->tarifA);
			array_push($tarC,$ga->gract[$i]->tarifC);
		}
		$n=$ga->n;$qual=$ad->qualite;
        $act=array();$part=array();$tarif=array();$idtarif=array();$idd=array();
		if ($ad->activite1 != "Pas d'activité") {if ($ad->particip1 == "A") {
			array_push($act, $ad->activite1);array_push($part,"particip1");array_push($tarif,tarifAC($n,$qual,$ad->activite1,$listact,$tarA,$tarC));array_push($idtarif,"tarif1");array_push($idd,1);}}
		if ($ad->activite2 != "Pas d'activité") {if ($ad->particip2 == "A") {
			array_push($act, $ad->activite2);array_push($part,"particip2");array_push($tarif,tarifAC($n,$qual,$ad->activite2,$listact,$tarA,$tarC));array_push($idtarif,"tarif2");array_push($idd,2);}}
		if ($ad->activite3 != "Pas d'activité") {if ($ad->particip3 == "A") {
			array_push($act, $ad->activite3);array_push($part,"particip3");array_push($tarif,tarifAC($n,$qual,$ad->activite3,$listact,$tarA,$tarC));array_push($idtarif,"tarif3");array_push($idd,3);}}
		if ($ad->activite4 != "Pas d'activité") {if ($ad->particip4 == "A") {
			array_push($act, $ad->activite4);array_push($part,"particip4");array_push($tarif,tarifAC($n,$qual,$ad->activite4,$listact,$tarA,$tarC));array_push($idtarif,"tarif4");array_push($idd,4);}}
		if ($ad->activite5 != "Pas d'activité") {if ($ad->particip5 == "A") {
			array_push($act, $ad->activite5);array_push($part,"particip5");array_push($tarif,tarifAC($n,$qual,$ad->activite5,$listact,$tarA,$tarC));array_push($idtarif,"tarif5");array_push($idd,5);}}
		if ($ad->activite6 != "Pas d'activité") {if ($ad->particip6 == "A") {
			array_push($act, $ad->activite6);array_push($part,"particip6");array_push($tarif,tarifAC($n,$qual,$ad->activite6,$listact,$tarA,$tarC));array_push($idtarif,"tarif6");array_push($idd,6);}}

		$an = strftime("%Y");
		$mo = strtolower(strftime("%B"));
		$jo =strftime("%d");
		$optionsj = putSelected2($optionsj,$jo);
		$optionsm = putSelected3($optionsm,$mo);
		$optionsa = putSelected2($optionsa,$an);
		$nact = count($act);
		if (($nact>0)||(+$ad->cotisation=="A")) {
?>		
	<div class="titre1">Encaissement d'un chèque</div>
	<div class="champ">
		<fieldset class="champemprunteurs">
			<form name="encAd" action="encAdherent.php" method="post">
				<input type="hidden" name="idbeneficiaire" value="<?php echo $ad->id ?>">
			<table class="saise">
				<tr>
					<td style="text-align:right">Date du chèque : </td>
					<td><select name="jcheque"><?php echo $optionsj ?></select> 
					<select name="mcheque"><?php echo $optionsm ?></select> 
					<select name="acheque"><?php echo $optionsa ?></select> <td>
				<tr>
				<tr> 
					<td style="width:200px;text-align:right">Montant du chèque : </td>
					<td><input name="montant" type="text" size=30></td>
					<td>euros</td>
				</tr>
				<tr>
					<td style="text-align:right">Numéro du chèque : </td>
					<td><input name="numcheque" type="text" size=30><td>
				<tr>
				<tr>
					<td style="text-align:right">Banque : </td>
					<td><select name="banque"><?php echo $optionsbanque ?></select></td>
				<tr>
				<tr>
					<td style="text-align:right">Titulaire(s) du chèque<sup>*</sup> : </td>
					<td><input name="titulaire" type="text" size=30><td>
					<td style="font-size:70%;text-align:left"><sup>*</sup>Si différent de l'adhérent concerné</span></td>
				</tr>
				<tr>
					<td style="text-align:right">Observations : </td>
					<td><input name="observations" type="text" size=30><td>

				</tr>

			</table>
			<br><br>
			<table  class="saisie">
				<tr>
					<td>Adhérent concerné : <?php echo "<span style='font-size:130%;color:blue'>".$ad->prenomnom.$nadh."</span>" ?></td>					
				</tr>
				<tr>
					<td>Chèque reçu pour le règlement de :
				</tr>
			</table> 
			</br>
			<table  class="saisie">
				<?php 
					if ($ad->cotisation == "A") {
						$cot='cotisation';
						$msg="<tr><td>La cotisation au club </td><td style='float:right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$cotisation." € </td>";
						$msg .= "<td><input name='valcotisation' type='hidden' value=$cotisation></td>";
						$msg .= "<td style='float:right'><input onclick='updatetotal(0)' type='checkbox' name='cotisation' value='' ></td>";
						$msg .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;Exempté &nbsp;&nbsp;</td>";
						$msg .= "<td><input onclick='exempt(0)' type='checkbox' name='excotisation' value=''></td></tr>";
						echo $msg;
					}
					if ($nact>0) {					
						if ($ad->cotisation == "A") $msg="<tr><td></td><td></td></tr>"; 
						for ($i=0;$i<$nact;$i++) {
							$msg .= "<tr>";
							$msg .= "<td>L'activité : ".$act[$i]."</td>";
							$msg .= "<td style='float:right' id='".$idtarif[$i]."'>".$tarif[$i]." €</td>";
							$msg .= "<td></td>";
							$msg .= "<td style='float:right'> <input onclick='updatetotal(".$idd[$i].")' type='checkbox' name='".$part[$i]."' value='' ></td>";
						$msg .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;Exempté &nbsp;&nbsp;</td>";
						$msg .= "<td><input onclick='exempt(".$idd[$i].")' type='checkbox' name='exparticip".$idd[$i]."' value=''></td>";
							$msg .= "</tr>";
						}
						echo $msg;
					}
					$msg ="<tr><td></td><td></td></tr>";
					$msg .="<tr><td>Total :</td><td id='total' style='float:right'>0 €<td></tr>";
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
<?php
	} else {
		echo "</br></br><div class='alerte'> $ad->titre $ad->prenom $ad->nom est à jour pour son adhésion et ses éventuelles activités.   </div>";
	}
?>
</body>
</html>