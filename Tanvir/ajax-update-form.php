<?php 
$id    = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$conn = mysqli_connect("localhost","root","","test");
 $sql = "UPDATE  students set
         first_name = '$fname',
         last_name  = '$lname'
         where id='$id'";
if(mysqli_query($conn,$sql)){
  	echo 1;
  }else{
  	echo 0;
  }
