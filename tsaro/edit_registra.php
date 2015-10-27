<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session -> is_admin_logged_in()) {
	redirect_to('index.php');
}

if (isset($_POST['rid']) && !empty($_POST['rid'])) {
	$registra = Registra::find_by_id(customDecrypt($_POST['rid']));
	// print_r($registra->full_name);
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
				<h2>Edit Registra</h2>
				<hr>
				<form class="form-horizontal update_registra" role="form" id="signature_upload">
					<div class="control-group">
						<label class="control-label" for="full_name">Full Name: </label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<input class="span12" name="full_name" id="full_name" placeholder="Full Name" <?php if(isset($registra->full_name)) echo ' value ="'.$registra->full_name.'"'; ?> />
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="type">Year: </label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<select name="year">
									<option value="">--SELECT--</option>
									<?php
										$current_year = date('Y', time());
										echo '<option value="'.$current_year.'">'.$current_year.'</option>';
										$x = 1;
										while($x < 30) {
											$year = intval($current_year) - $x;

											if(($year == $registra->year)) {
												echo '<option value="'.$registra->year.'" selected>'.$registra->year.'</option>';
											} else {
												echo '<option value="'.$year.'">'.$year.'</option>';
											}

											$x++;
										}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="type">Activation: </label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<select name="visible">
									<option value="">--SELECT--</option>
									<?php
										$status = array('Activate' => 1, 'Deactivate' => 0);
										
										foreach ($status as $key => $value) 
										{
											if(($value == $registra->visible)) {
												echo '<option value="'.$value.'" selected>'.$key.'</option>';
											} else {
												echo '<option value="'.$value.'">'.$key.'</option>';
											}
										}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">	
				    		<div class="fileupload fileupload-new" data-provides="fileupload">
				                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
	                            <?php define('SEP', '/');
								$image_path = str_replace(DS, SEP, $registra->image_path()); ?>
	                            <img src="<?php echo '..'.SEP.$image_path; ?>" /></div>
				                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
				                <div>
				                  <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
	                              <input type="hidden" name="MAX_FILE_SIZE" value="250000"/>
				                  <input type="file" name="signature" id="signature" /></span>
				                  <input type="hidden" name="signature2" id="signature2" value="<?= customEncrypt($registra->id); ?>" required />
				                  <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
				                </div>
				            </div>
					 	</div>
					</div>

					<div class="control-group">
						<button type="submit" class="btn btn-primary" name="update_registra" id="update_registra">Update Registra</button>
						<button type="button" class="btn btn-danger" name="del_registra" id="del_registra">Delete</button>					
					</div>
					<input type="hidden" name="rid" value="<?= customEncrypt($registra->id); ?>" />
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
<script src="js/add_registra.js"></script>
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