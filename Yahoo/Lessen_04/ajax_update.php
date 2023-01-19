<?php 
	
	$id = $_POST['s_id'];

	$conn = mysqli_connect('localhost', 'root', '', 'students') or die("Connection Faild.");

	$sql = "DELETE from students where id = {$id}";

	if(mysqli_query($conn, $sql)){
		echo 1;

	}else {
		// code...
		echo 0;
	}
?>