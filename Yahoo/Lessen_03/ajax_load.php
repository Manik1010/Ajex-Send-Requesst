<?php 
	$conn = mysqli_connect('localhost', 'root', '', 'students') or die("Connection Faild.");

	$sql = "select * from students";
	$result = mysqli_query($conn, $sql) or die("SQL Query Faild.");
	//$row = mysqli_fetch_assoc($result);

	// echo $row["name"];
	// die();

	$output = "";

	if(mysqli_num_rows($result) > 0){
		$output = '<table border="1" width="100%"  cellspacing="0" cellpadding="10px"> 
						<tr>
							<th width="100px">Id</th>
							<th width="100px">Name</th>
							<th width="100px">Action</th>
						</tr>';

					while ($row = mysqli_fetch_assoc($result)) {
						// code...
						$output .="<tr>
									<td>{$row["id"]}</td>
									<td>{$row["name"]} {$row["age"]}</td>
									<td> <button class='delete-btn' data-id = '{$row["id"]}' >Delete</button> </td>
								   </tr>
								   ";   //. means concordtition.
					}

		$output .="</table";
		mysqli_close($conn);// Close data Base here...

		echo $output;// its not print it's return show_data.php in resultData

	}else {
		// code...
		echo "<h1>No Record Found.</h1>";

	}
?>