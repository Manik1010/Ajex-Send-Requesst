<?php
$conn = mysqli_connect("localhost","root","","test");
$limit_per_page = 3;

$page = "";
if(isset($_POST["page_no"])){
   $page = $_POST["page_no"]; 

}else{
   $page = 1;
}
$offset = ($page - 1) * $limit_per_page;

$sql  = "SELECT * from students
         LIMIT $offset,$limit_per_page";
$result = mysqli_query($conn,$sql);
$output = "";
if(mysqli_num_rows($result)>0){
	$output = '
         <table class="table table-bordered w-50"style="margin-left: 25%">
		  	 <tr class="bg-dark">	
		          <th style="color:white;width:100px;">Id</th>
		          <th style="color:white;">Name</th>
		          <th style="color:white;width:200px;">Action</th>
		  	 </tr>
         '; 
         while($row = mysqli_fetch_assoc($result)){
         $output .= "
                     <tr>
				  	 	  <td>{$row["id"]}</td>
				  	 	  <td>{$row["first_name"]}  {$row["last_name"]}</td>
				  	 	  <td>
				  	 	      <button class='btn btn-info edit-btn' data-bs-toggle='modal'data-bs-target='#editModal' data-eid='{$row["id"]}'>Edit</button>
                              <button class='btn btn-danger delete-btn' data-id='{$row["id"]}'>Delete</button>
				  	 	  </td>
				  	 </tr>
                   ";
          }
    $output .= "</table>";
    
    $sql_total = "SELECT * from students";
    $records = mysqli_query($conn,$sql_total);
    $total_records = mysqli_num_rows($records);
    $total_pages = ceil($total_records/$limit_per_page);
    $output .= "<ul class='pagination'style='margin-left:37%;' >";
    for($i=1;$i<=$total_pages;$i++){
    	if($i==$page){
    		$class_name = "active";
    	}else{
    		$class_name ="";
    	}
	    $output .= " <a class='{$class_name} page-link m-2' href=''  id='{$i}'>{$i}</a>";
    }
    $output .="  </ul> ";
    mysqli_close($conn);
    echo $output;
}else{
	echo"<h2> no Record found</h2>";
}