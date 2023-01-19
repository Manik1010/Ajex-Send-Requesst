<?php 
	
	$name = $_POST['u_name'];
	$age = $_POST['u_age'];

	// echo $name;
	// echo $age;
	// die();

	$conn = mysqli_connect('localhost', 'root', '', 'students') or die("Connection Faild.");

	$sql = "INSERT INTO students(name, age) VALUES ('{$name}','{$age}' )";

	if(mysqli_query($conn, $sql)){
		echo 1;

	}else {
		// code...
		echo 0;
	}
?>