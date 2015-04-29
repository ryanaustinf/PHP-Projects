<?php 
	session_start();
	$_SESSION['init'] = true;
	include "controller.php";
	
	require_once '../todo.php';
	$note = getFirstTodo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=US-ASCII">
<title>Insert title here</title>
	<style>
		html, body{
			height:100%;
			width:100%;
			margin:0px;
		}
		
		#mainContent {
			width:100%;
			height:100%;
			overflow-x:hidden;
		}
		
		div, p{
			margin:0px;
			color:#1D1E1E;
			font-size:30px;
		}
		
		#add{
			float:left;
			height: 100%;
			width: 10%;
			background-color:#EB4B55;
		}
			
		.nav{
			background-color:#F4B6AC;
			width:100%;
			height:15%;
		}
		
		#up p, #down p{
			position:relative;
			top:45%;
			right:50%:
		}
		
		#content p{
			position:relative;
			top:45%;
			left:20%;
		}
		
		#content button {
			position: relative;
			background-color:#0C817B;
			color:#AFF5AD;
			border:none;
			font-size:1.5em;
			top:250px;
			left:20%;
		}
		
		#add p{
			position:relative;
			top:45%;
			left:45%;
			color:#FFF7F3;
		}
		
		#content{
			background-color:#FFF7F3;
			width:100%;
			height:70%;
		}
		
		#adddiv{
			padding:5% 1% 1% 1% ;
			color:white;
			width:300px;
			height:87.5%;
			background-color:#EB4B55;
			float:left;
			/* position:absolute;
			left:-100%; */
		}
		
		input[type='text']{
			width: 250px;
			height: 50px;
			font-size:15px;
			padding-left: 20px;
			margin:10px 0px 0px 0px;
		}
	
		input[type='submit']{
			margin:10px 0px 0px 0px;
			width: 150px;
			height: 50px;
			background-color: #0C817B;
			color: #AFF5AD;
			border-radius: 3px;
			border : 0px;
			font-size : 25px;
		}
		
		input[type='submit']:hover{
			-webkit-box-shadow: 0px 1px 2px rgba(10,10,10,0.2);
		}
	</style>
	<script src="jquery-2.1.1.js"></script>
	<script>
		var id = <?php echo $note->getIdToDo(); ?>;

		function firstToDo() {
			$.ajax({
				url : 'controller.php',
				dataType : "json",
				data : { 'request' : 'first' },
				success : function(a) {
					console.log(a);
					$("#content p").text(a.note);
					id = a.idtodo;
					console.log( id );
				}
			});
		}
		
		function attachListeners() {
			$("#up").click(function(){
				$.ajax({
					url : "controller.php",
					method : 'GET',
					data : {
						"request" : "prev", 
						"id": id 
					},
					dataType: 'json',
					success : function(a) {
						$('#content p').text(a.note);
						console.log(a);
						id = a.idtodo;
					}
				});
			});
			$("#down").click(function(){
				$.ajax({
					url : "controller.php",
					method : 'GET',
					data : {
						"request" : "next", 
						"id": id 
					},
					dataType: 'json',
					success : function(a) {
						$('#content p').text(a.note);
						console.log(a);
						id = a.idtodo;
					}
				});
			});
			$("#add").click(function(){
				$("#adddiv").animate({width:'toggle'},350);
			});
			$("#done").click(function(){
				$.ajax({
					url : "controller.php",
					method : 'GET',
					data : {
						"request" : "done", 
						"id": id 
					},
					dataType: 'json',
					success : function(a) {
						$('#content p').text(a.note);
						console.log(a);
						id = a.idtodo;
						if( id == -1 ) {
							$("#up").unbind('click');
							$("#down").unbind('click');
							$("#add").unbind('click');
							$('#done').unbind('click');
							$('#done').hide();
							$("#adddiv").show(350);
						}
					}
				});
			});
		}
		
		$(document).ready(function(){
			if( id != -1 ) {
				attachListeners();
				$("#adddiv").hide();
			} else {
				$('#done').hide();
			}
		});
		
		function addNote() {
			if( $('#newNote').val().length == 0 ) {
				alert("No Note");
			} else {
				$.ajax({
					url : "controller.php",
					method : 'GET',
					data : { 
						"request" : "add",
						"note": $("#newNote").val() 
					},
					dataType: 'json',
					success : function(a) {
						$('#done').show();
						$("#newNote").val('');
						if( id == -1 ) {
							attachListeners();
						}
						$('#content p').text(a.note);
						console.log(a);
						id = a.idtodo;
					}
				});
			}
			
			return false;
		}
	</script>
</head>
<body>	
	<div id="mainContent">
		<!-- <form action="controller.php">
			<input type="hidden" name="request" value="done" />
			<input type="hidden" name="id" value="129" />
			<input type="submit" />
		</form>-->
		<div id="adddiv">
			Add Note : <br>
			<form action="add" method="GET" onSubmit="return addNote();">
				<input type="text" id="newNote" name="note" placeholder="Note"/><br>
				<input type="submit" value="Add"/>
			</form>
		</div>
		<div id="add">
			<p>+</p>
		</div>
		
		<div class="nav" id="up"></div>
		
		<div id="content">
			<p><?php echo $note->getNote(); ?></p>
			<button id='done'>Done</button>
		</div>
		
		<div class="nav" id="down"></div>
	</div>
</body>
</html>