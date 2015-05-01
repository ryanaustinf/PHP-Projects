<?php 
	$num1 = $_REQUEST["num1"];
	$num2 = $_REQUEST["num2"];
	$sum = $num1 + $num2;
	$str = "";
	foreach( $_GET as $key=>$attr ) {
		$str .= $key." = ".$attr."<br>";
	} 
	
	echo "<br />Result: <br />$num1 + $num2 = $sum<br />$num1 - $num2 = "
			.($num1-$num2)."<br />$num1 * $num2 = ".$num1*$num2
			."<br/>$num1 / $num2 = ".$num1/$num2;
?>