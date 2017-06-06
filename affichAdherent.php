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
    <script type="text/javascript">
		jQuery(document).ready(function(){
  			console.log("jQuery est prêt !");
		});  		
    	function imprim(id) {
			jQuery.msgBox({ type: "confirm",
				title: "Impression",
				content: "Quel format d\'impression voulez-vous ?",
				buttons: [{ value: "Annuler" }, { value: "Simple"},{ value: "Complet"}],
	            success: function(result)  {
		        	if (result!="Annuler") {
 						var formulaire = document.createElement('form');
			    		formulaire.setAttribute('target','_blank');
			    		formulaire.setAttribute('action','imprimAdherent.php');
			    		formulaire.setAttribute('method', 'post');
			    		var input0 = document.createElement('input');
			    		input0.setAttribute('type','hidden');input0.setAttribute('name','id');input0.setAttribute('value',id);
			    		formulaire.appendChild(input0);
			    		var input1 = document.createElement('input');
			    		input1.setAttribute('type','hidden');input1.setAttribute('name','forme');input1.setAttribute('value',result);
			    		formulaire.appendChild(input1);
				   		document.body.appendChild(formulaire);
			    		formulaire.submit();
		        	}
		        }
		    });
		}
		function goencaisse(id) {
			var formul = document.createElement('form');
			formul.setAttribute('action','encaisseAd.php');
			formul.setAttribute('method','post');
			var input0 = document.createElement('input');
			input0.setAttribute('type','hidden');input0.setAttribute('name','id');input0.setAttribute('value',id);
			formul.appendChild(input0);
			document.body.appendChild(formul);
			formul.submit();
		}
    </script>
</head>
<body onload="resizemenu()" onresize="resizemenu()">
	<?php 
		include("menus.php");
		include("liOptions.php");
		include("adherents.inc");
		$ad = new Adherent;
		$ad->id = $_POST['id'];
		$ad->getadh($tadh);
		$ad->getactivites($tact);
		if ($ad->particip1=="P") $particip1="checked";else $particip1="";
		if ($ad->particip2=="P") $particip2="checked";else $particip2="";
		if ($ad->particip3=="P") $particip3="checked";else $particip3="";
		if ($ad->particip4=="P") $particip4="checked";else $particip4="";
		if ($ad->particip5=="P") $particip5="checked";else $particip5="";
		if ($ad->particip6=="P") $particip6="checked";else $particip6="";
		//echo $ad->activite1."  ".$ad->activite2."  ".$activite3."<br>";
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
		$optionstitre = putSelected($optionstitre,$ad->titre);
		$optionsqualite = putSelected($optionsqualite,$ad->qualite);
		$optionsprofession = putSelected($optionsprofession,$ad->profession);
		$optionsactivite1 = putSelected3($optionsactivite,$ad->activite1);
		$optionsactivite2 = putSelected3($optionsactivite,$ad->activite2);
		$optionsactivite3 = putSelected3($optionsactivite,$ad->activite3);
		$optionsactivite4 = putSelected3($optionsactivite,$ad->activite4);        	

		$optionsactivite5 = putSelected3($optionsactivite,$ad->activite5);
		$optionsactivite6 = putSelected3($optionsactivite,$ad->activite6);
		$optionsgroupe1 = putSelected2($optionsgroupe,$ad->groupe1);
		$optionsgroupe2 = putSelected2($optionsgroupe,$ad->groupe2);
		$optionsgroupe3 = putSelected2($optionsgroupe,$ad->groupe3);
		$optionsgroupe4 = putSelected2($optionsgroupe,$ad->groupe4);
		$optionsgroupe5 = putSelected2($optionsgroupe,$ad->groupe5);
		$optionsgroupe6 = putSelected2($optionsgroupe,$ad->groupe6);

		$nencaisse=0;
