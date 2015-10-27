<?php require_once("inc/initialize.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php 
	require_once(LIB_PATH.DS.'javascript.php');
	require_once(LIB_PATH.DS.'css.php');
?>
</head>
<body>
<?php include_layout_template("header.php"); ?>

<!--The Main Content Here Please-->


<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span9" >
			<h4>Developers Page</h4>
	        <hr>	
	 	</div>
	</div>
	
	<table class="table table-hover table-stripped">
		<thead>
			<tr>
				<th>S/N</th>
				<th>Passport</th>
				<th>Full Name</th>
				<th>Email</th>
                <th>Details</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$db = new MySQLDatabase();
				$credits = $db->query("SELECT * FROM credits WHERE status='active' ORDER BY credit_id ASC");
				$numrows = $db->num_rows($credits);
				$passport_path =  "documents" .DS. "credit_passports" .DS;
				$serial_no = 1;
				$numrows;
				while($row = $db->fetch_array($credits)){
				$mail = str_replace("@","[at]",$row["email"]);
				if(empty($numrows)){
					
					echo '<tr><td colspan="5" align="center">No Information Uploaded for the developer\'s Team</td></tr>';
				}else{
					
					echo '<tr>
						<td>'.$serial_no.'</td>
						<td><div class="thumbnail" style="width: 100px; height: 133px;"><img src="'.$passport_path.$row["passport"].'" width="100px" height="90px"></div></td>
						<td>'.$row["fullname"].'</td>
						<td>'.$mail.'</td>
						<td><a href="developer_details.php?id='.customEncrypt($row["credit_id"]).'" class="btn">More...</a></td>
					</tr>';
					$serial_no++;
				}
				
				}
			?>
            <tr><td colspan="5" align="center"><a href="index.php" class="btn btn-info">Back to Home Page</a></td></tr>
		</tbody>
		
	</table>
	
</div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>
 
