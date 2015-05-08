<html>
	<head>
		<title><?php echo "My First PHP Page"; ?></title>
		<link rel="stylesheet" href="external.css" />
		<script src="jquery-2.1.1.js"></script>
		<script src="listSelection.js"></script>
		<script>
			<?php 
				if( isset($_POST['left']) ) {
					echo "leftItems = ".$_POST['left']."\n";
					setCookie( 'left',$_POST['left'],time() + 2**31 - 1
							,"/");
				} elseif( isset($_COOKIE['left'])) {
					echo "leftItems = ".$_COOKIE['left']."\n";
				} else {
					echo "leftItems = [\n"
			 				."\t\t\t\t'apple',\n"
						 	."\t\t\t\t'banana',\n"
						 	."\t\t\t\t'cheese',\n"
						 	."\t\t\t\t'doritos',\n"
						 	."\t\t\t\t'eggs'\n"
						 ."\t\t\t];\n\n";
				}
				
				if( isset($_POST['right']) ) {
					echo "\t\t\trightItems = ".$_POST['right']."\n";
					setCookie('right',$_POST['right'],time() + 2**31 - 1
								,"/");
				} elseif( isset($_COOKIE['right'] ) ) {
					echo "\t\t\trightItems = ".$_COOKIE['right']."\n";
				} else {
					echo "rightItems = [\n"
			 				."\t\t\t\t'French mustard',\n"
						 	."\t\t\t\t'ginger',\n"
						 	."\t\t\t\t'hotdog',\n"
						 	."\t\t\t\t'Indian beef',\n"
						 	."\t\t\t\t'jelly'\n"
						 ."\t\t\t];";
				}
			?>

			function checkDB() {
				$.ajax({
					url : "db.php",
					method : "POST",
					success : function(a) {
						if( a == 'true') {
							$("#check").text("There Are False Rows!");
						} else {
							$("#check").text("No False Rows!");
						}
					}
				});
			}
				
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

			function cookify() {
				var str = '[';
				for( var i in leftItems ) {
					str += "'" + leftItems[i] + "'";
					if( i < leftItems.length - 1 ) { 
						str += ",";
					}
				}
				str += ']';
				$("#hello #left").val(str);
				var str = '[';
				for( var i in rightItems ) {
					str += "'" + rightItems[i] + "'";
					if( i < rightItems.length - 1 ) { 
						str += ",";
					}
				}
				str += ']';
				$("#hello #right").val(str);
				$.ajax({
					url : "cookify.php",
					method : "POST",
					data : {
						'left' : $("#hello #left").val(),
						'right' : $("#hello #right").val()
					}
				}); 
			}

			$(document).ready(function() {
				setInterval( checkDB, 100 );
				$("#sumForm").submit(submitSum);

				$("#hello").submit(function() {
					$("#hello #num1").val($("#sumForm #num1").val());
					$("#hello #num2").val($("#sumForm #num2").val());
					$("#hello #res").val($("#result").html());
					cookify();
				});

				initList();
				buttonListeners();
				$("button[id$='Left'], button[id$='Right']").click(function() {
					cookify();
				});		

				var timer;

				$("#activate").click(function() {
					if( $(this).text() == 'Go' ) {
						timer = setInterval(function() { 
							var d = new Date();
							$("#time").html(d);
						},1000);
						$('#activate').text("Stop");
					} else {
						clearInterval(timer);
						$("#activate").text("Go");
					}
				});

				$("#activate").click();

				$("#flipPic").mousedown(function(e) {
					$("#flip").attr('src','Cartman.jpg');
					$(this).text('Butters');
					e.preventDefault();
				});

				$("#flipPic").mouseup(function() {
					$("#flip").attr('src','Butters.jpg');
					$(this).text('Cartman');
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
			
			interface iClass {
				public function expose();
			}
			
			class Test implements iClass {
				private $var1;
				private $var2;
				private $var3;
				
				public function __construct($var1,$var2) {
					$this->var1 = $var1;
					$this->var2 = $var2;
				}
				
				public function __get($name) {
					if( isset($this->$name) ) {
						return $this->$name;
					} else {
						return null;
					}
				}
				
				public function __set($name, $value) {
					$temp = $this->expose();
					foreach( $temp as $k=>$v) {
						if( $k === $name ) {
							$this->$name = $value;
							break;
						}
					}
				}
				
				public function __isset($name) {
					return isset($this->$name);
				}
				
				public function __unset($name) {
					$temp = $this->expose();
					foreach( $temp as $k=>$v ) {
						if( $name === $k ) {
							switch( $k ) {
								case "var1":
								case "var2":
									$this->$k = 0;
									break;
								case "var3":
									$this->$k = null;
									break;
								default:
							}
							break;
						}
					} 
				}
				
				public function expose() {
					$temp = get_object_vars($this);
					$temp2 = $temp;
					$temp = &$temp2;
					$temp3 = $this->var3;
					while( $temp2['var3'] != null ) {
						$temp2['var3'] = $temp3->expose();
						$temp2 = &$temp2['var3'];
						$temp3 = $temp3->var3;
					}
					return $temp;
				}
				
				public function __toString() {
					return json_encode($this->expose());
				}
			}
			
			$test = new Test(3,4);
			$test->var3 = new Test(5,6);
			$test2 = $test->var3;
			$test2->var3 = new Test(7,8);
			echo "<br/>";
			echo "\n\n".$test."<br/>\n";
			$test2 = array();
			for( $i = 0; $i < 10; $i++ ) {
				if( $i == 0 ) {
					$test2[$i] = $test;
				} else {
					$test2[$i] = new Test($i,$i);
				}
			}
			$test3 = array();
			foreach( $test2 as $var ) {
				$test3[] = $var->expose();
			}
			echo json_encode($test3)."<br/>";
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
		
		<form id="hello" action="<?php echo $_SERVER['PHP_SELF'];?>" 
			method="post">
			<input type="text" class="name" name="name" />
			<input type="hidden" id="num1" name="num1" />
			<input type="hidden" id="num2" name="num2" />
			<input type="hidden" id="left" name="left" />
			<input type="hidden" id="right" name="right" />
			<input type="hidden" id="res" name="res" />
		</form>
		
		<div id="listBox">
			<div id="leftBox"></div>
			<div id="listButtons">
				<button id="moveRight">&gt;</button>
				<button id="moveLeft">&lt;</button>
				<button id="allRight">&gt;&gt;</button>
				<button id="allLeft">&lt;&lt;</button>
			</div>
			<div id="rightBox"></div>
		</div>
		
		<div id="react">
			<div>
				<img id="flip" src="Butters.jpg" /><br/>
				<button id="flipPic">Cartman</button>
			</div>
			<h3 id="result"></h3>
			<h4 id="time"></h4>
			<h5 id="check"></h5>
			<button id="activate">Go</button>
		</div>
		
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