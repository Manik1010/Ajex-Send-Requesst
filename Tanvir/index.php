<!DOCTYPE html>
<html>
<head>
	<title>First tutorial</title>
	<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
  .pagination a{
    color:black;
  }
	.pagination a:hover{
     background-color: black;
     color:white;
  }
  .pagination a.active{
    background-color: black;
    color:white;
  }
</style>
<body>
  <div class="row bg-success p-3">
     <div class="col"></div>
     <div class="col"><h1 style="color:white;">Php With Ajax </h1></div>
  	 <div class="col" id="search-bar">
         <label style="font-size: 24px;color:yellow;"><b>Search:</b></label> 
         <input type="text" id="search" class="form-control"autocomplete="off">
     </div>
  </div>
  <form id="addForm">
       <div class="row bg-secondary p-3" >
    
    	    <div class="col"></div>
  		  	<div class="col">
  		  		  <b style="color:yellow;">First Name</b>
  		  		  <input type="text" id="firstName">
  		  	</div>
  		  	<div class="col">
  		  		 <b style="color:yellow;">Last Name</b>
  		  		  <input type="text" id="lastName">
  		  	</div>
  		  	<div class="col">
  		  		<input type="submit" id="save-button" value="save" class="btn btn-warning">
  		  	</div>
    
       </div>
</form>


<div id="error-msg" class="bg-danger mt-2 w-50 p-2" style="display: none;text-align: center;margin-left: 25%;color:white;" ></div>
  <div id="success-msg" class="bg-success mt-2 w-50 p-2" style="display: none;text-align: center;margin-left: 25%;color:white;"></div>
  <div class="row mt-2" id="table-data">	
		 

           
             
         
         
  </div>
  


<!-- Modal -->
<div id="modal">
	<div class="modal" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-hidden="true" >
      <div class="modal-dialog" >
        <div class="modal-content" id="modal-form">
    	      <div class="modal-header">
    	        <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
    	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    	      </div>
    	      <div class='modal-body' id="body-info">
                  
    	      </div>
    	     
        </div>
      </div>
  </div>
</div>


  <script type="text/javascript">
  	$(document).ready(function(){
       
          function loadTable(page){
          	 $.ajax({
               url:'ajax-load.php',
               type: "POST",
               data:{page_no:page},
               success:function(data){
               	$("#table-data").html(data);
               }
           });
          }
          loadTable(1);

          $("#save-button").on("click",function(e){
              e.preventDefault();

              var fname = $("#firstName").val();
              var lname = $("#lastName").val();
              if(fname=="" || lname == ""){
              	$("#error-msg").html("<h5>All field are required</h5>").slideDown();
              	$("#success-msg").slideUp();
              }else{
              	 $.ajax({
	                 url:'ajax-insert.php',
	                 type: "POST",
	                 data:{
	                 	first_name:fname,
	                 	last_name :lname
	                 },
	                 success:function(data){
	                 	   if(data==1){
	                 	   	 loadTable();
	                 	   	 $("#addForm").trigger("reset");
	                 	   	 $("#success-msg").html("<h5>Data inserted successfully.<h5>").slideDown();
              	             $("#error-msg").slideUp();
	                 	   }else{
	                 	   	
	                 	   	$("#error-msg").html("<h5>Can't save record</h5>").slideDown();
              	            $("#success-msg").slideUp();
	                 	   }
	                       
	                 }
	              });
              } 

          });
          //delete record
          $(document).on("click",".delete-btn",function(){
              if(confirm("Do you really want to delete this record?")){
              	  var studentId = $(this).data("id"); // .delete-btn holo = this
	              var element = this;
	              $.ajax({
	                  url:"ajax-delete.php",
	                  type: "POST",
	                  data:{
	                  	id:studentId
	                  },
	                  success:function(data){
	                  	if(data==1){
	                        $(element).closest("tr").fadeOut();
	                  	}else{
	                       $("#error-msg").html("<h5>Can't delete data</h5>").slideDown();
	              	            $("#success-msg").slideUp();
	                  	}
	                  }
	              });
              }
             
          });
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

          //Live search
          $("#search").on("keyup",function(){
              var search_term = $(this).val();
              $.ajax({
                   url:"ajax-live-search.php",
                   type: "POST",
                   data:{ search: search_term},
                   success:function(data){
                      $("#table-data").html(data);
                   }
              });
          }); 

          //Pagination Code
          $(document).on("click",".pagination a",function(e){
               e.preventDefault();
               var page_id = $(this).attr("id");
               loadTable(page_id);
          });
       });
  	
  </script>
</body>
</html>
