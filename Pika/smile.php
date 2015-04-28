<!DOCTYPE PHP>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Insert title here</title>
		<link rel="stylesheet" href="external.css" />
		<style>
			a {
				font-size:1.2em;
				width:75px;
				text-align:center;
				margin:auto;
				display:block;
			}
		</style>
		<script src="jquery-2.1.1.js"></script>
		<script src="external.js"></script>
		<script>
			$(document).ready(function() {
				$("header").click(function() {
					home();
				});
			});
		</script>
	</head>
	<body>
		<header>
			<img src="Pikachu.jpg" />
			Hello World!
			<img src="Pikachu.jpg" />
		</header>
		<div id="mainContent">
			<?php
				$count = 0;
				if( !isset($_GET['n']) ) {
					if( isset($_COOKIE['smileCook']) ) {
						$count = $_COOKIE['smileCook'];
					}
				} else {
					$count = $_GET['n'];
					setcookie("smileCook",$count,time() + 2**31 - 1, "/");
				}
				echo "\t\t\t<ol>\n";
				while( $count > 0 ) {
					echo "\t\t\t\t<li style=\"display:inline\"><h1 style=\"display:inline\">:-D</h1></li>\n";
					$count--;
				}
			?>
			<a href="/Pika">Back</a>
		</div>	
	</body>
</html>