?>		
	<div class="champ">
		<fieldset class="champemprunteurs" >
			<form name="nouvelAd" action="modifAdherent.php" method="post">
				<input type="hidden" name="id" value="<?php echo $ad->id ?>">
			<table  class="saisie">
				<tr>
					<td style="color:blue"> <?php if ($ad->titre=="M.") echo "Monsieur";else echo "Madame";echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?></td>
					<td> </td>
					<td><label for="nom">Nom : </label></td>
					<td style="color:blue"><?php echo $ad->nom ?> </td>
					<?php 
						if ($ad->titre!="M.") {
							echo '<td><label for="nomjf">Née: </label></td><td style="color:blue">'.$ad->nomjf.'</td>';
						}
					?>
					
				</tr>
				<tr>
					<td style="color:blue"><?php if ($ad->qualite=="M") echo "Mutualiste"; else echo "Ayant-droit" ?></td>
					<td> </td>			
					<td><label for="prenom">Prénom : </label></td>
					<td style="color:blue"><?php echo $ad->prenom ?></td>
					<td><label for="numMGEN">Numéro Club : </label></td>
					<td style="color:blue"><?php echo $ad->numMGEN ?></td>
				</tr>
				<tr>					
					<td> </td><td> </td>
					<td><label for="telephone">Téléphone : </label> </td>			
					<td style="color:blue"><?php echo $ad->telephone ?></td>
					<td><label for="portable">N° portable : </label></td>
					<td style="color:blue"><?php echo $ad->portable ?></td>
				</tr>
				<tr>					
					<td> </td><td> </td>			
					<td><label for "adresse">Adresse :</label></td>
					<td style="color:blue"><?php echo $ad->adresse ?></td>
					<?php 
						if ($ad->compadresse !="") {
							echo '<td><label for "compadresse">Complément :</label></td>';
							echo '<td style="color:blue"><?php echo $ad->compadresse ?></td>';
						}
					?>
				</tr>
				<tr>					
					<td> </td><td> </td>			
					<td><label for "codepostal">Code postal :</label></td>
					<td style="color:blue"><?php echo $ad->codepostal ?></td>
					<td><label for "ville">Ville :</label></td>
					<td style="color:blue"><?php echo $ad->ville ?></td>
				</tr>
				<tr>					
					<td> </td><td> </td>			
					<td><label for="courriel">Courriel : </label></td>
					<td style="color:blue"><?php echo $ad->courriel ?></td> 
					<td><label for "profession">Profession</label></td>
					<td style="color:blue"><?php echo $ad->profession ?></td>
				</tr>
				<tr>					
					<td> </td><td> </td>			
					<td><label for "assurance">Assurance :</label></td>
					<td style="color:blue"><?php echo $ad->assurance ?></td>
					<td><label for "specialite">Spécialité</label></td>
					<td style="color:blue"><?php echo $ad->specialite ?></td>
				</tr>
				<tr>					
					<td> </td><td> </td>			
					<td><label for="numeroSS">Numéro S.S. : </label>  </td>
					<td style="color:blue"><?php echo $ad->numeroSS ?></td>
					<td><label for="cotisation">Cotisation : </label></td></td>
					<td><?php 
							if ($ad->cotisation=='0') echo "<span style='color:green;font-weight: bold'> A JOUR</span>";
							else  {echo "<span style='color:red;font-weight: bold'> EN ATTENTE</span>";$nencaisse++;} 
						?> 
					</td>
				</tr>
				<tr>					
					<td> </td><td> </td>			
					<td><label for="premannee">Adhérent depuis : </label></td>
					<td style="color:blue"><?php echo $ad->premannee ?></td>
					<td><label for"sortie">Sortie du club : </label></td>
					<td style="color:blue"><?php echo $ad->sortie ?></td>
				</tr>
			</table> 
			</br></br>
			<table class="saisie">
				<tr>
					<th>Activité</th><th>Groupe</th><th>Réglement</th><th>     </th><th>Activité</th><th>Groupe</th><th>Réglement     </th>
				</tr>
				<tr>

					<?php if ($ad->activite1 != "Pas d'activité") {
						echo "<td>$ad->activite1</td>";
						echo "<td>&nbsp;&nbsp;&nbsp;$ad->groupe1</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						if ($particip1=="checked") echo "<span style='color:green'>A JOUR</span>";
						else {echo "<span style='color:red '>EN ATTENTE</span></td>";$nencaisse++;}
					}  else echo "<td></td><td></td><td></td>" ?>
					<td></td>
					
					<?php if ($ad->activite4 != "Pas d'activité") {
						echo "<td>$ad->activite4</td>";
						echo "<td>&nbsp;&nbsp;&nbsp;$ad->groupe4</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						if ($particip4=="checked") echo "<span style='color:green'>A JOUR</span>";
						else {echo "<span style='color:red '>EN ATTENTE</span></td>";$nencaisse++;}
					}  else echo "<td></td><td></td><td></td>" ?>
				</tr>			
				<tr>
					
					<?php if ($ad->activite2 != "Pas d'activité") {
						echo "<td>$ad->activite2</td>";
						echo "<td>&nbsp;&nbsp;&nbsp;$ad->groupe2</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						if ($particip2=="checked") echo "<span style='color:green'>A JOUR</span>";
						else {echo "<span style='color:red '>EN ATTENTE</span></td>";$nencaisse++;}
					} else echo "<td></td><td></td><td></td>" ?>
					<td></td>
					
					<?php if ($ad->activite5 != "Pas d'activité") {
						echo "<td>$ad->activite5</td>";
						echo "<td>&nbsp;&nbsp;&nbsp;$ad->groupe5</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						if ($particip5=="checked") echo "<span style='color:green'>A JOUR</span>";
						else {echo "<span style='color:red '>EN ATTENTE</span></td>";$nencaisse++;}
					}  else echo "<td></td><td></td><td></td>" ?>
				</tr>			
				<tr>
					
					<?php if ($ad->activite3 != "Pas d'activité") {
						echo "<td>$ad->activite3</td>";
						echo "<td>&nbsp;&nbsp;&nbsp;$ad->groupe3</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						if ($particip3=="checked") echo "<span style='color:green'>A JOUR</span>";
						else {echo "<span style='color:red '>EN ATTENTE</span></td>";$nencaisse++;}
					}  else echo "<td></td><td></td><td></td>" ?>
					<td></td>
					
					<?php if ($ad->activite6 != "Pas d'activité") {
						echo "<td>$ad->activite6</td>";
						echo "<td>&nbsp;&nbsp;&nbsp;$ad->groupe6</td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						if ($particip6=="checked") echo "<span style='color:green'>A JOUR</span>";
						else {echo "<span style='color:red '>EN ATTENTE</span></td>";$nencaisse++;}
					}  else echo "<td></td><td></td><td></td>" ?>
				</tr>
				<tr><td> </td></tr>
				<tr>
					<td> </td>
					<td> </td>
					<td> </td>					
					<td> </td>
					<td></td>
				</tr>

			</table>
			</form>
			<?php 
				if ($nencaisse>0) echo '<button class="bouton"  onclick="goencaisse('.$ad->id.')">ENCAISSER</button>';
			?>
			
			<button id="bouton1" class="bouton"  onclick="imprim(<?php echo $ad->id ?>)">IMPRIMER</button>
		</fieldset>
	</br>

	</div>  
	<div id="message"></div>
</body>
</html>