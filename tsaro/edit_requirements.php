<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session -> is_admin_logged_in()) {
	redirect_to('index.php');
}

if (isset($_POST['rid']) && !empty($_POST['rid'])) {
	$requirement = Requirements::find_by_id(customDecrypt($_POST['rid']));
	// print_r($requirement->name);
	// die();
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
				<h2>Edit Admission Requrements</h2>
				<hr>
				<form class="form-horizontal update_requirements" role="form">
					<div class="control-group">
						<label class="control-label" for="title">Title: </label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<input class="span12" name="title" id="title" <?php if(isset($requirement->name)) echo ' value ="'.$requirement->name.'"'; ?> />
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
										$admission_requirements = ProgrammeType::find_by_sql($query); 
										foreach ($admission_requirements as $row) {
											if($row->p_id == $requirement->p_id) {
												echo '<option value="'.$row->p_id.'" selected>'.$row->p_name.'</option>';
											} else {
												echo '<option value="'.$row->p_id.'">'.$row->p_name.'</option>';
											}
										}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="status">Status: </label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<select class="span12" name="status" id="status">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>
					</div>

					<div class="control-group">
						<textarea class="textarea" name="content" id="content" style="width: 610px; height: 120px"><?php if(isset($requirement->content)) echo $requirement->content; ?></textarea>
					</div>

					<div class="control-group">
						<input type="hidden" name="rid" value="<?php echo customEncrypt($requirement->id); ?>">
						<button type="submit" class="btn btn-primary" name="update_requirements" id="update_requirements">Update Admission Requirements</button>
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