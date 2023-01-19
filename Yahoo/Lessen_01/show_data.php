<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ajex</title>
	<link rel="stylesheet" href="">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<table id='main' border="0" cellspacing="0" style="margin-left: 750px;">
		<tr>
			<td id="header">
				<h1>PHP with Ajax</h1>
			</td>
		</tr>
		<tr>
			<td id="table-load">
				<input type="button" id="load-button" value="Load Data" style="margin-left: 50px;">
			</td>
		</tr>
		<tr>
			<td id="table-data">
				<table border="1" width="100%" cellspacing="0" cellpadding="10px">
					<tr>
						<th>Id</th>
						<th>Name</th>
					</tr>
					<tr>
						<td align="center"> 1</td>
						<td>Manik Molla</td>
					</tr>
					
				</table>
			</td>
		</tr>
	</table>
	
  <script type="text/javascript">
  	$(document).ready(function(){
       $("#load-button").on("click",function(e){
           $.ajax({
               url:'ajax_load.php',
               type: "POST",
               success:function(data){ 
               	$("#table-data").html(data);
               }
           });
       });
  	});
  </script>
</body>
</html>