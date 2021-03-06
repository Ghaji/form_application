<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session->is_admin_logged_in()) {
	redirect_to('index.php');
}

if($_SESSION['role'] != 1) {
	redirect_to('home.php');
}

$file = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $file);
$file = $break[count($break) - 1];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>University of Jos, Nigeria</title>
		<?php
		require_once (LIB_PATH . DS . 'css.php');
		?>
	</head>

	<body>

		<!-- beginnning of main content-->
		<!-- header -->
		<?php
		include_layout_template('admin_header.php');
		?>
		<!-- //header -->
		<br>
		<br>

		<!-- Content -->
		<div class="row-fluid">

			<?php
			include_layout_template('admin_menu.php');
			?>

			<div class="span9">
				<h2>View Amount Details</h2>
				<hr>
						<?php
							$database = new MySQLDatabase();
							$result = $database->query("SELECT * FROM `form_amount`, `faculty` WHERE form_amount.student_status = faculty.faculty_code");
							$pagecounter = 1;
							$serialno = 1;
							$max = 10;
							$number_of_amounts = $database->num_rows($result);
							echo '<div class="tabbable">
								<div class="tab-content">';
							while ($row = $database->fetch_array($result)) {
								if($serialno % $max == 1){
									if($pagecounter == 1){
										echo '<div class="tab-pane active" id="'.$pagecounter.'">';
									}
									else {
										echo '<div class="tab-pane" id="'.$pagecounter.'">';
									}
									echo '<table class="table table-hover">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Programme</th>
											<th>Amount</th>
											<th>Account</th>
										</tr>
									</thead>
									<tbody>';
									}
									echo '<form action="edit_amount.php" method="POST">
									<tr>
										<td>'.$serialno.'</td>
										<td>'.$row["faculty_name"].'</td>
										<td>'.$row["amount"].'</td>
										<td>'.$row["pay_item_id"].'</td>';
										
										echo '<td><button type="submit" class="btn btn-info" name="edit_amount">Edit</button></td>
										
									</tr>
									<input type="hidden" name="amount_id" value="'.customEncrypt($row["amount_id"]).'" />
									<input type="hidden" name="from" value="'.customEncrypt($file).'" />
									</form>';
									if($serialno % $max == 0){
										echo '</tbody>';
										echo '</table>';
										
										echo '</div>';
										$pagecounter++;
									}
									elseif($serialno == $number_of_amounts){
										echo '</tbody>';
										echo '</table>';
							
										echo '</div>';
									}
								$serialno++;
							}
							echo '</div>
								</div>';
						?>
				
				<?php
				if($serialno > $max){
					echo'
					<div class="pagination pagination-centered">
	                  <ul>
	                    <li><a class="left prev" href="#">Prev</a></li>
	                    
	                    <li><a class="right next" href="#">Next</a></li>
	                  </ul>
	                </div>';
					echo '<input type="hidden" id="pg_num" value="'.$pagecounter.'">';
				}
				?>
			</div>
            
		</div>
		<!-- //Content -->

		<?php include_layout_template("footer.php"); ?>
	</body>
</html>

<?php
require_once (LIB_PATH . DS . 'javascript.php');
?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<script src="js/pagination.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>