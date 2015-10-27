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
				<h2>Set Ineligible Reasons</h2>
				<hr>
				<h4>Add Ineligible Reasons</h4>
				<!-- Begining of programme deactivation form -->
				<form class="form-horizontal add-reason" role="form">
					<div class="control-group">
						<label class="control-label">Reason</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<input class="input-xlarge" name="reason" id="reason" >
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Details</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-pencil"></i></span>
								<textarea class="input-xxlarge" name="details" id="details"></textarea>
							</div>
						</div>
					</div>		
			
					<!--Activate and Deactivate Button-->	
					<div class="control-group">
						  <div class="controls">  
							<button type="submit" class="btn btn-primary" name="add_reason" id="add_reason">Add</button>
					      </div>
					</div>
					<!-- End of Activate and Deactivate Button-->
				</form>
				<!-- End of programme deactivation form -->
				<hr>
				<h4>Edit Ineligible Reasons</h4>
				<form class="form-horizontal edit-reason" role="form">
					<div class="row">
						<div class="span4">
							<div class="control-group">
					 			<label class="control-label">Reason</label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-pencil"></i></span>
										<select name="reason" class="input-xlarge">
			                            	<option value="">--Select--</option>
			                                <?php
												$sqlreasons = $database->query("SELECT * FROM reasons_inelligibility WHERE reason_status=1");
												while($row = $database->fetch_array($sqlreasons)){
													if(isset($reason) && $row['reason'] == $reason){
														echo '<option selected="selected" value="'.$row['reason_id'].'">'.$row['reason'].'</option>';
													}else{
														echo '<option value="'.$row['reason_id'].'">'.$row['reason'].'</option>';
													}
												}
											?>
			                            </select>
									</div>
								</div>
							</div>
						</div>
						<div class="offset2 span2">
							<div class="control-group">
								<button type="submit" class="btn btn-danger" name="del_reason" id="del_reason">Delete</button>
							</div>
						</div>
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
<script src="js/set_ineligible_reasons.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>