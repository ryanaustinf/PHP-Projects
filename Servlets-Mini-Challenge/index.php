<?php 
	session_start();
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		$_SESSION['bg'] = $_POST['bg'];
		$_SESSION['pc'] = $_POST['pc'];
		$_SESSION['fc'] = $_POST['fc'];
		setcookie('colors',$_SESSION['bg'].",".$_SESSION['pc'].","
					.$_SESSION['fc'],time() + 86400,"/");
	} elseif( isset($_COOKIE['colors']) ) {
		$colors = str_getcsv($_COOKIE['colors']);
		$_SESSION['bg'] = $colors[0];
		$_SESSION['pc'] = $colors[1];
		$_SESSION['fc'] = $colors[2];
	} else {
		$_SESSION['bg'] = "black";
		$_SESSION['pc'] = "green";
		$_SESSION['fc'] = "white";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Insert title here</title>
		<style>
			body {
				font-family:Arial;
				background-color:<?php echo $_SESSION['bg'];?>;
			}
			
			#post {
				background-color:<?php echo $_SESSION['pc'];?>;
				color:<?php echo $_SESSION['fc'];?>;
				text-align:center;
				width:750px;
				padding:20px;
				margin:20px auto;
			}
		</style>
	</head>
	<body>
		<div id="post">
			<h1>Centuries</h1>
			<h2>Fall Out Boy</h2><br />
			
			Du du du du-du du du du<br />
			Du du du du du-du du du<br />
			
			Some legends are told<br />
			Some turn to dust or to gold<br />
			But you will remember me<br />
			Remember me for centuries<br />
			And just one mistake<br />
			Is all it will take.<br />
			We'll go down in history<br />
			Remember me for centuries<br />
			Hey, hey, hey<br />
			Remember me for centuries<br /><br />
			
			Mummified my teenage dreams<br />
			No, it's nothing wrong with me<br />
			The kids are all wrong,<br />
			The story's all off<br />
			Heavy metal broke my heart<br /><br />
			Come on, come on and let me in<br />
			The bruises on your thighs like my fingerprints<br />
			And this is supposed to match<br />
			The darkness that you felt<br />
			I never meant for you to fix yourself<br /><br />
			
			Du du du du-du du du du<br />
			Du du du du du-du du du<br /><br />
			
			Some legends are told<br />
			Some turn to dust or to gold<br />
			But you will remember me<br />
			Remember me for centuries<br />
			And just one mistake<br />
			Is all it will take.<br />
			We'll go down in history<br />
			Remember me for centuries<br /><br />
			
			And I can't stop 'til the whole world knows my name<br />
			'Cause I was only born inside my dreams<br />
			Until you die for me, as long as there is a light, 
				my shadow's over you<br />
			'Cause I am the opposite of amnesia<br />
			And you're a cherry blossom<br />
			You're about to bloom<br />
			You look so pretty, but you're gone so soon<br /><br />
			
			Du du du du-du du du du<br />
			Du du du du du-du du du<br /><br />
			
			Some legends are told<br />
			Some turn to dust or to gold<br />
			But you will remember me<br />
			Remember me for centuries<br />
			And just one mistake<br />
			Is all it will take.<br />
			We'll go down in history<br />
			Remember me for centuries<br /><br />
			
			We've been here forever<br />
			And here's the frozen proof<br />
			I could scream forever<br />
			We are the poisoned youth<br /><br />
			
			Du du du du-du du du du<br />
			Du du du du du-du du du</p><br />
			
			Du du du du-du du du du<br />
			Du du du du du-du du du<br /><br />
			
			Some legends are told<br />
			Some turn to dust or to gold<br />
			But you will remember me<br />
			Remember me for centuries<br />
			And just one mistake<br />
			Is all it will take.<br />
			We'll go down in history<br />
			Remember me for centuries<br />
			We'll go down in history<br />
			Remember me for centuries
		</div>
		<div id="post">
			<h1>Still Into You</h1>
			<h2>Paramore</h2><br />
			
			Can't count the years on one hand<br />
			That we've been together<br />
			I need the other one to hold you<br />
			Make you feel, make you feel better<br /><br />
			
			It's not a walk in the park<br />
			To love each other<br />
			But when our fingers interlock,<br />
			Can't deny, can't deny you're worth it<br />
			'Cause after all this time I'm still into you<br /><br />
			
			I should be over all the butterflies<br />
			But I'm into you (I'm into you)<br />
			And baby even on our worst nights<br />
			I'm into you (I'm into you)<br /><br />
			
			Let 'em wonder how we got this far<br />
			'Cause I don't really need to wonder at all<br />
			Yeah, after all this time I'm still into you<br /><br />
			
			Recount the night that<br />
			I first met your mother<br />
			And on the drive back to my house<br />
			I told you that, I told you that I loved ya<br /><br />
			
			You felt the weight of the world<br />
			Fall off your shoulder<br />
			And to your favorite song<br />
			We sang along to the start of forever<br />
			And after all this time I'm still into you<br /><br />
			
			I should be over all the butterflies<br />
			But I'm into you (I'm into you)<br />
			And baby even on our worst nights<br />
			I'm into you (I'm into you)<br />
			Let 'em wonder how we got this far<br />
			'Cause I don't really need to wonder at all<br />
			Yeah, after all this time I'm still into you<br /><br />
			
			Some things just, some things just make sense<br />
			And one of those is you and I (Hey)<br />
			Some things just, some things just make sense<br />
			And even after all this time (Hey)<br /><br />
			
			I'm into you, baby, not a day goes by<br />
			That I'm not into you<br /><br />
			
			I should be over all the butterflies<br />
			But I'm into you (I'm into you)<br />
			And baby even on our worst nights<br />
			I'm into you (I'm into you)<br />
			Let 'em wonder how we got this far<br /><br />
			
			'Cause I don't really need to wonder at all<br />
			Yeah, after all this time<br />
			I'm still into you<br />
			I'm still into you<br />
			I'm still into you 
		</div>
		<div id="post">
			<a href="preferences.php">Set Preferences</a>
		</div>
	</body>
</html>