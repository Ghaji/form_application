<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session -> is_admin_logged_in()) {
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
				<h2>Set Programmes</h2>
				<hr>
				<h4>Set Activation Status</h4>
				<!-- Begining of programme deactivation form -->
				<form class="form-horizontal select_programme">
					<?php
					$sql_faculty = "SELECT * FROM faculty ORDER BY faculty_name ASC";
					$result_set = $database->query($sql_faculty);
					?>

					<div class="control-group">
						<label class="control-label">Programme</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<select class="input-xlarge" name="faculty_id" id="faculty_id" onChange="get_options(this.value);" >
									<option value="">--Select Programme--</option>
									<?php
									while ($row = $database -> fetch_array($result_set)) {
										echo '<option value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Course</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>

								<select class="input-xlarge" name="department_id" id="department_id" >
									<option value="">--Select Course--</option>
									<div id="department_id"></div>
								</select>
							</div>
						</div>
					</div>
					<!--Activate and Deactivate Button-->
					<div id="accept_terms">		
						<div class="control-group">
							  <div class="controls">  
								<button type="submit" class="btn btn-success" name="activate_submit" id="activate_submit">Activate</button>
								<button type="submit" class="btn btn-danger" name="deactivate_submit" id="deactivate_submit">Deactivate</button>
						      </div>
						</div>
					</div>
					<!-- End of Activate and Deactivate Button-->
				</form>
				<!-- End of programme deactivation form -->
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
<script src="selector.js"></script>
<script src="js/set_programmes.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>