<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Insert Pirtucler Place</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<select>
		<table>
			<tr>
				<td>
					<h1>Load Records using Select Box <br>
        			with PHP & Ajax</h1>
				</td>
			</tr>
			<tr>
				<td>
					<form>
						Select City :<select id="this_id">
							<option value="">Select City</option>
						</select>
					</form>
				</td>
			</tr>
			<tr>
				<td id="show_table-data">
					
				</td>
			</tr>
		</table>
	</select>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $.ajax({
      url : "load-city.php",
      type : "POST",
      dataType : "JSON",
      success : function(data){
        $.each(data, function(key, value){
          $("#city-box").append("<option value='" + value.city + "'>" + value.city + "</option>");
        });
      }
    });

    // Load Table Data
    $("#city-box").change(function(){
      var city = $(this).val();

      if(city == ""){
        $("#table-data").html("");
      }else{
        $.ajax({
          url : "load-table.php",
          type : "POST",
          data : { city : city },
          success : function(data){
            $("#table-data").html(data);
          }
        });
      }
    })
  });
</script>
</body>

</html>
