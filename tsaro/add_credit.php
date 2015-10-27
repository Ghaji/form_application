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
				<h2>Add Developer Details</h2>
				<hr>
						<?php 
						//$credit = new Credit();
						
						?>
						<!-- Begining of Credit form -->
				<form class="form-horizontal credit" id="credit">
					
					<div class="control-group">
						<label class="control-label">Fullname</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-user"></i></span>
								<input type="text" id="fullname" name="fullname" placeholder="Fullname" class="input-xlarge" value="<?php  ?>" />
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Email</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-envelope"></i></span>
								<input type="email" id="email" name="email" placeholder="Email" class="input-xlarge" value="<?php ?>" />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Phone</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="iconic-iphone"></i></span>
								<input type="text" id="phone" name="phone" placeholder="Phone" class="input-xlarge" value="<?php ?>" />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Role</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
                                <select class="input-xlarge" name="role" id="role" >
                                	<option selected="selected" value="">--SELECT--</option>
                                <?php
									$arrayAmount = $database->query("SELECT * FROM `credit_status` WHERE `status` = 'active'");
									while($row = $database->fetch_array($arrayAmount)){
										echo '<option value="'.$row['status_name'].'">'.$row['status_name'].'</option>';
									}
								?>
                                </select>
							</div>
						</div>
					</div>
					
					<div class="control-group">
                    <label class="control-label">Passport</label>
						<div class="controls">	
					    	<div>
					    		<div class="fileupload fileupload-new" data-provides="fileupload">
					                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
		                            <img src="css/assets/img/AAAAAA&text=no+image.gif" /></div>
					       <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
					                <div>
					                  <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
		                              <input type="hidden" name="MAX_FILE_SIZE" value="250000"/>
					                  <input type="file" name="picture" id="picture" required /></span>
					                  <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
					                </div>
					            </div>
					   		</div>
					 	</div>
					 </div>
                     
                     <div class="control-group">
						<label class="control-label">About You</label>
						<div class="controls">
							<div class="input-prepend">
				<textarea class="textarea" id="aboutyou" placeholder="...Detail information about you." name="aboutyou" style="width: 610px; height: 200px"></textarea>
							</div>
						</div>
					</div>
                    
                    
                    <div class="control-group">
						<label class="control-label">Status</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
                                <select class="input-xlarge" name="status" id="status"  >
                                	 <option selected="selected" value="">--SELECT--</option>
                                     <option value="active">Active</option>
                                     <option value="inactive">Inactive</option>
                                </select>
							</div>
						</div>
					</div>
					
					<!--Save Button-->
					<div id="accept_terms">		
						<div class="control-group">
							  <div class="controls">  
								<button type="submit" class="btn btn-info" name="save_credit_submit" id="save_credit_submit">Save</button>
                                <button type="submit" class="btn" onClick="document.location.href='home.php'" id="">Back</button>
						      </div>
						</div>
					</div>
					<!-- End of Save Button-->
				</form>
				<!-- End of Credit form -->
				
			</div>
            
		</div>
		<!-- //Content -->

		<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
			<div class="modal-body ajax_data"></div>
			<div class="modal-footer">
				<a href="#" class="btn" id="close">Close</a>
			</div>
		</div>
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
<script src="js/add_credit.js"></script>


<link href="../css/assets/css/bootstrap-wysihtml5.css" rel="stylesheet">
<script src="../js/wysihtml5-0.3.0.js"></script>
<!--<script src="../js/jquery.js"></script>
<script src="../css/assets/js/bootstrap.js"></script>-->
<script src="../js/bootstrap-wysihtml5.js"></script>
<script>

jQuery('.textarea').wysihtml5();

</script>