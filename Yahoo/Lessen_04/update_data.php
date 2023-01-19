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
	.delete-btn{
		background: red;
		color: #fff;
		border: 0;
		padding: 4px 10px;
		border-radius: 3px;
		cursor: pointer;/* like pointer...*/
	}
</style>
<body>
	<table id='main' border="0" cellspacing="0" style="margin-left: 550px;">
		<tr>
			<td id="header">
				<h1>Update Records with PHP & Ajax</h1>
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
				// Show here....
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
		               url:'ajax_load.php',
		               type: "POST",
		               success:function(data){ 
		               	$("#table-data").html(data);
		               }
		           });
				}

			loadTable();// Load Table Records on page Load


			// Insert New Data 
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
					}
				});

				}

			})

  //load update data
          $(document).on("click",".edit-btn",function(){

               var studentId = $(this).data("eid"); // .edit-btn holo = this
	           var element = this;
	            $.ajax({
	                  url:"load-update-form.php",
	                  type: "POST",
	                  data:{
	                  	id:studentId
	                  },
	                  success:function(data){
	                  	$("#body-info").html(data);
	                  }
	            });
          });
          //save Update form
          $(document).on("click","#edit-submit",function(){
               var studentId = $("#edit-id").val();
               var fname     = $("#edit-fname").val();
               var lname     = $("#edit-lname").val();

               $.ajax({
               	   url: 'ajax-update-form.php',
               	   type: "POST",
               	   data: {
               	   	   id: studentId,
               	   	   fname: fname,
               	   	   lname: lname
               	   },
               	   success:function(data){
               	   	   if(data==1){
                          $("#success-msg").html("<h5>data updated successfully data</h5>").slideDown();
                              $("#error-msg").slideUp();
               	   	   	  loadTable();
               	   	   }
               	   	  
               	   }
               });
          });
		});
	</script>
</body>
</html>