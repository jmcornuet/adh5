<?php
	$s0="(+33/0)604163482";
	if (strlen($s0)==10) {
		$s1 = substr($s0,-10,2);
		for ($i=4;$i>0;$i--) $s1 .=" ".substr($s0,-2*$i,2); 
	}
	//$s1 = substr($s0,-10,2)." ".substr($s0,-8,2)." ".substr($s0,-6,2)." ".substr($s0,-4,2)." ".substr($s0,-2,2);
	else $s1=$s0;
	echo $s1."\n";
?>