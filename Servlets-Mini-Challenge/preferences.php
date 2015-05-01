<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Color Preferences</title>
		<style>
			body {
				font-family:Arial;
				background-color:<?php echo $_SESSION['bg'];?>;
			}
			
			#mainContent {
				text-align:center;
				padding:10px;
				width:750px;
				margin:auto;
				background-color:<?php echo $_SESSION['pc'];?>;
				color:<?php echo $_SESSION['fc'];?>;
			}
		</style>
	</head>
	<body>
		<?php 
			$colors = array("black","white","red","yellow","green","blue"
							,"aqua","fuchsia","gray","lime","maroon",
							"navy","olive","purple","silver","teal");
			sort($colors); 
		?>
		<div id="mainContent">
			<?php 
				$curr_colors = array( "bg"=>$_SESSION['bg'], 
										"fc"=>$_SESSION['fc'], 
										"pc"=>$_SESSION['pc'] );
			?>
			<form action="index.php" method="post">
				<p>Choose your preferred theme</p>
				<table>
					<tr>
						<td class="right">Background Color:</td>
						<td>
							<select name="bg">
								<?php  
									foreach( $colors as $s ) {
										echo "\t\t\t\t\t\t\t\t<option value='$s'"
												.($curr_colors["bg"] == $s 
													? "selected" : "")
												.">$s</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="right">Post Color:</td>
						<td>
							<select name="pc">
								<?php  
									foreach( $colors as $s ) {
										echo "\t\t\t\t\t\t\t\t<option value"
												."='$s'".($curr_colors["pc"] 
															== $s ? "selected" 
															: "")
												.">$s</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="right">Font Color:</td>
						<td>
							<select name="fc">
								<?php  
									foreach( $colors as $s ) {
										echo "\t\t\t\t\t\t\t\t<option value"
												."='$s'".($curr_colors["fc"] 
															== $s ? "selected" 
															: "")
												.">$s</option>";
									}
								?>
							</select>
						</td>
					</tr>
				</table>
				<div id="submitContainer">
					<input type="submit" value="Submit" />
				</div>
			</form>
		</div>
	</body>
</html>