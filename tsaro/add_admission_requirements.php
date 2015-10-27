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
	case 2:
		break;
	case 7:
		
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
				<h2>Add Admission Requrements</h2>
				<hr>
				<form class="form-horizontal add_requirements" role="form">
					<div class="control-group">
						<label class="control-label" for="title">Title: </label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<input class="span12" name="title" id="title" />
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="type">Type: </label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<select name="p_id">
									<option value="">--SELECT--</option>
									<?php 
										$query = "SELECT * from programme_type";
										$requirements = ProgrammeType::find_by_sql($query); 
										foreach ($requirements as $row) {
											echo '<option value="'.$row->p_id.'">'.$row->p_name.'</option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="control-group">
						<textarea class="textarea" name="content" id="content" style="width: 610px; height: 120px"></textarea>
					</div>

					<div class="control-group">
						<button type="submit" class="btn btn-primary" name="add_requirements" id="add_requirements">Add Admission Requirements</button>
					</div>
				</form>
				
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
<script src="js/add_admission_requirements.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<script src="../js/bootstrap-wysihtml5.js"></script>
<script>

jQuery('.textarea').wysihtml5();

</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>