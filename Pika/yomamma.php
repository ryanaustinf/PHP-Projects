<?php 
	session_start();
?>
<!DOCTYPE PHP>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Yo Mamma</title>
		<link rel="stylesheet" href="external.css" />
		<style>
			a {
				font-size:1.2em;
				width:75px;
				text-align:center;
				margin:auto;
				display:block;
			}
			
			form {
				color:black;
			}
			
			#mamma {
				color:black;
				text-transform:uppercase;
			}
		</style>
		<script src="external.js"></script>
		<script src="jquery-2.1.1.js"></script>
		<script>
			$(document).ready(function() {
				$("header").click(function() {
					home();
				});
			});
		</script>
	</head>
	<body>
		<?php 
			if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				$_SESSION['c'] = $_POST['c'];
				setcookie('yomamma',$_SESSION['c'],time() + (2**31 - 1),"/");
			} else {
				if( isset($_COOKIE['yomamma']) ) {
					$_SESSION['c'] = $_COOKIE['yomamma'];
				} else {
					$_SESSION['c'] = null;
				}
			}
		?>
		<header>
			<img src="Pikachu.jpg" />
			Hello World!
			<img src="Pikachu.jpg" />
		</header>
		<div id="mainContent">
			<?php  
				function yoMamma( $s ) {
					$c = date("g:i A \on n/j/Y");
					return ( ( $s == null || strlen($s) == 0 ) ?  "" : "As of "
								.$c.", your mother is a ".$s."!" );
				}
			?>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" 
				method="post">
				Your comment: <input type="text" placeholder="Your Comment Here" 
								name="c" />
			</form><br />
			<div id="mamma"><?php echo "\t\t\t".yoMamma($_SESSION['c']);?></div>
			<br /><br /><a href="/Pika">Back</a>
		</div>
	</body>
</html>