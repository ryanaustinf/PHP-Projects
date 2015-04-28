<!DOCTYPE PHP>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Insert title here</title>
		<link rel="stylesheet" href="external.css" />
		<style>
			.char {
				background-color:#A8A00E;
				margin:10px;
				padding:1px 10px;
				padding-left:50px;
				color:#000;
			}
			
			.char:hover {
				background-color:#A87009;
			}
			
			#button {
				text-align:center;
			}
			
			button {
				font-size:1.5em;
			}
			
			#error {
				color:#FF0000;
				width:400px;
				margin:auto;
				text-align:center;
				font-size:1.5em;
				font-weight:bold;
				padding:30px;
			}
			
			#search {
				position:relative;
				left:300px;
				width:200px;
			}
		</style>
		<script src="jquery-2.1.1.js"></script>
		<script src="external.js"></script>
		<script>
			$(document).ready(function() {
				$("header").click(function() {
					home();
				});

				function search( str ) {
					$.ajax({
						url : 'GOT.php',
						data : {'f' : str},
						success : function(a) {
							$("#res").html(a);
						}
					});
				}
				
				$("#search").on( 'input', function() {
					search($(this).val());
				});

				search('<?php echo $_GET['f'];?>');
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
			<input id="search" type="text" placeholder="Search" />
			<div id="res"></div>
			<div id="button">
				<button onClick="location='/Pika';">Back</button>
			</div>
		</div>
	</body>
</html>