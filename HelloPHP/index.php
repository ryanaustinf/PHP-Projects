<html>
	<head>
		<title><?php echo "My First PHP Page"; ?></title>
		<script src="jquery-2.1.1.js"></script>
		<script>
			function checkInput() {
				var res = "";
				var err = false;
				var num1 = $("#num1").val();
				var num2 = $("#num2").val();
				
				if( isNaN(num1) ) {
					res += 'Num 1 is not a number';
					err = true;
				}

				if( isNaN(num2) ) {
					res += (err ? "\n" : "" ) + 'Num 2 is not a number';
				}

				if( res.length == 0 ) {
					return true;
				} else {
					alert( res );
					return false;
				}
			}

			function submitSum(index, elem) {
				if( checkInput() ) {
					$.ajax({
						'url' : 'sum.php',
						'data' : {
							'num1' : $("#num1").val(),
							'num2' : $("#num2").val()
						},
						'success' : function(a) {
							$("#result").html(a);
						}
					});
				}

				return false;
			}

			$(document).ready(function() {
				$("#sumForm").submit(submitSum);

				$("#hello").submit(function() {
					$("#hello #num1").val($("#sumForm #num1").val());
					$("#hello #num2").val($("#sumForm #num2").val());
					$("#hello #res").val($("#result").html());
				});
			});
		</script>
	</head>
	<body>
		<?php 
			$text = null;
			if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
				$text = $_POST['name'];
			} else {
				$text = "World";
			}
			echo "\t\t<h1>Hello $text</h1>\n";
			echo "\t\t<h2>Hello $text</h2>\n";
			echo "\t\t<h3>Hello $text</h3>\n";
			echo "\t\t<h4>Hello $text</h4>\n";
			echo "\t\t<h5>Hello $text</h5>\n";
			echo "\t\t<h6>Hello $text</h6>\n";
		?>
		<br />
		
		<form id="sumForm">
			<table>
				<tr>
					<td>Num1</td>
					<td><input id="num1" name="num1" type="text" required></td>
				</tr>
				<tr>
					<td>Num2</td>
					<td><input id="num2" name="num2" type="text" required></td>
				</tr>
				<tr>
					<td><input type="submit" value="Add"></td>
				</tr>
			</table>
		</form>
		
		<form id="hello" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<input type="text" class="name" name="name" />
			<input type="hidden" id="num1" name="num1" />
			<input type="hidden" id="num2" name="num2" />
			<input type="hidden" id="res" name="res" />
		</form>
		
		<h3 id="result"></h3>
		
		<?php 
			if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
				echo '<script>'."\n";
				echo "\t\t\t$('#sumForm #num1').val('".$_POST["num1"]."');\n";
				echo "\t\t\t$('#sumForm #num2').val('".$_POST["num2"]."');\n";
				echo "\t\t\t$('#hello .name').val('".$_POST["name"]."');\n";
				echo "\t\t\t$('#result').html('".$_POST["res"]."');\n";
				echo "\t\t".'</script>'."\n\n";
			}
		?>
	</body>
</html>