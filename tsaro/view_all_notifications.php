<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session -> is_admin_logged_in()) {
	redirect_to('index.php');
}

function show_role($role_num, $staff_no, $dept=""){
	switch ($role_num) {
		case 1:
			$admin_role = $staff_no.' - Main Administrator';
			break;
		case 2:
			$admin_role = $staff_no.' - Post Graduate Administrator';
			break;
		case 3:
			$admin_role = $staff_no.' - Non NUC Programmes';
			break;
		case 4:
			$admin_role = $staff_no.' - Departmental Administrator - '.$dept;
			break;
		case 5:
			$admin_role = $staff_no.' - Admission Officer';
			break;
	}
	return $admin_role;
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
				<h2>All Notifications</h2>
				<hr>
						<?php 
							$database = new MySQLDatabase();
							$active_notifications = "SELECT * FROM `notifications` as n JOIN `admin_users` as a WHERE n.user_id = a.user_id AND recipient = ".$_SESSION['applicant_id'];
							$result = $database->query($active_notifications);
							$pagecounter = 1;
							$serialno = 1;
							$max = 10;
							$number_of_notifications = $database->num_rows($result);
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
											<th>Sender</th>
											<th>Title</th>
											<th>Date</th>
											<th>Time</th>
											<th>Status</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>';
									}
									echo '<form action="view_notification.php" method="POST">
									<tr>
										<td>'.$serialno.'</td>
										<td>'.show_role($row["role"], $row["staff_id"], $row["department_id"]).'</td>
										<td>'.$row["title"].'</td>
										<td>'.$row["notification_date"].'</td>
										<td>'.$row["notification_time"].'</td>';
										
										if($row["status"] == 1){
											echo '<td><span class="label label-success">Active</span></td>';
										} else {
											echo '<td><span class="label label-important">Inactive</span></td>';
										}
										
										echo '<td><button type="submit" class="btn btn-info" name="read_notification">View</button></td>
										
									</tr>
									<input type="hidden" name="nid" value="'.customEncrypt($row["notification_id"]).'" />
									<input type="hidden" name="from" value="'.customEncrypt($file).'" />
									</form>';
									if($serialno % $max == 0){
										echo '</tbody>';
										echo '</table>';
										
										echo '</div>';
										$pagecounter++;
									}
									elseif($serialno == $number_of_notifications){
										echo '</tbody>';
										echo '</table>';
							
										echo '</div>';
									}
								$serialno++;
							}
							echo '</div>
								</div>';
								
							if($number_of_notifications == 0){
								echo '<p>You have no notification.</p>';
							}
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