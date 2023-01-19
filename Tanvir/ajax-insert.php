<?php 
  $conn = mysqli_connect("localhost","root","","test");
  $fname = $_POST['first_name'];
  $lname = $_POST['last_name'];

  $sql = "INSERT INTO students (first_name,last_name)values('$fname','$lname')";
  //$result = mysqli_query($conn,$sql);
  if(mysqli_query($conn,$sql)){
  	echo 1;
  }else{
  	echo 0;
  }
?>
