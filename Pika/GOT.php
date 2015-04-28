<?php 
	require_once '../asoiaf.php';
	
	$filter = "%".$_GET['f']."%";
	$query = "SELECT concat(firstname,' ', IFNULL(lastname,'')) AS Name, H.name AS house, title ". 
	   			"FROM characters, house H ".
	   			"WHERE houseID = house ". 
	   			( strlen($filter) == 2 ? "" : "AND (firstname LIKE ? OR lastname LIKE ? OR title LIKE ?) ").  
	   			"ORDER BY 1";
	$stmt = $conn->prepare($query);
	@$stmt->bind_param("sss",$filter,$filter,$filter);
	$name = null;
	$house = null;
	$title = null;
	$stmt->bind_result($name,$house,$title);
	if( !$stmt->execute()  ) {
		echo "\t\t<div id=\"error\">\n\t\t\tNOTHING TO DISPLAY\n\t\t</div>\n";
	} else {
		while( $row = $stmt->fetch() ) {
			echo "<div class='char'>\n";
			echo "<p>Name: $name</p>\n";
			echo ($title == null ? "" : "<p>AKA: $title</p>\n");
			echo "<p>Loyal to ".($house == null ? "nobody" :
					( ( strpos($house," ") ||
						$house === "???" ||
						$house === "Kingsguard" ||
						$house === "Dothraki" ||
						$house === "Wildlings" ) ?
						"" : "House " ).$house )."</p>\n";
			echo "</div>\n";
		}
	}
	$stmt->close();
	$conn->close();
?>
