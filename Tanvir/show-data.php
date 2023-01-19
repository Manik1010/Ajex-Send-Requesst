<!DOCTYPE html>
<html>
<head>
	<title>First tutorial</title>
	<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="row bg-success p-3">
  	  <h1 align="center">Php With Ajax First Tutorial</h1>
  </div>
  <div class="row bg-light p-3">
  	<button class="btn btn-outline-info" style="width: 100px;margin-left: 48%" id="load-button">Load Data</button>
  </div>
  <div class="row" id="table-data">	
		 
  </div>
  <script type="text/javascript">
  	$(document).ready(function(){
       $("#load-button").on("click",function(e){
           $.ajax({
               url:'ajax-load.php',
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
