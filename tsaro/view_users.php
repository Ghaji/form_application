<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if(!$session -> is_admin_logged_in()) {
	redirect_to('index.php');
}

$role = $_SESSION['role'];
switch ($role) {
	case 1:
		
		break;
	
	default:
		redirect_to('home.php');
		break;
}
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
				<h2>Users</h2>
				<hr>
						<?php 
							$database = new MySQLDatabase();
							$select_users_sql = "SELECT * FROM `admin_users` adu, admin_roles adr WHERE adu.role = adr.admin_role_id ORDER BY adu.`staff_id` ASC";
							$users_result = $database->query($select_users_sql);
							$pagecounter = 1;
							$serialno = 1;
							$max = 10;
							$number_of_users = $database->num_rows($users_result);
							echo '<div class="tabbable">
								<div class="tab-content">';
							while ($row = $database->fetch_array($users_result)) {
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
										<th>Staff ID</th>
										<th>Full Name</th>
										<th>Rank</th>
										<th>Email</th>
										<th>Role</th>
										<th></th>
									</tr>
								</thead>
								<tbody>';
								}
								echo '<form action="edit_admin_user.php" method="POST">
								<tr>
									<td>'.$serialno.'</td>
									<td>'.$row["staff_id"].'</td>
									<td>'.$row["surname"].' '.$row["othernames"].'</td>
									<td>'.$row["rank"].'</td>
									<td>'.$row["email"].'</td>
									<td>'.$row["admin_role_name"].'</td>
									<td><button type="submit" class="btn btn-info" name="view_admin_user">View User</button></td>
									
								</tr>
								<input type="hidden" name="uid" value="'.customEncrypt($row["user_id"]).'" />
								</form>';
								if($serialno % $max == 0){
									echo '</tbody>';
									echo '</table>';
									
									echo '</div>';
									$pagecounter++;
								}
								elseif($serialno == $number_of_users){
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
				if($serialno >= $max){
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
<script src="js/view_users.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>