<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ajex</title>
	<link rel="stylesheet" href="">
	<!-- <script src="jquery-3.6.0.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>
	
	#success_message{
		background: #DEF1D8;
		color: green;
		padding: 10px;
		margin: 10px;
		display: none;
		position: absolute;
		right: 15px;
		top: 15px;

	}
	#success_message{
		background: #EFDCDD;
		color: RED;
		padding: 10px;
		margin: 10px;
		display: none;
		position: absolute;
		right: 15px;
		top: 15px;

	}
</style>
<body>
	<table id='main' border="0" cellspacing="0" style="margin-left: 550px;">
		<tr>
			<td id="header">
				<h1>Add Records with PHP & Ajax</h1>
			</td>
		</tr>
		<tr>		
			<td id="table-form">
				<form id="addForm">
					User Name:<input type="text" id="name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					User Age:<input type="text" id="age">
					<input type="submit" id="save-button" value="Save">
				</form>
			</td>
		</tr>
		<tr>
			<td id="table-data">
<!-- 				<table border="1" width="100%" cellspacing="0" cellpadding="10px">
					<tr>
						<th width="100%">Id</th>
						<th>Name</th>
					</tr>
					<tr>
						<td align="center"> 1</td>
						<td>Manik Molla</td>
					</tr>
				</table> -->
			</td>
		</tr>
	</table>
	<div id="error_message">
		
	</div>
	<div id="success_message">
		
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			
				function loadTable(){
					$.ajax({
		               url:'../Lessen_01/ajax_load.php',
		               type: "POST",
		               success:function(data){ 
		               	$("#table-data").html(data);
		               }
		           });
				}

			loadTable();

			$("#save-button").on("click", function(e){
				e.preventDefault();
				var u_name = $("#name").val();
				var u_age = $("#age").val();

				if(u_name == "" || u_age == ""){//check validation..
					$("#error_message").html("All fields are required.").slideDown();
					$("#success_message").slideUp();// jodio tita dehay taile eta off kore dibo.
				}else{
									$.ajax({
					url : "ajax_insert.php",
					type : "POST",
					data : {u_name:u_name, u_age:u_age},
					success : function(data){
						if(data == 1){
							loadTable();
							$("#addForm").trigger("reset");
							$("#success_message").html("Data inserted successfully..").slideDown();
							$("#error_message").slideUp();

						} else{
							//alert("");//after insert value than empty input fields.
							$("#error_message").html("Can't Save Record..").slideDown();
							$("#success_message").slideUp();
						}
						//loadTable();
					}
				});

				}

				// $.ajax({
				// 	url : "ajax_insert.php",
				// 	type : "POST",
				// 	data : {u_name:u_name, u_age:u_age},
				// 	success : function(data){
				// 		if(data == 1){
				// 			loadTable();
				// 			$("#addForm").trigger("reset");
				// 		} else{
				// 			alert("Can't Save Record.");//after insert value than empty input fields.
				// 		}
				// 		//loadTable();
				// 	}
				// });

			})
		});
	</script>
</body>
</html>