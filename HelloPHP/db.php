<?php
	require_once "../test.php";
	
	$query = "SELECT text, status FROM test WHERE status = FALSE";
	$stmt = $conn->prepare($query);
	
	$stmt->bind_result($text,$status);
	$stmt->execute();
	
	if( $stmt->fetch() ) {
		echo "true";
	} else {
		echo "false";
	}
	
	$stmt->close();
	$conn->close();
?>