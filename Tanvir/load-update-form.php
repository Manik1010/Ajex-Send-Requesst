<?php 
  $studentId = $_POST['id'];
  $conn = mysqli_connect("localhost","root","","test");
$sql  = "SELECT * from students where id = '$studentId'";
$result = mysqli_query($conn,$sql);

$output = "";
if(mysqli_num_rows($result)>0){
	$data = mysqli_fetch_assoc($result);
         
         $output .= "
                    
				        <div class= 'mb-3'>
						  <label for='fname' class='form-label'> First Name</label>
						  <input type='text' class='form-control' id='edit-fname' value='{$data['first_name']}' >
						  <input  id='edit-id' hidden value='{$data['id']}' >
						</div>
						<div class='mb-3'>
						  <label for='lname' class='form-label'> Last Name</label>
						  <input type='text' class='form-control' id='edit-lname' value='{$data['last_name']}' >
						</div>
						<div class='modal-footer'>
					        <button type='button' class='btn btn-primary' id='edit-submit' data-bs-dismiss='modal'>Edit</button>
					        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
	        
	                    </div>
				     
                   ";
          
  
    mysqli_close($conn);
    echo $output;
}else{
	echo"<h2>Record no found</h2>";
}
?>
