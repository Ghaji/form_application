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
	case 6:
		
		break;
	case 9:
		
		break;
	
	default:
		redirect_to('home.php');
		break;
}
$database = new MySQLDatabase();
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
				<h2>Insert into Form Transaction Log</h2>
				<hr>
                
				<!-- Begining of acceptance log form -->
				<form class="form-horizontal acceptance_log_details">
					
					<div class="control-group">
						<label class="control-label">Application Number</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="text" name="applicant_number" placeholder="Applicant Number" class="input-xlarge" value="" />
							</div>
						</div>
					</div>
                    
                    <!--Payment reference -->
                    <div class="control-group">
						<label class="control-label">Access Code</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="text" name="payment_reference" placeholder="Access Code" class="input-xlarge" value="" />
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Response Description</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
                                <select class="input-xlarge" name="response_code" id="response_code" >
                                <option selected="selected" value="">--SELECT--</option>
                                <?php
									$arrayDescription = $database->query("SELECT * FROM interswitch_error_code WHERE status=1 ORDER BY `interswitch_error_code`.`response_description` ASC");
									while($rowDesc = $database->fetch_array($arrayDescription)){
										echo '<option value="'.$rowDesc['response_code'].'">'.$rowDesc['response_description'].'</option>';
									}
								?>
                            </select>
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Amount</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
                                <select class="input-xlarge" name="amount" id="amount" >
                                	<option selected="selected" value="">--SELECT--</option>
                                <?php
									$naira = '&#8358;';
									
									$arrayAmount = $database->query("SELECT * FROM `form_amount` WHERE `status` = 1");
									while($row = $database->fetch_array($arrayAmount)){
										echo '<option value="'.$row['amount'].'">'.$naira.$row['amount'].'</option>';
									}
								?>
                                </select>
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Status</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<select class="input-xlarge" name="student_status" id="student_status" >
                                	<option selected="selected" value="">--SELECT--</option>
                                <?php
									$arrayStudentStatus = array('Post Graduate'=>'PGA', 'Diploma'=>'DPA', 'Part Time'=>'PTA', 'Remedial'=>'RPA', 'Institute of Education'=>'IOE');
									foreach($arrayStudentStatus as $key=>$value){
										if($value == $result->status){
											echo '<option selected="selected" value="'.$value.'">'.$key.'</option>';
										}else{
											echo '<option value="'.$value.'">'.$key.'</option>';
										}
									}
								?> 
                                </select>
							</div>
						</div>
					</div>
					
					
					<!--Insert Button-->
					<div id="accept_terms">		
						<div class="control-group">
							  <div class="controls">
                              <a href="home.php" class="btn btn-default" name="back_submit" id="back_submit">Back</a> 
                                <button type="submit" class="btn btn-primary" name="insert" id="insert">Enter</button>
						      </div>
						</div>
					</div>
					<!-- End of insert Button-->
				</form>
				<!-- End of acceptance log form -->
				
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
<script src="js/acceptance_log_insert.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>